<?php

namespace App\Http\Controllers;
use App\Record;
use App\Device;
use App\Sensor;
use Illuminate\Http\Request;

class RecordController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }
    public function index(){
        $result = Record::join('sensor', 'sensor.id_sensor', '=', 'record.id_sensor')
                    ->join('device', 'device.id_device', '=', 'sensor.id_device')
                    ->join('ref_sensor', 'ref_sensor.id_ref_sensor', '=', 'device.id_ref_sensor')
                    ->select('record.*', 'ref_sensor.nama as sensor', 'ref_sensor.satuan')->get();
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
        $result = Record::join('sensor', 'sensor.id_sensor', '=', 'record.id_sensor')
                    ->join('device', 'device.id_device', '=', 'sensor.id_device')
                    ->join('ref_sensor', 'ref_sensor.id_ref_sensor', '=', 'device.id_ref_sensor')
                    ->select('record.*', 'ref_sensor.nama as sensor', 'ref_sensor.satuan')->where('id_sensor',$id)->get();
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
        $id_device = $request->input('id_device');
        $id_sensor = $request->input('id_sensor');
        $key = $request->input('key');
        $cek = Device::where('id_device',$id_device)->where('key',$key)->get();
        $cek2 = Sensor::where('id_device',$id_device)->where('id_sensor',$id_sensor)->get();
        if(count($cek)==1 && count($cek2)==1){
            $result = new Record();
            $result->id_sensor = $id_sensor;
            $result->value = $request->input('value');
            $result->timestamps = false;
            if($result->save()){
                $data['code'] = 200;
                $data['result'] = 'Berhasil Tambah Data';
            }else{
                $data['code'] = 500;
                $data['result'] = 'Error';
            }
        }else{
            $data['code'] = 500;
            $data['result'] = 'invalid operation';
        }
    
        return response($data);
    }
}
