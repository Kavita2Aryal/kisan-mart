<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;

class ThankyouController extends Controller
{
    public function show($encrypt)
    {
        if ($encrypt != '') { 
            $params = decrypt($encrypt);
            $params = explode("___", $params);
            if (count($params) == 3) { 
                $check_timestamp   = strtotime('+15 minutes', $params[2]);
                $current_timestamp = time();

                if ($check_timestamp >= $current_timestamp) { 
                    $message = 'Thankyou for contacting us!';
                    return view('cms.thankyou', compact('message'));
                }
            }
        }
        return back();
    }
}
