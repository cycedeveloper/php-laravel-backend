<?php
namespace Sayedsoft\Dex\Base\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DexReponse {

    
    public static function json (Request $request,$mode,$message,$data = [],$status = 200) {

        $data = [
            'mode'    => $mode,
            'message' => $message,
            'data'    => $data
        ];
       return   Response::json($data,$status);
    }


}