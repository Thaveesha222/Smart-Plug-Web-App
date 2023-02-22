<style>
    div.container {
        text-align: center;
    }

    div.pop-up {
        position: relative;
        left: 128px;
        bottom: 68px;
        width: 120px;
        height: 80px;
        border-radius: 5px;
        cursor: pointer;
    }

    div.pop-up p {
        position: relative;
        bottom: 10px;
        text-align: center;
    }

    div.arrow-down {
        position: relative;
        top: 78px;
        left: 45px;
        width: 0;
        height: 0;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;

        border-top: 15px solid #3795f6;
    }

    div.online-indicator {
        display: inline-block;
        width: 15px;
        height: 15px;
        margin-right: 10px;

        background-color: #0fcc45;
        border-radius: 50%;

        position: relative;
    }

    div.offline-indicator {
        display: inline-block;
        width: 15px;
        height: 15px;
        margin-right: 10px;

        background-color: red;
        border-radius: 50%;

        position: relative;
    }

    span.blink-online {
        display: block;
        width: 15px;
        height: 15px;

        background-color: #0fcc45;
        opacity: 0.7;
        border-radius: 50%;

        animation: blink-online 1s linear infinite;
    }

    span.blink-offline {
        display: block;
        width: 15px;
        height: 15px;

        background-color: red;
        opacity: 0.7;
        border-radius: 50%;

        animation: blink-online 1s linear infinite;
    }

    h2.online-text {
        display: inline;
        color: white;
    }

    /*Animations*/

    @keyframes blink-online {
        100% {
            transform: scale(2, 2);
            opacity: 0;
        }
    }

    .can-toggle {
        --ts-width: 64px;
        --ts-height: 36px;
        --ts-offset: 2px;
        --ts-font-size: 12px;
        --ts-border-radius-ext: 4px;
        --ts-border-radius-int: 2px;
        --ts-color-disabled: rgba(119, 119, 119, 0.5);
        --ts-bg-color: #848484;
        --ts-thumb-bg-color: #fff;
        --ts-thumb-color: #777;
        --ts-thumb-color-hover: #5e5e5e;
        --ts-thumb-color-checked: #4fb743;
        --ts-thumb-bg-color-checked-hover: #47a43d;
        --ts-color: rgba(255, 255, 255, 0.5);
        --ts-bg-color-hover: #777;
        --ts-color-hover: #6a6a6a;
        --ts-color-checked-hover: #55bc49;
        --ts-bg-color-checked: #70c767;
        --ts-bg-color-checked-hover: #5fc054;
        --ts-box-shadow: 0 3px 3px;

        position: relative;
        display: flex;
    }

    .can-toggle *,
    .can-toggle *:before,
    .can-toggle *:after {
        box-sizing: border-box;
    }

    .can-toggle input[type="checkbox"] {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
    }

    .can-toggle input[type="checkbox"][disabled] ~ label {
        pointer-events: none;
    }

    .can-toggle input[type="checkbox"][disabled] ~ label .can-toggle__switch {
        opacity: 0.6;
    }

    .can-toggle input[type="checkbox"]:checked ~ label .can-toggle__switch:before {
        content: attr(data-unchecked);
        left: 0;
    }

    .can-toggle input[type="checkbox"]:checked ~ label .can-toggle__switch:after {
        content: attr(data-checked);
    }

    .can-toggle label {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        cursor: pointer;
        position: relative;
        display: flex;
        align-items: center;
        flex: 1;
    }

    .can-toggle label .can-toggle__label-text {
        flex: 1;
        padding-left: 16px;
    }

    .can-toggle label .can-toggle__switch {
        position: relative;
    }

    .can-toggle label .can-toggle__switch {
        display: flex;
        justify-content: space-around;
        align-items: center;
        isolation: isolate;
    }

    .can-toggle label .can-toggle__switch figure {
        display: flex;
        align-items: center;
        margin-inline: 0;
        margin-block: 0;
        z-index: 1;
    }

    .can-toggle label .can-toggle__switch:before {
        content: attr(data-checked);
        position: absolute;
        text-transform: uppercase;
        text-align: center;
    }

    .can-toggle label .can-toggle__switch:after {
        content: attr(data-unchecked);
        position: absolute;
        z-index: 0;
        text-transform: uppercase;
        text-align: center;
        background: var(--ts-thumb-bg-color, white);
        transform: translate3d(0, 0, 0);
    }

    .can-toggle input[type="checkbox"][disabled] ~ label {
        color: var(--ts-color-disabled);
    }

    .can-toggle input[type="checkbox"]:focus ~ label .can-toggle__switch,
    .can-toggle input[type="checkbox"]:hover ~ label .can-toggle__switch {
        background-color: var(--ts-bg-color-hover);
    }

    .can-toggle input[type="checkbox"]:focus ~ label .can-toggle__switch:after,
    .can-toggle input[type="checkbox"]:hover ~ label .can-toggle__switch:after {
        color: var(--ts-thumb-color-hover, #5e5e5e);
    }

    .can-toggle input[type="checkbox"]:hover ~ label {
        color: var(--ts-color-hover, #6a6a6a);
    }

    .can-toggle input[type="checkbox"]:checked ~ label:hover {
        color: var(--ts-color-checked-hover, #55bc49);
    }

    .can-toggle input[type="checkbox"]:checked ~ label .can-toggle__switch {
        background-color: var(--ts-bg-color-checked, #70c767);
    }

    .can-toggle input[type="checkbox"]:checked ~ label .can-toggle__switch:after {
        color: var(--ts-thumb-color-checked, #4fb743);
    }

    .can-toggle input[type="checkbox"]:checked:focus ~ label .can-toggle__switch,
    .can-toggle input[type="checkbox"]:checked:hover ~ label .can-toggle__switch {
        background-color: var(--ts-bg-color-checked-hover, #5fc054);
    }

    .can-toggle
    input[type="checkbox"]:checked:focus
    ~ label
    .can-toggle__switch:after,
    .can-toggle
    input[type="checkbox"]:checked:hover
    ~ label
    .can-toggle__switch:after {
        color: var(--ts-thumb-bg-color-checked-hover, #47a43d);
    }

    .can-toggle label .can-toggle__switch {
        transition: background-color 0.3s cubic-bezier(0, 1, 0.5, 1);
        background: var(--ts-bg-color, #848484);
    }

    .can-toggle label .can-toggle__switch:before {
        color: var(--ts-color, rgba(255, 255, 255, 0.5));
    }

    .can-toggle label .can-toggle__switch:after {
        transition: transform 0.3s cubic-bezier(0, 1, 0.5, 1);
        color: var(--ts-thumb-color, #777);
    }

    .can-toggle input[type="checkbox"]:focus ~ label .can-toggle__switch:after,
    .can-toggle input[type="checkbox"]:hover ~ label .can-toggle__switch:after {
        box-shadow: var(--ts-box-shadow, 0 3px 3px) rgba(0, 0, 0, 0.4);
    }

    .can-toggle input[type="checkbox"]:checked ~ label .can-toggle__switch:after {
        transform: translate3d(calc(var(--ts-width) + var(--ts-offset) / 2), 0, 0);
    }

    .can-toggle
    input[type="checkbox"]:checked:focus
    ~ label
    .can-toggle__switch:after,
    .can-toggle
    input[type="checkbox"]:checked:hover
    ~ label
    .can-toggle__switch:after {
        box-shadow: var(--ts-box-shadow, 0 3px 3px) rgba(0, 0, 0, 0.4);
    }

    .can-toggle label {
        font-size: 14px;
    }

    .can-toggle label .can-toggle__switch {
        height: var(--ts-height);
        flex: 0 0 calc(var(--ts-width) * 2 + var(--ts-offset) * 2);
        border-radius: var(--ts-border-radius-ext);
    }

    .can-toggle label .can-toggle__switch:before {
        left: calc(var(--ts-width) + var(--ts-offset) / 2);
        font-size: var(--ts-font-size);
        line-height: var(--ts-height);
        width: calc(var(--ts-width) + var(--ts-offset) / 2);
    }

    .can-toggle label .can-toggle__switch:after {
        left: var(--ts-offset);
        border-radius: var(--ts-border-radius-int);
        width: calc(var(--ts-width) - calc(var(--ts-offset) / 2));
        line-height: calc(var(--ts-height) - calc(var(--ts-offset) * 2));
        font-size: var(--ts-font-size);
        height: calc(100% - calc(var(--ts-offset) * 2));
    }

    .can-toggle label .can-toggle__switch:hover:after {
        box-shadow: var(--ts-box-shadow, 0 3px 3px) rgba(0, 0, 0, 0.4);
    }

    .can-toggle.can-toggle--size-small label {
        font-size: 13px;
    }

    .can-toggle.can-toggle--size-small {
        --ts-width: 45px;
        --ts-offset: 1px;
        --ts-height: 28px;
        --font-size: 10px;
        --ts-border-radius-ext: 2px;
        --ts-border-radius-int: 1px;
        --ts-box-shadow: 0 2px 2px;
    }

    .can-toggle.can-toggle--size-large {
        --ts-width: 65px;
        --ts-offset: 2px;
        --ts-height: 50px;
        --font-size: 14px;
        --ts-border-radius-ext: 4px;
        --ts-border-radius-int: 2px;
        --ts-bg-color: #c14b81;
        --ts-color: rgba(255, 255, 255, 0.5);
        --ts-thumb-color: #b53e74;
        --ts-bg-color-hover: #b53e74;
        --ts-thumb-color-hover: #a23768;
        --ts-color-hover: #8f315c;
        --ts-color-checked-hover: #39916a;
        --ts-bg-color-checked: #44ae7f;
        --ts-thumb-color-checked: #2f7757;
        --ts-bg-color-checked-hover: #3d9c72;
        --ts-box-shadow: 0 4px 4px;
    }

    .can-toggle.can-toggle--size-large label {
        font-size: 14px;
    }

    .can-toggle.can-toggle--rounded {
        --ts-width: 64px;
        --ts-height: 64px;
        --ts-offset: 2px;
        --ts-font-size: 16px;
        --ts-border-radius-ext: 64px;
        --ts-border-radius-int: 64px;
        --ts-box-shadow: 0 4px 4px;
    }

    .can-toggle.can-toggle--pill label {
        font-size: 13px;
    }

    .can-toggle.can-toggle--pill {
        --icon-w: 32px;
        --icon-h: 32px;
        --ts-width: 60px;
        --ts-offset: 2px;
        --ts-height: 40px;
        --ts-font-size: 13px;
        --ts-border-radius-ext: 60px;
        --ts-border-radius-int: 60px;
        --ts-color-disabled: rgba(68, 68, 68, 0.5);
        --ts-bg-color: #607ceb;
        --ts-color: rgb(30 30 108 / 72%);
        --ts-thumb-color: #444;
        --ts-bg-color-hover: #4d62b3;
        --ts-thumb-color-hover: #2b2b2b;
        --ts-color-hover: #6a6a6a;
        --ts-color-checked-hover: #4d62b3;
        --ts-bg-color-checked: #607ceb;
        --ts-thumb-color-checked: #607ceb;
        --ts-bg-color-checked-hover: #4d62b3;
        --ts-box-shadow: 0 4px 4px;
    }

    .can-toggle__switch svg {
        width: var(--icon-w);
        height: var(--icon-h);
        color: var(--ts-color);
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 65%;
    }

    .close-btn {
        display: block;
        margin-top: 20px;
        text-align: center;
        background-color: #ddd;
        border: none;
        padding: 10px;
        cursor: pointer;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div style="display: flex;justify-content: space-between;">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a href="#" id="trigger-modal">Add New Device +</a>
                    </div>
                </div>
                <nav x-data="{ open: false }"
                     class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <!-- Navigation Links -->
                                @foreach($devices as $device)
                                    <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <x-nav-link :href='"/dashboard/".$device->id'
                                                    :active="$device->id==$active_device->id">
                                            {{ __($device->device_name) }}
                                        </x-nav-link>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </nav>
                @if($devices->count()>0)
                    <br>
                    <div style="@if(!$active_device->online_state) display: none @endif" class="container"
                         id="online-indicator-container">
                        <div class="online-indicator">
                            <span class="blink-online"></span>
                        </div>
                        <h2 class="online-text">Device Online</h2>
                    </div>
                    <div style="@if($active_device->online_state) display: none @endif" class="container"
                         id="offline-indicator-container">
                        <div class="offline-indicator" id="0ffline-indicator-container">
                            <span class="blink-offline"></span>
                        </div>
                        <h2 class="online-text">Device Offline</h2>
                    </div>
                    <div style="display: flex;justify-content: space-around">
                        <div>
                            <br>
                            <div class="p-6 text-gray-900 dark:text-gray-100" id="voltage_reading">
                                Voltage
                            </div>
                            <div id="chartdiv_voltage" style="width: 178px;height: 100px;"></div>
                            <br>
                            <div class="p-6 text-gray-900 dark:text-gray-100" id="current_reading">
                                Current
                            </div>
                            <div id="chartdiv_current" style="width: 178px;height: 100px;"></div>
                        </div>
                        <div>
                            <br>
                            <div class="p-6 text-gray-900 dark:text-gray-100" id="voltage_reading">
                                On/Off Switch
                            </div>
                            <div class="can-toggle can-toggle--size-small">
                                <input id="b" type="checkbox" @if($active_device->power_state) checked
                                       @endif onchange="togglePower()">
                                <label for="b" style="margin-left: 38px;">
                                    <div class="can-toggle__switch" data-checked="On" data-unchecked="Off"></div>
                                </label>
                            </div>
                            <br>
                            <br>
                            <div class="p-6 text-gray-900 dark:text-gray-100" id="voltage_reading">
                                Toggle Smart Mode
                            </div>
                            <div class="can-toggle can-toggle--size-small">
                                <input id="c" type="checkbox" @if($active_device->smart_mode_state) checked
                                       @endif onchange="toggleSmartMode()">
                                <label for="c" style="margin-left: 38px;">
                                    <div class="can-toggle__switch" data-checked="On" data-unchecked="Off"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="p-6 text-gray-900 dark:text-gray-100" id="voltage_reading"
                         style="text-align-last: center;">
                        Voltage Readings Of Past 24 Hours
                    </div>
                    <div style="max-height: 40%;display: flex;justify-content: center;">
                        <canvas id="voltage_bar_graph"></canvas>
                    </div>

                    <div class="p-6 text-gray-900 dark:text-gray-100" id="voltage_reading"
                         style="text-align-last: center;">
                        Current Readings Of Past 24 Hours
                    </div>
                    <div style="max-height: 40%;display: flex;justify-content: center;">
                        <canvas id="current_bar_graph"></canvas>
                    </div>

                    <div class="p-6 text-gray-900 dark:text-gray-100" id="prediction_reading"
                         style="text-align-last: center;">
                        Power Prediction For The Next Week
                    </div>
                    <div style="max-height: 40%;display: flex;justify-content: center;">
                        <canvas id="prediction_bar_graph"></canvas>
                    </div>
                    <br>
                    <br>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
<div class="modal">
    <div class="modal-content">
        <form action="/devices/create" method="POST">
            @csrf
            <x-input-label style="color: black;" for="device_id" :value="__('Enter Device ID')"/>

            <x-text-input id="device_id" class="block mt-1 w-full" style="background-color: white;color: black;"
                          type="text"
                          name="device_id"
                          required
            />
            <br>
            <x-input-label style="color: black;" for="device_name" :value="__('Enter Device Name')"/>

            <x-text-input id="device_name" class="block mt-1 w-full" style="background-color: white;color: black;"
                          type="text"
                          name="device_name"
                          required
            />
            <div style="display: flex;    justify-content: space-between;">
                <button class="close-btn">Close</button>
                <button type="submit" class="close-btn" style="background-color: red;color: white;">Submit</button>
            </div>
        </form>
    </div>
</div>

@if (Cache::has('device_already_exists_error'))
    <script>
        alert("Device with this id already exists");
        <?php Cache::forget('device_already_exists_error'); ?>
            window.location = "/dashboard/any"
    </script>
@endif

@if($devices->count()>0)
    <script>
        power_changed_state = false;

        function togglePower() {
            const checkbox = document.querySelector('#b');
            state = checkbox.checked;

            var xhr = new XMLHttpRequest();
            xhr.timeout = 20000;
            var active_device = '<?php echo $active_device?->mqtt_device_id; ?>';
            const url = '/toggle_switch/' + active_device + '?' + 'state=' + state;
            xhr.open('GET', url);

            xhr.onload = () => {
                if (xhr.status === 200) {
                    console.log("Successfully changes power state of device")
                } else {
                    console.error(`Error: ${xhr.status}`);
                }
            };
            xhr.send();
            power_changed_state = true;
        }

        function toggleSmartMode() {
            const checkbox = document.querySelector('#c');
            state = checkbox.checked;

            var xhr = new XMLHttpRequest();
            xhr.timeout = 20000;
            var active_device = '<?php echo $active_device?->mqtt_device_id; ?>';
            const url = '/toggle_smart_mode/' + active_device + '?' + 'state=' + state;
            xhr.open('GET', url);

            xhr.onload = () => {
                if (xhr.status === 200) {
                    console.log("Successfully changes smart-mode state of device")
                } else {
                    console.error(`Error: ${xhr.status}`);
                }
            };
            xhr.send();
        }

        am4core.useTheme(am4themes_animated);

        var chartMin = 0;
        var chartMax = 100;

        var data = {
            score: 52.7,
            gradingData: [
                {
                    title: "Red",
                    advice: "Red",
                    color: "#E53935",
                    lowScore: 0,
                    highScore: 100
                }
            ]
        };

        /**
         Grading Lookup
         */
        function lookUpGrade(lookupScore, grades) {
            // Only change code below this line
            for (var i = 0; i < grades.length; i++) {
                if (
                    grades[i].lowScore < lookupScore &&
                    grades[i].highScore >= lookupScore
                ) {
                    return grades[i];
                }
            }
            return null;
        }

        // create chart
        var chart1 = am4core.create("chartdiv_voltage", am4charts.GaugeChart);
        var chart2 = am4core.create("chartdiv_current", am4charts.GaugeChart);

        var hand1 = createChart(chart1);
        var hand2 = createChart(chart2)

        function createChart(chart) {
            chart.hiddenState.properties.opacity = 0;
            chart.fontSize = 11;
            chart.innerRadius = am4core.percent(80);
            chart.resizable = true;

            chart.paddingTop = 0;
            chart.paddingBottom = 0;
            chart.paddingLeft = 0;
            chart.paddingRight = 0;

            /**
             Grade and Target above the gauge
             */
            var topContainer = chart.chartContainer.createChild(am4core.Container);
            topContainer.layout = "absolute";
            topContainer.toBack();
            topContainer.width = am4core.percent(100);

            /**
             * Normal axis
             */

            var axis = chart.xAxes.push(new am4charts.ValueAxis());
            axis.min = chartMin;
            axis.max = chartMax;
            axis.strictMinMax = true;
            axis.renderer.radius = am4core.percent(80);
            axis.renderer.inside = true;
            axis.renderer.line.strokeOpacity = 0;
            axis.renderer.ticks.template.disabled = false;
            axis.renderer.ticks.template.strokeOpacity = 0;
            axis.renderer.ticks.template.strokeWidth = 0.5;
            axis.renderer.ticks.template.length = 5;
            axis.renderer.grid.template.disabled = true;
            axis.renderer.labels.template.disabled = true;
            // axis.renderer.labels.template.radius = am4core.percent(15);
            // axis.renderer.labels.template.fontSize = "0.9em";
            // axis.renderer.labels.template.fill = am4core.color("#757575");

            /**
             * Axis for ranges
             */

            var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
            axis2.min = chartMin;
            axis2.max = chartMax;
            axis2.strictMinMax = true;
            axis2.renderer.labels.template.disabled = true;
            axis2.renderer.ticks.template.disabled = true;
            axis2.renderer.grid.template.disabled = false;
            axis2.renderer.grid.template.opacity = 0;
            axis2.renderer.labels.template.bent = true;
            axis2.renderer.labels.template.fill = am4core.color("#000");
            axis2.renderer.labels.template.fontWeight = "bold";
            axis2.renderer.labels.template.fillOpacity = 0; //hide

            /**
             Ranges
             */

            for (let grading of data.gradingData) {
                var range = axis2.axisRanges.create();
                range.axisFill.fill = am4core.color(grading.color);

                range.axisFill.fillOpacity = 1;

                range.axisFill.zIndex = -1;
                range.value = grading.lowScore > chartMin ? grading.lowScore : chartMin;
                range.endValue = grading.highScore < chartMax ? grading.highScore : chartMax;
                range.grid.strokeOpacity = 0;
                range.stroke = am4core.color(grading.color).lighten(-0.1);
                range.label.inside = true;
                range.label.text = grading.title.toUpperCase();
                range.label.inside = true;
                range.label.location = 0.5;
                range.label.inside = true;
                range.label.radius = am4core.percent(10);
                range.label.paddingBottom = -5; // ~half font size
                range.label.fontSize = "0.9em";
            }

            var matchingGrade = lookUpGrade(data.score, data.gradingData);

            /**
             * Metric Value
             */

            /**
             * Hand
             */
            var hand = chart.hands.push(new am4charts.ClockHand());
            hand.axis = axis2;
            hand.radius = am4core.percent(85);
            hand.innerRadius = am4core.percent(10);
            hand.startWidth = 10;
            hand.pixelHeight = 10;
            //hand.pin.disabled = true;
            hand.pin.radius = 8;
            hand.value = data.score;
            hand.fill = am4core.color("#444");
            hand.stroke = am4core.color("#000");
            return hand;
        }


        document.querySelector('a').addEventListener('click', function (event) {
            console.log("clicked");
            if (xhr && xhr.readyState !== 4) {
                xhr.abort();
            }
        });

        var voltage_array=JSON.parse('<?php echo($chart_data["voltage_axis"]); ?>');
        var current_array=JSON.parse('<?php echo($chart_data["current_axis"]); ?>');
        var time_array=JSON.parse('<?php echo($chart_data["times"]); ?>');

        //Voltage Line Graph Initialization
        const canvas = document.getElementById('voltage_bar_graph');
        const ctx = canvas.getContext('2d');
        const bar_graph_voltage = new Chart(ctx, {
            type: 'line',
            data: {
                labels: time_array,
                datasets: [{
                    label: 'Voltage',
                    data: voltage_array,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //Current Line Graph Initialization
        const canvas2 = document.getElementById('current_bar_graph');
        const ctx2 = canvas2.getContext('2d');
        const bar_graph_current = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: time_array,
                datasets: [{
                    label: 'Current',
                    data: current_array,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        //Power Prediction Line Graph Initialization
        const canvas3 = document.getElementById('prediction_bar_graph');
        const ctx3 = canvas3.getContext('2d');
        const bar_graph_prediction = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: JSON.parse('<?php echo(json_encode(json_decode($chart_data["power_prediction_chart_details"],true)["prediction_dates"])); ?>'),
                datasets: [{
                    label: 'Power Predicction',
                    data: JSON.parse('<?php echo(json_encode(json_decode($chart_data["power_prediction_chart_details"],true)["prediction_values"])); ?>'),
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                }
            }
        });

        var update_charts=true;
        window.onload = function () {
            setInterval(function () {
                //Get latest reading for voltage and current
                var xhr = new XMLHttpRequest();
                xhr.timeout = 20000;
                var active_device = '<?php echo $active_device?->mqtt_device_id; ?>';
                const url = '/getReadings/' + active_device;
                xhr.open('GET', url);

                xhr.onload = () => {
                    if (xhr.status === 200) {
                        //Updating Gauge Data
                        voltage = JSON.parse(xhr.response).voltage;
                        current = JSON.parse(xhr.response).current;
                        document.getElementById("voltage_reading").innerHTML = "Voltage Reading : " + voltage.toFixed(2) + " V";
                        document.getElementById("current_reading").innerHTML = "Current Reading : " + current.toFixed(2) + " A";
                        hand1.showValue((voltage / 240) * 100, 1000, am4core.ease.cubicOut);
                        hand2.showValue((current / 10) * 100, 1000, am4core.ease.cubicOut);


                        //Updating Chart Data
                        if(update_charts) {
                            voltage_array.shift();
                            voltage_array.push(voltage.toFixed(2));
                            current_array.shift();
                            current_array.push(current.toFixed(2));
                            time_array.shift();
                            time_array.push(JSON.parse(xhr.response).datetime);
                            bar_graph_current.update();
                            bar_graph_voltage.update();
                        }
                    } else {
                        console.error(`Error: ${xhr.status}`);
                    }
                };
                xhr.send();


                //Check for anomaly notifications and display if any exists
                var xhr2 = new XMLHttpRequest();
                const url0 = '/check_for_anomaly_notification';
                xhr2.open('GET', url0);
                xhr2.onload = () => {
                    if (xhr2.status === 200) {
                        anomalies = JSON.parse(xhr2.response);
                        notification_string = "The following anomolies were detected\n";
                        if (anomalies.length > 0) {
                            anomalies.forEach(function (currentValue, index, array) {

                                var timestamp = currentValue.timestamp; // Unix timestamp in milliseconds
                                var date = new Date(timestamp); // Create a new Date object with the timestamp

                                var year = date.getFullYear();
                                var month = ("0" + (date.getMonth() + 1)).slice(-2); // Add leading zero if needed
                                var day = ("0" + date.getDate()).slice(-2); // Add leading zero if needed
                                var hours = ("0" + date.getHours()).slice(-2); // Add leading zero if needed
                                var minutes = ("0" + date.getMinutes()).slice(-2); // Add leading zero if needed
                                var seconds = ("0" + date.getSeconds()).slice(-2); // Add leading zero if needed
                                var dateString = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;

                                notification_string = notification_string + "\nVoltage : " + currentValue.voltage + "V" + "\nCurrent : " + currentValue.current + "A" + "\nDateTime : " + dateString
                            });
                            alert(notification_string);
                        }
                    } else {
                        console.error(`Error: ${xhr2.status}`);
                    }
                };
                xhr2.send();

                var active_device_id = '<?php echo $active_device?->id; ?>';

                //Check for changes in the switch state
                var xhr3 = new XMLHttpRequest();
                const url2 = '/check_switch_status/' + active_device_id;
                xhr3.open('GET', url2);
                xhr3.onload = () => {
                    if (xhr3.status === 200) {
                        switch_state = xhr3.response;
                        const power_state_checkbox = document.getElementById('b');
                        if (switch_state != 0) {
                            power_state_checkbox.checked = true;
                        } else {
                            power_state_checkbox.checked = false;
                        }
                    } else {
                        console.error(`Error: ${xhr3.status}`);
                    }
                }
                xhr3.send();


                //Check for changes in the online state
                var xhr4 = new XMLHttpRequest();
                const url3 = '/check_online_status/' + active_device_id;
                xhr4.open('GET', url3);
                xhr4.onload = () => {
                    if (xhr4.status === 200) {
                        online_status = xhr4.response;
                        var online_div = document.getElementById("online-indicator-container");
                        var offline_div = document.getElementById("offline-indicator-container");
                        if (online_status != 0) {
                            online_div.style.display = "block";
                            offline_div.style.display = "none";
                            update_charts=true;
                        } else {
                            online_div.style.display = "none";
                            offline_div.style.display = "block";
                            update_charts=false;
                        }
                    } else {
                        console.error(`Error: ${xhr4.status}`);
                    }
                }
                xhr4.send();

            }, 3000);
        };
    </script>
@endif
<script>
    /* Add new device modal*/
    const modal = document.querySelector('.modal');
    const triggerBtn = document.querySelector('#trigger-modal');
    const closeBtn = modal.querySelector('.close-btn');

    function showModal() {
        modal.style.display = 'block';
    }

    function hideModal() {
        modal.style.display = 'none';
    }

    triggerBtn.addEventListener('click', showModal);
    closeBtn.addEventListener('click', hideModal);
</script>
