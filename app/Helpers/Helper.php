<?php

use App\Core\Response;
use Carbon\Carbon;

if (!function_exists('api'))
{
    function api(){
        return new Response();
    }
}

if (!function_exists('carbon'))
{
    function carbon($date)
    {
        if ($date === '' || empty($date)){
            return null;
        }
        $date = explode("-" , $date);
        return count($date) === 3 ? Carbon::createMidnightDate( $date[0] , $date[1] , $date[2] ) : now();
    }
}
