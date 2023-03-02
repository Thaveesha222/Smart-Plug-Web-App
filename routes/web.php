<?php

use App\Http\Controllers\ProfileController;
use App\Models\Device;
use App\Models\Reading;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use PhpMqtt\Client\Facades\MQTT;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard/{id}', function ($id) {
    if (Auth::user()->devices->count() > 0) {
        $active_device = $id == "any" ? Auth::user()->devices->first() : Device::find($id);

        try {
            $response = \Illuminate\Support\Facades\Http::get('https://wandering-water-6831.fly.dev/cforcast', [
                'device_id' => $active_device->mqtt_device_id
            ]);
            $data = $response->json();
            $prediction_values = \Illuminate\Support\Arr::flatten($data["data"]);
            $start = Carbon::now()->subDays(Carbon::now()->getDaysFromStartOfWeek());
            $prediction_dates = [];
            foreach ($prediction_values as $prediction_value) {
                $prediction_dates[] = $start->toDateTimeString();
                $start = $start->addHour();
            }
            $prediction_chart_data = [
                'prediction_values' => $prediction_values,
                'prediction_dates' => $prediction_dates
            ];
        } catch (Exception $e) {
            $prediction_chart_data = [
                'prediction_values' => [],
                'prediction_dates' => []
            ];
        }


        //Refining the values to send to the frontend
        $readings = Reading::where('device_id', $active_device->id)->latest()->take(10)->get()->toArray();
        $times = [];
        $voltage_axis = [];
        $current_axis = [];
        if (sizeof($readings) > 0) {
            foreach ($readings as $item) {
                $times[] = Carbon::createFromTimestamp($item["timestamp"])->toDateTimeString();
                $voltage_axis[] = $item["voltage_reading"];
                $current_axis[] = $item["current_reading"];
            }
        }
        return view('dashboard', [
            'devices' => Auth::user()->devices,
            'active_device' => $active_device,
            'chart_data' => [
                'times' => json_encode($times),
                'voltage_axis' => json_encode($voltage_axis),
                'current_axis' => json_encode($current_axis),
                'power_prediction_chart_details' => json_encode($prediction_chart_data)
            ]
        ]);
    } else {
        //If User Dosnt have and devices
        $times = [];
        $voltage_axis = [];
        $current_axis = [];
        return view('dashboard', [
            'devices' => Auth::user()->devices,
            'active_device' => null,
            'chart_data' => [
                'times' => json_encode(range(1, sizeof($voltage_axis))),
                'voltage_axis' => json_encode($voltage_axis),
                'current_axis' => json_encode($current_axis),
                'prediction_values' => json_encode([]),
                'power_prediction_chart_details' => json_encode(['prediction_values' => [], 'prediction_dates' => []])
            ]
        ]);
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('devices')->group(function () {
    Route::post('create', function (\Illuminate\Http\Request $request) {
        if (Device::where('mqtt_device_id', $request->device_id)->count() == 0) {
            $device = Device::create([
                'mqtt_device_id' => $request->device_id,
                'device_name' => $request->device_name,
                'user_id' => Auth::user()->id
            ]);
            try {
                $response = \Illuminate\Support\Facades\Http::get('https://0d3ce8b0-2146-4852-b910-2feca57524f9.mock.pstmn.io//cforcast', [
                    'device_id' => $request->device_id
                ]);
                $data = $response->json();
                $prediction_values = \Illuminate\Support\Arr::flatten($data["data"]);
                $start = Carbon::now()->subDays(Carbon::now()->getDaysFromStartOfWeek());
                $prediction_dates = [];
                foreach ($prediction_values as $prediction_value) {
                    $prediction_dates[] = $start->toDateTimeString();
                    $start = $start->addHour();
                }
                $prediction_chart_data = [
                    'prediction_values' => $prediction_values,
                    'prediction_dates' => $prediction_dates
                ];
            } catch (Exception $e) {
                $prediction_chart_data = [
                    'prediction_values' => [],
                    'prediction_dates' => []
                ];
            }

            return view('dashboard', [
                'devices' => Auth::user()->devices,
                'active_device' => $device,
                'chart_data' => [
                    'times' => json_encode([]),
                    'voltage_axis' => json_encode([]),
                    'current_axis' => json_encode([]),
                    'power_prediction_chart_details' => json_encode($prediction_chart_data)
                ]
            ]);

        } else {
            \cache()->put("device_already_exists_error", true);
            if (Auth::user()->devices->count() > 0) {

                $readings = Reading::where('device_id', Auth::user()->devices->first()->id)->latest()->take(10)->get()->toArray();
                $times = [];
                $voltage_axis = [];
                $current_axis = [];
                if (sizeof($readings) > 0) {
                    foreach ($readings as $item) {
                        $times[] = Carbon::createFromTimestamp($item["timestamp"])->toDateTimeString();
                        $voltage_axis[] = $item["voltage_reading"];
                        $current_axis[] = $item["current_reading"];
                    }
                }
                try {
                    $response = \Illuminate\Support\Facades\Http::get('https://0d3ce8b0-2146-4852-b910-2feca57524f9.mock.pstmn.io//cforcast', [
                        'device_id' => Auth::user()->devices->first()->mqtt_device_id
                    ]);
                    $data = $response->json();
                    $prediction_values = \Illuminate\Support\Arr::flatten($data["data"]);
                    $start = Carbon::now()->subDays(Carbon::now()->getDaysFromStartOfWeek());
                    $prediction_dates = [];
                    foreach ($prediction_values as $prediction_value) {
                        $prediction_dates[] = $start->toDateTimeString();
                        $start = $start->addHour();
                    }
                    $prediction_chart_data = [
                        'prediction_values' => $prediction_values,
                        'prediction_dates' => $prediction_dates
                    ];
                } catch (Exception $e) {
                    $prediction_chart_data = [
                        'prediction_values' => [],
                        'prediction_dates' => []
                    ];
                }

                return view('dashboard', [
                    'devices' => Auth::user()->devices,
                    'active_device' => Auth::user()->devices->first(),
                    'chart_data' => [
                        'times' => json_encode($times),
                        'voltage_axis' => json_encode($voltage_axis),
                        'current_axis' => json_encode($current_axis),
                        'power_prediction_chart_details' => json_encode($prediction_chart_data)
                    ],
                ]);
            } else {
                return view('dashboard', [
                    'devices' => Auth::user()->devices,
                    'active_device' => null,
                    'chart_data' => [
                        'times' => json_encode([]),
                        'voltage_axis' => json_encode([]),
                        'current_axis' => json_encode([]),
                        'prediction_values' => json_encode([]),
                        'prediction_dates' => json_encode(['prediction_values' => [], 'prediction_dates' => []])
                    ],
                ]);
            }
        }
    });
});

Route::get('/getReadings/{device_id}', function ($device_id) {
    $device = Device::where('mqtt_device_id', $device_id)->first();
    if ($device->readings->count() != 0 && $device->power_state && $device->online_state) {
        $latest_reading = Device::where('mqtt_device_id', $device_id)->first()->readings()->latest()->first();
        return [
            'voltage' => $latest_reading->voltage_reading,
            'current' => $latest_reading->current_reading,
            'datetime' => $latest_reading->created_at->toDateTimeString()
        ];
    } else {
        return [
            'voltage' => 0,
            'current' => 0,
            'datetime' => Carbon::now()->toDateTimeString()
        ];
    }
});

Route::get('/toggle_switch/{device_id}', function (\Illuminate\Http\Request $request) {
    MQTT::publish($request->device_id . '/power', '{"state":' . $request->state . '}');
    Device::where('mqtt_device_id', $request->device_id)->first()->update(['power_state' => !($request->state == "false")]);
    return true;
});

Route::get('/toggle_smart_mode/{device_id}', function (\Illuminate\Http\Request $request) {
    MQTT::publish($request->device_id . '/smartmode', '{"state":' . $request->state . '}');
    Device::where('mqtt_device_id', $request->device_id)->first()->update(['smart_mode_state' => !($request->state == "false")]);
    return true;
});

Route::get('/create-anomaly', function (\Illuminate\Http\Request $request) {
    Log::info("Request Received For Anomaly");
    if (!$request->response[0]) {
        $reading = $request->all()["data reading"];
        \App\Models\Anomaly::create([
            'device_id' => $request->device_id,
            'voltage' => $reading["v"],
            'current' => $reading["i"],
            'timestamp' => $reading["time"],
            'notification_shown_to_user' => false
        ]);
    }
    return true;
});

Route::get('/check_for_anomaly_notification', function () {
    $device_ids = Auth::user()->devices->pluck('id')->toArray();
    $unshown_notifications = \App\Models\Anomaly::whereIn('device_id', $device_ids)->where('notification_shown_to_user', false)->get();
    foreach ($unshown_notifications as $unshown_notification) {
        $unshown_notification->update(['notification_shown_to_user' => true]);
    }
    return $unshown_notifications;
});

Route::get('/check_switch_status/{device_id}', function ($device_id) {
    return Device::find($device_id)->power_state;
});

Route::get('/check_online_status/{device_id}', function ($device_id) {
    return Device::find($device_id)->online_state;
});

Route::get('/update_device_log/{device_id}', function ($device_id) {
    $logs = Device::find($device_id)->device_logs()->latest()->take(10)->get()->toArray();
    return $logs;
});

Route::get('/email_device_log/{device_id}', function ($device_id) {
    $results = Device::find($device_id)->device_logs;
    $filename = $device_id.'-'.Device::find($device_id)->device_name.'log.csv';
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array('Name', 'Email', 'Mqtt Device ID','Device Name','Log','Created At'));

    foreach ($results as $result) {
        fputcsv($handle, array($result->device->user->name, $result->device->user->email, $result->device->mqtt_device_id, $result->device->device_name, $result->log, $result->created_at));
    }

    fclose($handle);
    return response()->download($filename);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
