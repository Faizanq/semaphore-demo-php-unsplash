<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        $cities = $this->cities();
        $orientation = 'portrait';
        $search = "";
        $count = count($cities);
        return view('index', compact('cities','orientation','search','count'));
    }

    public function search(Request $request)
    {
        return $this->showGallery($request->search, $request->count, $request->orientation);
    }

    public function cityForcastInfo(Request $request){
        $city = $this->cityDetail($request->city_id);
        $forcastInfo = $this->forcast($city->latitude,$city->longitude);
        $stat = 'Processed city ';
        $stat.= $city->name.' | ';
        foreach ($forcastInfo->forecast->forecastday as $key => $forecastday) {
            $stat.= $forecastday->day->condition->text;
            if($key == 0) $stat.= ' - ';
        }
        return view('detail', compact('city','forcastInfo','stat'));
    }

    private function cityDetail($id){
        $client = new \GuzzleHttp\Client();
        $url = "https://api.musement.com/api/v3/cities/".$id;
        $request = $client->get($url);
        $response = json_decode($request->getBody()->getContents());
        return $response;
    }

    private function forcast($lat=52.374,$lng=4.9){
        $client = new \GuzzleHttp\Client();
        $url = "http://api.weatherapi.com/v1/forecast.json?key=".config('app.forcast_api_key')."&q=".$lat.",".$lng."&days=2";
        $request = $client->get($url);
        $response = json_decode($request->getBody()->getContents());
        return $response;
    }

    private function cities(){
        $client = new \GuzzleHttp\Client();
        $url = "https://api.musement.com/api/v3/cities";
        $request = $client->get($url);
        $response = json_decode($request->getBody()->getContents());
        return $response;
    }

}
