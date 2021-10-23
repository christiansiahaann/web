<?php

namespace App\Http\Controllers;
use App\Users;
use Illuminate\Http\Request;

class UsersController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }
    public function index(){
        $result = Users::get();
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
        $result = Users::where('id_users',$id)->get();
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
        $result = new Users();
        $result->nama = $request->input('nama');
        $result->username = $request->input('username');
        $result->password = password_hash($request->input('password'), PASSWORD_BCRYPT);
        $result->alamat = $request->input('alamat');
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
        $result = Users::where('id_users',$id)->first();
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
        $result = Users::where('id_users',$id)->first();
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
