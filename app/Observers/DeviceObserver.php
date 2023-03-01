<?php

namespace App\Observers;

use App\Models\Device;
use App\Models\DeviceLog;

class DeviceObserver
{
    /**
     * Handle the Device "created" event.
     *
     * @param \App\Models\Device $device
     * @return void
     */
    public function created(Device $device)
    {
        DeviceLog::create([
            'device_id' => $device->id,
            'log' => "Device Created"
        ]);
    }


    /**
     * Handle the Device "updated" event.
     *
     * @param \App\Models\Device $device
     * @return void
     */
    public function updating(Device $device)
    {
        $original_values = $device->getDirty();
        if (isset($original_values['power_state']) && (Device::find($device->id)->power_state != $original_values['power_state'])) {
            DeviceLog::create([
                'device_id' => $device->id,
                'log' => "Device Turned " . ($device->power_state ? "On" : "Off")
            ]);
        }
        if (isset($original_values['online_state']) && (Device::find($device->id)->online_state != $original_values['online_state'])) {
            DeviceLog::create([
                'device_id' => $device->id,
                'log' => "Device " . ($device->online_state ? "Online" : "Offline")
            ]);
        }
        if (isset($original_values['smart_mode_state']) && (Device::find($device->id)->smart_mode_state != $original_values['smart_mode_state'])) {
            DeviceLog::create([
                'device_id' => $device->id,
                'log' => "Smart Mode Turned " . ($device->smart_mode_state ? "On" : "Off")
            ]);
        }
    }

    /**
     * Handle the Device "deleted" event.
     *
     * @param \App\Models\Device $device
     * @return void
     */
    public function deleted(Device $device)
    {
        //
    }
}
