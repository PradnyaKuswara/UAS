<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        // return redirect('/');
        $users = User::all();
        if(count($users)>0) {
            return new UserResource(true, 'Data User Berhasil Diambil!', $users);
        }
        return new UserResource(true, 'Data User Kosong!', $users);
    }

    public function show($id) {
        $users = User::find($id); //find user by id

        if (!is_null($users)) {
            return new UserResource(true, 'Data User Berhasil Diambil!', $users);
        }
        return new UserResource(true, 'Data User Kosong!', $users);
    }

    public function store(Request $request){
        $regis = $request->all();
        
        $validatedData = Validator::make($regis,[
            'name' => 'max:60|not_regex:/^(admin)$/i',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:6|regex:/^.*(?=.{4,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'image' => 'required|image|file|max:2048|mimes:jpg,png,jpeg',
            'type' => 'required'
        ]);
        if($validatedData->fails()) {
            return response(['message' => $validatedData->errors()], 400); //return validation if error in input
        }
        
        if( $request->hasFile('image')) {
            $path = $request->file('image')->store('user-images');
            $regis['image'] =$path;
        }
        $regis['password'] = bcrypt($request->password);
        
        $user = User::create($regis);
        // return redirect('/login')->with('success', 'Pendaftaran Berhasil! Silahkan Masuk Untuk Melanjutkan');
        return new UserResource(true, 'Data User Berhasil Ditambahkan!', $user);
    }
    
    public function update(Request $request, $id){

        $user = User::find($id);
        $temp= $user->email;

        $validate = Validator::make($request->all(), [ 
            'name' => 'max:60|not_regex:/^(admin)$/i',
            'email' => 'email:rfc,dns'
        ]); 
        
        if($validate->fails()) {
            return response(['message' => $validate->errors()], 400); //return validation if error in input
        }
       
        if($request->name){
            $user->name = $request->name;
        }
        if($request->email){
            $user->email = $request->email;
        }
        if($request->password){
            $validate2 = Validator($request->all(), [ 
                'password' => 'min:6|regex:/^.*(?=.{4,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
            ]);
            if($validate2->fails()) {
                return response(['message' => $validate2->errors()], 400); //return validation if error in input
            }
            $user->password = bcrypt($request->password);
        }

        if( $request->hasFile('image')) {
            $validate3 = Validator($request->all(), [ 
                'image' => 'image|file|max:2048|mimes:jpg,png,jpeg',
            ]);
            if($validate3->fails()) {
                return response(['message' => $validate3->errors()], 400); //return validation if error in input
            }
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $path = $request->file('image')->store('user-images');
            $user->image =$path;
        }

        $user->save();
        // return redirect('/profile');
        return new UserResource(true, 'Data User Berhasil Diupdate!', $user);

    }

    public function destroy($id){
        $users = User::find($id);

        if(is_null($users)) {
            return new UserResource(true, 'Data User Tidak Ditemukan!', $users);
        }
        if($users->delete()){
            return new UserResource(true, 'Data User Berhasil Dihapus!', $users);
        } //return if user has been deleted

        return new UserResource(true, 'Data User Gagal Dihapus!', $users);
        // return redirect('/profile');

    }
}