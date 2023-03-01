<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['device_name', 'mqtt_device_id', 'user_id','power_state','smart_mode_state','online_state'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function readings()
    {
        return $this->hasMany(Reading::class);
    }

    public function device_logs()
    {
        return $this->hasMany(DeviceLog::class);
    }
}
