<?php
/**
 * Created by PhpStorm.
 * User: threeel
 * Date: 6/28/16
 * Time: 12:38 AM
 */

namespace Threeel\Clarifai;


class ClarifaiUrl
{

    /**
     * QueryString Parameters used to filter the request
     *
     * @var array $parameters
     */
    private $parameters = [];
    private $api_url;
    private $client_id;
    private $client_secret;
    private $grant_type;
    private $default_model;

    private $endpoint;

    public function __construct(array $options){
        $this->api_url = array_get($options,'api_url', config('clarifai.api_url'));
        $this->client_id = array_get($options,'client_id', config('clarifai.client_id'));
        $this->client_secret = array_get($options,'client_secret',config('clarifai.client_secret'));
        $this->grant_type = array_get($options,'grand_type',config('clarifai.grant_type'));
        $this->default_model = array_get($options,'default_model',config('clarifai.default_model'));

        if ($this->client_id  === null || $this->client_secret === null){
            throw new \InvalidArgumentException('client_id or client_secret not set check in the config/clarifai.php');
        }

    }

    public function withParameter($key,$value){
        $this->parameters[$key] = $value;

        return $this;
    }

    public function onEndpoint($endpoint){
        $this->endpoint = $endpoint;

        return $this;
    }


    public function withModel($name = null){
        if ($name !== null){
            $this->parameters['model'] = $name;
        } else {
            $this->parameters['model'] = $this->default_model;
        }
        return $this;
    }

    public function get($endpoint = null,$model = null){
        if ($endpoint){
            $this->onEndpoint($endpoint);
        }

        if ($model){
          $this->withModel($model);
        }

        if (isset($this->endpoint)){
         return $this->api_url . $this->endpoint . '/?' . http_build_query($this->parameters);
        }

        return $this->api_url;
    }


    public function languages(){
        return $this->onEndpoint('info/languages')->get();
    }

    public function credentials(){
        return [
            'client_id'=>$this->client_id,
            'client_secret'=>$this->client_secret,
            'grant_type'=> $this->grant_type,
        ];
    }

    public function __toString()
    {
        return $this->get();
    }


}