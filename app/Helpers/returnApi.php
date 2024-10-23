<?php
//Call The Constructor.
use App\Classes\Sender;


use App\Models\TestNationality;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;
use App\User;
/* declare bitly namespace */
use Shivella\Bitly\Facade\Bitly as Bitly;

if ( ! function_exists( 'returnApi' ) ) {
    /**
     * Get Total Refunded Amount order
     * @param $id
     *
     * @return  float|integer
     */
    function returnApi($return)
    {

        return response()->json($return)->header('X-Ver', 1);
    }
}
