<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;

class ConnectApiController extends Controller
{

    public function connectApi($typeRequest)
    {  
        $publicKey = 'f6dc9a7df78536b934df9563b5bc5600';
        $privateKey = '8143ef1af945ba38ecb30ee425ae7ac2a0cce1b6';
        
        $dateTime = new DateTime();
        $ts = $dateTime->getTimestamp();
        $fullHash = $ts.$privateKey.$publicKey;
        $md5 = md5($fullHash);
        $urlComplete = 'ts='.$ts.'&apikey='.$publicKey.'&hash='.$md5;

        $url = 'https://gateway.marvel.com/'.$typeRequest.$urlComplete;

        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
            
            curl_exec($ch);
    
            curl_close($ch);

            if(!isset($ch)){
                throw new \Exception();
            }
        } catch(\Exception $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
