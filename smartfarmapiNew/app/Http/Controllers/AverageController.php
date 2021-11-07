<?php

namespace App\Http\Controllers;
use App\Record;
use App\Device;
use App\Sensor;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AverageController extends Controller
{
    public function getAverage($id_kandang,$id_ref_sensor){
        $result = Record::join('sensor', 'sensor.id_sensor', '=', 'record.id_sensor')
                    ->join('device', 'device.id_device', '=', 'sensor.id_device')
                    ->selectRaw("id_kandang, device.id_ref_sensor,avg(record.value) as value,CONVERT_TZ(now(), @@session.time_zone
                    , '+07:00') as date_wib,CONVERT_TZ(now(), @@session.time_zone,'+08:00') as date_wita,CONVERT_TZ(now(), @@session.time_zone,'+09:00') as date_wit")
                    ->groupBy('sensor.id_kandang','device.id_ref_sensor')
                    ->where('sensor.id_kandang',$id_kandang)
                    ->where('device.id_ref_sensor', $id_ref_sensor)->get();
        if(count($result)==1){
            $insert=DB::table('average')->insert(json_decode($result, true));
            $data['code'] = 200;
            $data['result'] = $result;
        }else{
            $data['code'] = 404;
            $data['result'] = null;
        }
        return response($data);
        }
}

