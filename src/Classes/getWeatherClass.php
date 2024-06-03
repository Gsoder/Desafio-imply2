<?php

namespace Imply\DesafioImply2\Classes;

class getWeatherClass
{
    private string $url;
    private float $lat;
    private float $lon;
    public function __construct(string $url, float $lat, float $lon){
        $this->url = $url;
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getWeather(){

        $curl = curl_init();


        $url = "https://api.openweathermap.org/data/2.5/weather?lat=$this->lat&lon=$this->lon&appid=$this->url";


        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        
        return curl_exec($curl);


    }



    


}
