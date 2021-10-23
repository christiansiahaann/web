<?php

namespace App\Http\Controllers;
use App\Kandang;
use Illuminate\Http\Request;

class KandangController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }
    public function index(){
        $result = Kandang::join('users', 'users.id_users', '=', 'kandang.id_users')->select('kandang.*', 'users.nama as pemilik')->get();
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
        $result = Kandang::join('users', 'users.id_users', '=', 'kandang.id_users')->select('kandang.*', 'users.nama as pemilik')->where('id_kandang',$id)->get();
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
        $result = new Kandang();
        $result->id_users = $request->input('id_users');
        $result->alamat = $request->input('alamat');
        $result->keterangan = $request->input('keterangan');
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
        $result = Kandang::where('id_kandang',$id)->first();
        $result->id_users = $request->input('id_users');
        $result->alamat = $request->input('alamat');
        $result->keterangan = $request->input('keterangan');
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
        $result = Kandang::where('id_kandang',$id)->first();
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
    public function myKandang(Request $request){

        $user = $request->input('id_user');

        $result = Kandang::join('users', 'users.id_users', '=', 'kandang.id_users')
        ->select('kandang.*', 'users.nama as pemilik')
        ->where('users.id_users', $user)
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
}
