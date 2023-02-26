<?php

namespace App\Console\Commands;

use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ChangePowerSwitchState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:check_power';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loops through all devices and checks if there power should be turned on or off';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        while (true) {
            $devices = Device::all();
            foreach ($devices as $device) {
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
            usleep(100000); // Sleep for 500ms (0.5 seconds) before calling the function again
        }
    }
}
