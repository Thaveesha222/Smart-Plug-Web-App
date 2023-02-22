<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use PhpMqtt\Client\Facades\MQTT;

class DashboardController extends Controller
{
    public function initiateMqtt()
    {
//        $mqtt = MQTT::connection();
//
//        $mqtt->subscribe('1/readings', function (string $topic, string $message) use ($mqtt) {
//            \Illuminate\Support\Facades\Log::error('Received QoS level 1 message on topic : ' . $topic . ' : ' . $message);
//            $mqtt->interrupt();
//        }, 0);
//        $mqtt->subscribe('1/power', function (string $topic, string $message) use ($mqtt) {
//            \Illuminate\Support\Facades\Log::error('Received QoS level 1 message on topic : ' . $topic . ' : ' . $message);
//            $mqtt->interrupt();
//        }, 0);
//        $mqtt->subscribe('1/smartmode', function (string $topic, string $message) use ($mqtt) {
//            \Illuminate\Support\Facades\Log::error('Received QoS level 1 message on topic : ' . $topic . ' : ' . $message);
//            $mqtt->interrupt();
//        }, 0);
//        $mqtt->loop();

        return view('dashboard',[
            'devices'=> Auth::user()->devices,
        ]);
    }
}
