<?php

namespace App\Http\Controllers;


use App\Models\Bus;
use App\Models\Kota;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BusResource;

class BusController extends Controller
{
    public function index(){
        $bus = Bus::all();

        if(count($bus) > 0){
            return new busResource(true, 'List Data bus', $bus);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }
    
    public function show(Request $request){
        $bus = Bus::where('from_id',$request->keberangkatan)
            ->where('to_id',$request->tujuan)
            ->where('jadwal_keberangkatan',$request->tanggal)
            ->where('kelas', $request->kelas)
            ->get();
            return new busResource(true, 'List Data bus', $bus);
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
        $bus = Bus::create([ 
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

        return new busResource(true, 'Data Bus Berhasil Ditambahkan!', $bus);
   
    }
    public function destroy($id)
    {
        $bus= Bus::find($id);

        if(is_null($bus)){
            return response([
                'message' => 'Bus Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        if($bus->delete()){
            return response([
                'message' =>'Delete Bus Sukses',
                'data' => $bus
            ], 200);
        }
        return response([
            'message' => 'Delete Bus Gagal',
            'data' => null
        ], 400);
    }
}