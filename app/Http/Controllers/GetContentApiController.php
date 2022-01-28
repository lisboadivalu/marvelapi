<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ConnectApiController;
use Exception;

class GetContentApiController extends Controller
{
    public function connApi(string $url)
    {
      $conn = new ConnectApiController();
      $conn->connectApi($url);
      return $conn;  
    }

    public function getAllCharacters() 
    {
        $url = 'v1/public/characters?';
        $response = $this->connApi($url);

        return response()->json($response);
    }

    public function singleCharacter(){

        $name = $_GET['search'];
        $url = 'v1/public/characters?name='.$name.'&';
        $response = $this->connApi($url);

        try {
            $response = response()->json($response);
            return view('search', compact('response'));
            if(!$response){
                throw new Exception('Not found! Verify the correct name of charecter');
            }
            } catch(Exception $e) {
                return 'Failed: ' . $e->getMessage();
            }
        }

    public function getAllComics()
    {
        $url = 'v1/public/comics?';
        $response = $this->connApi($url);

        return response()->json($response);
    }

    public function singleComic($name){
        try {
            $url = 'v1/public/comics?name='.$name.'&';
            $response = $this->connApi($url);
            return response()->json($response);
            if(!$response){
                throw new Exception('Not found! Verify the correct name of comic');
            }
         } catch(Exception $e) {
                return 'Failed: ' . $e->getMessage();
        }
    }
}
