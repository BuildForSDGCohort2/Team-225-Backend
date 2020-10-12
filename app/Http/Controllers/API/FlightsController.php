<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlightsController extends Controller
{

    //Retrieve cheapest dates for a given route from Skyscanner API
    public function getFlights()
    {
        $country             = request('country');
        $currency            = request('currency');
        $locale              = request('locale');
        $destinationPlace    = request('destinationPlace');
        $originPlace         = request('originPlace');
        $outboundPartialDate = request('outboundPartialDate');
        $inboundPartialDate  = request('inboundPartialDate');

        $response = Unirest\Request::get("https://skyscanner-skyscanner-flight-search-v1.p.rapidapi.com/
        apiservices/browsedates/v1.0/$country/$currency/$locale/$originPlace/$destinationPlace/
        $outboundPartialDate?inboundpartialdate=$inboundPartialDate",
            array(
                "X-RapidAPI-Host" => "skyscanner-skyscanner-flight-search-v1.p.rapidapi.com",
                "X-RapidAPI-Key" => "0d6f6596bbmsh8680a27328442f2p1822d7jsn331b157231d9"
            )
        );

        return response->json();
    }

}
