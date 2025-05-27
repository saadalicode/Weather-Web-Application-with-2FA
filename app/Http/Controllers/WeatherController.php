<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    //
    public function home(){
        return view('weather.home');
    }

    public function index(Request $request){
        $weatherResponse = [];

        if($request->isMethod('post')){
            $cityName = $request->city;

            $respone = Http::withHeaders([
                "x-rapidapi-host" => "open-weather13.p.rapidapi.com",
                "x-rapidapi-key" => "b3f4beb2b3msh9f8fb99c25c1c82p1cbd2djsn0c878f80382e"
            ])->get("https://open-weather13.p.rapidapi.com/city/{$cityName}/EN");


            $weatherResponse = $respone->json();
        }


        return view('weather.index', [ 'data' => $weatherResponse]);
    }
}
