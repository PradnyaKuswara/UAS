<?php

namespace App\Http\Controllers;


use App\Models\Kereta;
use App\Models\Kota;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\KeretaResource;

class KeretaController extends Controller
{
    public function index(){
        $kereta = Kereta::all();

        if(count($kereta) > 0){
            return new KeretaResource(true, 'List Data Kereta', $kereta);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }
    
    public function show(Request $request){
        $kereta = Kereta::where('from_id',$request->keberangkatan)
            ->where('to_id',$request->tujuan)
            ->where('jadwal_keberangkatan',$request->tanggal)
            ->where('kelas', $request->kelas)
            ->get();
            return new KeretaResource(true, 'List Data Kereta', $kereta);
       }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required|numeric',
            'from_id' => 'required|numeric',
            'to_id' => 'required|numeric',
            'kelas' => 'required|numeric',
            'jadwal_keberangkatan' => 'required', //date
            'jam_keberangkatan' => 'required',
            'jadwal_tiba' => 'required', //date
           'jam_tiba' => 'required'
        ]);

        if($validator->fails()) {
           return response()->json($validator->errors(), 422); 
        }
        $kereta = Kereta::create([ 
            'name' => $request->name, 
            'user_id' => $request->user_id, 
            'from_id' => $request->from_id,
            'to_id' => $request->to_id,
            'kelas' => $request->kelas,
            'jadwal_keberangkatan' => $request->jadwal_keberangkatan,
            'jam_keberangkatan' => $request->jam_keberangkatan,
            'jadwal_tiba' => $request->jadwal_tiba,
            'jam_tiba' => $request->jam_tiba
        ]);

        return new KeretaResource(true, 'Data Kereta Berhasil Ditambahkan!', $kereta);
   
    }
    public function destroy($id)
    {
        $kereta= Kereta::find($id);

        if(is_null($kereta)){
            return response([
                'message' => 'Kereta Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        if($kereta->delete()){
            return response([
                'message' =>'Delete Kereta Sukses',
                'data' => $kereta
            ], 200);
        }
        return response([
            'message' => 'Delete Kereta Gagal',
            'data' => null
        ], 400);
    }
}