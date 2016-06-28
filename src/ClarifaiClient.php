<?php
/**
 * Created by PhpStorm.
 * User: threeel
 * Date: 6/28/16
 * Time: 12:38 AM
 */

namespace Threeel\Clarifai;


use Threeel\Clarifai\Exceptions\AuthorizationException;

class ClarifaiClient
{

    private $url;
    protected $request;
    private $token;
    private $tokenRequest = false;

    public function __construct(array $options = []){
        $this->url = new ClarifaiUrl($options);
    }
    
    /**
     * Get the Token to be used for the consecutive requests
     */
    public function getToken(){
        $url = $this->url->get('token');
        $this->tokenRequest = true;
        $tokenResult = $this->post( $url, $this->url->credentials() );

        if (isset($tokenResult['access_token'])){
            $this->token = $tokenResult['access_token'];
            $this->tokenRequest = false;
            return $this->token;
        }

        throw new AuthorizationException($tokenResult['error']);
    }

    public function getAuthorizationHeader(){
        if (!$this->tokenRequest){
            $header = 'Authorization: Bearer ';
                if (!$this->hasToken()){
                    $this->getToken();
                }
            return [(string) $header . $this->token];
        }
    }

    public function hasToken(){
        return isset($this->token);
    }

    public function url(){
        return $this->url;
    }

    public function onModel($name){

    }
    /**
     * Prepares the Curl Resource to be Executed
     * @param $url
     * @param string $method
     * @param array $data
     */
    private function setup($url, $method = 'GET', array $data = [], $headers = []){
        try {
            $this->request = curl_init($url);

            curl_setopt($this->request, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($this->request, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->request, CURLOPT_SSL_VERIFYPEER, false);

            if ($method === 'POST') {
                curl_setopt($this->request, CURLOPT_POST, count($data));
                curl_setopt($this->request, CURLOPT_POSTFIELDS, $data);
            }

            if ($headers !== null) {
                curl_setopt($this->request, CURLOPT_HTTPHEADER, $headers);
            }
        } catch (\Exception $ex){
            throw $ex;
        }

    }

    public function isAuthorized(){
        return ($this->token !== null) ;
    }

    /**
     * Disposes the Curl Resource Handle
     * @param $curl_resource
     */
    private function destroy($curl_resource){
        return curl_close($curl_resource);
    }

    public function request($url, $method = 'GET', array $data = []){
        $header = $this->getAuthorizationHeader();
       // dd($header);
        $this->setup($url,$method, $data,$header);
        try{
            $curl_response = curl_exec($this->request);
            $response = json_decode($curl_response,true);
            $this->destroy($this->request);

            return $response;
        } catch (\Exception $ex){
            throw $ex;
        }

    }

    /**
     * Make a GET Request to Clarifai
     * @return mixed
     */
    public function get($url = null){
        if (!$url){
            return $this->request($this->url->get(),'GET');
        }
        return $this->request($url,'GET');
    }

    /**
     * Make a POST Request to Clarifai
     * @param array $data
     * @return mixed
     */
    public function post($url,array $data){
        return $this->request($url,'POST',$data);
    }

    /**
     * The Endpoint to Call
     * @param $name
     * @return KitelyClient
     */
    public function onService($name){
        $this->url->onService($name);
        return $this;
    }

    /**
     * The Array of Query Parameters
     * @param array $parameters
     * @return KitelyClient
     */
    public function withParameters(array $parameters){
        foreach ($parameters as $key => $value){
            $this->withParameter($key,$value);
        }
        return $this;
    }

    /**
     * Add a query parameter
     * @param string $key
     * @param string $value
     * @return KitelyClient
     */
    public function withParameter($key, $value){
        $this->url->withParameter($key,$value);

        return $this;
    }

    /**
     * The Url that will be Called
     * @return string
     */
    public function __toString()
    {
        return (string) $this->url;
    }


}