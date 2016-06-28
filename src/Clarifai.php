<?php
/**
 * Created by PhpStorm.
 * User: threeel
 * Date: 6/28/16
 * Time: 3:01 AM
 */

namespace Threeel\Clarifai;


class Clarifai
{
    
    

    private $client;
    protected $unwrap = false;

    public function __construct(ClarifaiClient $client){
        $this->client = $client;
    }

    public function authorize(){
        return $this->client->getToken();
    }

    /**
     * Get the Tags for a specific Resource Image or Video by using the default or a specific Tag Model
     * @param $url
     * @param string $model
     * @return mixed
     */
    public function tags($url, $model = ClarifaiTagType::GENERIC){

       $request_url =  $this->client->url()
                            ->onEndpoint('tag')
                            ->withModel($model)
                            ->withParameter('url',$url)
                            ->get();

        $response = $this->client->get($request_url);

        if ($this->unwrap){
            return $this->unwrapTagsResponse($response);
        }
        return $response;
    }

    private function unwrapTagsResponse($response){
        // if Unwrap is true unwrap the response like array(timestamp,model,doc_id, doc_id_str, url,tag_class,tag_probability,tag_concept_id)

        return [
            'unwraped' =>$response,
        ];
    }

    /**
     * @param $url
     * @return mixed
     */
    public function suitability($url){
        return $this->getTags($url,ClarifaiTagType::NOT_SUITABLE);
    }

    public function unWrap(){
        $this->unwrap = true;
        return $this;
    }

    /**
     * @return ClarifaiClient
     */
    public function client(){
        return $this->client;
    }
}