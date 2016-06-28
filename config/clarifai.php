<?php

return [
    'api_url' => env('CLARIFAI_API','https://api.clarifai.com/v1/'),
    'client_id'  => env('CLARIFAI_CLIENT_ID'),
    'client_secret' => env('CLARIFAI_CLIENT_SECRET'),
    "grant_type"=>env('CLARIFAI_GRANT_TYPE','client_credentials'),
    "default_model"=>env('CLARIFAI_DEFAULT_MODEL','general-v1.3')
];