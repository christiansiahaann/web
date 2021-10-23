<?php

namespace App\Http\Controllers;
use App\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }
    public function index(){
        $result = Device::join('ref_sensor', 'ref_sensor.id_ref_sensor', '=', 'device.id_ref_sensor')->select('device.*', 'ref_sensor.nama as sensor')->get();
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
        $result = Device::join('ref_sensor', 'ref_sensor.id_ref_sensor', '=', 'device.id_ref_sensor')->select('device.*', 'ref_sensor.nama as sensor')->where('id_device',$id)->get();
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
        $result = new Device();
        $result->id_ref_sensor = $request->input('id_ref_sensor');
        $result->key = $request->input('key');
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
        $result = Device::where('id_device',$id)->first();
        $result->key = $request->input('key');
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
        $result = Device::where('id_device',$id)->first();
        if($result->delete()){
            $data['code'] = 200;
            $data['result'] = 'Berhasil Menghapus Data';
        }else{
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
    
        return response($data);
    }

    //
}
