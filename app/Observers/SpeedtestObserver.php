<?php

namespace App\Observers;

use App\Exceptions\InfluxDBNotEnabledException;
use App\Speedtest;
use App\Utils\InfluxDB\InfluxDB;
use Exception;
use Log;

class SpeedtestObserver
{
    /**
     * Handle the Speedtest "created" event.
     *
     * @param  \App\Speedtest  $speedtest
     * @return void
     */
    public function created(Speedtest $speedtest)
    {
        info('trying influx');
        try {
            InfluxDB::connect()
                ->store($speedtest);
        } catch (InfluxDBNotEnabledException $e) {
            info('not enabled');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
