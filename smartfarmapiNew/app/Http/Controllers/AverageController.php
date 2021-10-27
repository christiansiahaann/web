<?php

namespace App\Http\Controllers;
use App\Record;
use App\Device;
use App\Sensor;
use Illuminate\Http\Request;

class AverageController extends Controller
{
    public function getAverage($id_kandang,$id_ref_sensor){
        $result = Record::join('sensor', 'sensor.id_sensor', '=', 'record.id_sensor')
                    ->join('device', 'device.id_device', '=', 'sensor.id_device')
                    ->selectRaw('id_kandang, device.id_ref_sensor,avg(record.value) as average')
                    ->groupBy('sensor.id_kandang','device.id_ref_sensor')
                    ->where('sensor.id_kandang',$id_kandang)
                    ->where('device.id_ref_sensor', $id_ref_sensor)->get();
        if(count($result)==1){
            $data['code'] = 200;
            $data['result'] = $result;
        }else{
            $data['code'] = 404;
            $data['result'] = null;
        }
        return response($data);
        }
}

