<?php

namespace App\Http\Controllers;
use App\Users;
use Illuminate\Http\Request;

class UsersController2 extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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

    //
}
