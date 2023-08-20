<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ModelAi{
    protected $base = 'http://127.0.0.1:8081/';

    public function predict_aspect_sentiment($comment){
        $respone = Http::baseUrl($this->base)->get('/comment/absa/'.$comment);
        return $respone->json();
    }
}




