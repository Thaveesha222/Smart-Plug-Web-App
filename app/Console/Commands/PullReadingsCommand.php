<?php

namespace App\Console\Commands;

use App\Models\Device;
use App\Models\Reading;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Facades\MQTT;

class PullReadingsCommand extends Command
{
    protected $mqttConnection = null;

    protected $connected_device_ids = [];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:pull_readings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loops for all devices and obtains the readings relevant to those devices. Deletes readings that are older than 24 hours';

    public function __construct()
    {
        parent::__construct();
    }

    public function subscribeDeviceToReadingsTopic(Device $device)
    {
        if (!in_array($device->id, $this->connected_device_ids)) {
            $device_id = $device->mqtt_device_id;
            $this->mqttConnection->subscribe($device_id . '/readings', function (string $topic, string $message) use ($device_id) {
                Log::info('Received QoS level 1 message on topic : ' . $topic . ' : ' . $message);
                $readings = json_decode($message, true);
                foreach ($readings as $reading) {
                    //Create new reading
                    Reading::create([
                        'device_id' => Device::where('mqtt_device_id', $device_id)->first()->id,
                        'voltage_reading' => $reading['v'],
                        'current_reading' => $reading['i'],
                        'timestamp' => $reading['time']
                    ]);
                    Log::info("New Reading created for device id : " . $device_id);
                }
                //Delete readings that are older than 1 day
                Device::where('mqtt_device_id', $device_id)->first()->readings()->where('created_at', '<', Carbon::now()->subDay())->delete();
            }, 0);
            $this->connected_device_ids[] = $device->id;
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Command Initiated');
        $this->mqttConnection = MQTT::connection();
        $devices = Device::all();
        foreach ($devices as $device) {
            $this->subscribeDeviceToReadingsTopic($device);
        }
        $this->info('Connection to Broker established and command executing');

        while (true) {
            if (sizeof($this->connected_device_ids)>0) {
                $this->mqttConnection->loopOnce(microtime(true));
                $this->info('Looped!');
                $devices = Device::all();
                foreach ($devices as $device) {
                    if(!in_array($device->id,$this->connected_device_ids)) {
                        $this->subscribeDeviceToReadingsTopic($device);
                    }

                    $latest_reading = $device->readings()->latest()->first();
                    if ($latest_reading) {
                        if (Carbon::now()->diffInSeconds($latest_reading->created_at)>15) {
                            //Last reading received more than 10 seconds ago
                            $device->update(['online_state' => false]);
                            $device->update(['power_state' => false]);
                        } else {
                            //Last reading recieved less than 12 seconds ago
                            $device->update(['online_state' => true]);
                            if ($latest_reading->voltage_reading == 0) {
                                //last reading is 0
                                $device->update(['power_state' => false]);
                            } else {
                                //last reading is non zero
                                $device->update(['power_state' => true]);
                            }
                        }
                    } else {
                        //No readings available for device
                        $device->update(['online_state' => false]);
                        $device->update(['power_state' => false]);
                    }
                }
                unset($devices);
            }
        }
    }
}
