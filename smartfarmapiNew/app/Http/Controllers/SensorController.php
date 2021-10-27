<?php

namespace App\Http\Controllers;
use App\Record;
use App\Device;
use App\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }
    public function index(){
        $result = Sensor::join('kandang', 'kandang.id_kandang', '=', 'sensor.id_kandang')
                    ->join('device', 'device.id_device', '=', 'sensor.id_device')
                    ->join('ref_sensor', 'ref_sensor.id_ref_sensor', '=', 'device.id_ref_sensor')
                    ->select('sensor.*', 'kandang.alamat', 'kandang.keterangan', 'ref_sensor.nama as sensor')->get();
        if(count($result)>0){
            $data['code'] = 200;
            $data['result'] = $result;
        }else{
            $data['code'] = 404;
            $data['result'] = null;
        }
        return response($data);
    }
    public function show($id){
        $result = Sensor::join('kandang', 'kandang.id_kandang', '=', 'sensor.id_kandang')
                    ->join('device', 'device.id_device', '=', 'sensor.id_device')
                    ->join('ref_sensor', 'ref_sensor.id_ref_sensor', '=', 'device.id_ref_sensor')
                    ->select('sensor.*', 'kandang.alamat', 'kandang.keterangan', 'ref_sensor.nama as sensor')->where('id_sensor',$id)->get();
        if(count($result)==1){
            $data['code'] = 200;
            $data['result'] = $result;
        }else{
            $data['code'] = 404;
            $data['result'] = null;
        }
        return response($data);
    }
    public function store(Request $request){
        $result = new Sensor();
        $result->id_kandang = $request->input('id_kandang');
        $result->id_device = $request->input('id_device');
        if($result->save()){
            $data['code'] = 200;
            $data['result'] = 'Berhasil Tambah Data';
        }else{
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
    
        return response($data);
    }
    public function update(Request $request, $id){
        $result = Sensor::where('id_kandang',$id)->first();
        $result->id_kandang = $request->input('id_kandang');
        $result->id_device = $request->input('id_device');
        if($result->save()){
            $data['code'] = 200;
            $data['result'] = 'Berhasil Mengubah Data';
        }else{
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
    
        return response($data);
    }
    public function destroy($id){
        $result = Sensor::where('id_kandang',$id)->first();
        if($result->delete()){
            $data['code'] = 200;
            $data['result'] = 'Berhasil Menghapus Data';
        }else{
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
    
        return response($data);
    }

    // Update Tim Smart Farm Baru
    public function mySensor( $id_kandang )
    {
        $kandang = $id_kandang;

        $result = Sensor::join('kandang', 'kandang.id_kandang', '=', 'sensor.id_kandang')
                    ->join('device', 'device.id_device', '=', 'sensor.id_device')
                    ->join('ref_sensor', 'ref_sensor.id_ref_sensor', '=', 'device.id_ref_sensor')
                    ->select('sensor.*', 'kandang.alamat', 'kandang.keterangan', 'ref_sensor.nama as sensor')
                    ->where('kandang.id_kandang', $kandang)
                    ->get();

        if(count($result)>0){
            $data['code'] = 200;
            $data['result'] = $result;
        }else{
            $data['code'] = 404;
            $data['result'] = null;
        }
        return response($data);
    }

    public function mySensorWithType( $id_kandang , $type_sensor )
    {
        $kandang = $id_kandang;
        $type_sensor = $type_sensor;

        $result = Sensor::join('kandang', 'kandang.id_kandang', '=', 'sensor.id_kandang')
                    ->join('device', 'device.id_device', '=', 'sensor.id_device')
                    ->join('ref_sensor', 'ref_sensor.id_ref_sensor', '=', 'device.id_ref_sensor')
                    ->select('sensor.*', 'kandang.alamat', 'kandang.keterangan', 'ref_sensor.nama as sensor')
                    ->where('kandang.id_kandang', $kandang)
                    ->where('ref_sensor.nama', $type_sensor)
                    ->get();

        if(count($result)>0){
            $data['code'] = 200;
            $data['result'] = $result;
        }else{
            $data['code'] = 404;
            $data['result'] = null;
        }
        return response($data);
    }
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
