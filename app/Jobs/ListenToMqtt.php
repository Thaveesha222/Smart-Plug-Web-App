<?php

namespace App\Jobs;

use App\Models\Device;
use App\Models\Reading;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Facades\MQTT;

class ListenToMqtt implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $device_id;
    private $topic_name;

    public $timeout = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($device_id, $topic_name)
    {
        $this->device_id = $device_id;
        $this->topic_name = $topic_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mqtt = MQTT::connection();
        $mqtt->subscribe($this->device_id . '/' . $this->topic_name, function (string $topic, string $message) use ($mqtt) {
            Log::info('Received QoS level 1 message on topic : ' . $topic . ' : ' . $message);
            $readings = json_decode($message, true);
            foreach ($readings as $reading) {
                //Create new reading
                Reading::create([
                    'device_id' => $this->device_id,
                    'voltage_reading' => $reading['v'],
                    'current_reading' => $reading['i'],
                    'timestamp' => $reading['time']
                ]);
                Log::info("New Reading created for device id : ".$this->device_id);
            }
            //Delete readings that are older than 1 day
            Device::find($this->device_id)->readings()->where('created_at','<',Carbon::now()->subDay())->delete();
        }, 0);

        $mqtt->loop(true, true);
    }
}
