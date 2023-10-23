<?php

namespace App\Http\Controllers\Api;

//import Model "Donatur"
use App\Models\Donatur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import Resource "UkomResource"
use App\Http\Resources\UkomResource;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\select;

class DonaturController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        
        $donaturs = Donatur::join('program_donasis' , 'donaturs.idprogram' , '=' , 'program_donasis.id')
        ->select('program_donasis.namaprogram' , 'donaturs.*')
        ->orderBy('donaturs.id' , 'asc')
        ->paginate(5);

        // $donaturs = Donatur::latest()->paginate(5);
        
        // $donaturs = DB::table('donaturs')
        // ->join('program_donasis' , 'donaturs.idprogram' , '=' , 'program_donasis.id')
        // ->select('donaturs.*' , 'program_donasis.namaprogram')
        // ->get();

        //return collection of posts as a resource
        return new UkomResource(true, 'List Data Donatur', $donaturs);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'idprogram'     => 'required',
            'nominal'   => 'required',
            'pembayaran'   => 'required',
            'nama'   => 'required',
            'asalkota'   => 'required',
            'telp'   => 'required',
            'email'   => 'required',
            'doa'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $donatur = Donatur::create([
            'idprogram'     => $request->idprogram,
            'nominal'   => $request->nominal,
            'pembayaran'   => $request->pembayaran,
            'dukungan'   => $request->dukungan,
            'nama'   => $request->nama,
            'asalkota'   => $request->asalkota,
            'telp'   => $request->telp,
            'email'   => $request->email,
            'doa'   => $request->doa,
        ]);

        //return response
        return new UkomResource(true, 'Data Donatur Berhasil Ditambahkan!', $donatur);
    }

    /**
     * show
     *
     * @param  mixed $donatur
     * @return void
     */
    public function show($id)
    {
        // //find donatur by ID
        // $donatur = Donatur::find($id);

        $donatur = Donatur::join('program_donasis' , 'donaturs.idprogram' , '=' , 'program_donasis.id')
        ->select('program_donasis.namaprogram' , 'donaturs.*')
        ->find($id);

        //return single post as a resource
        return new UkomResource(true, 'Detail Data Donatur!', $donatur);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'idprogram'     => 'required',
            'nominal'   => 'required',
            'pembayaran'   => 'required',
            'nama'   => 'required',
            'asalkota'   => 'required',
            'telp'   => 'required',
            'email'   => 'required',
            'doa'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $donatur = Donatur::find($id);

            //update post with new image
            $donatur->update([
                'idprogram'     => $request->idprogram,
                'nominal'   => $request->nominal,
                'pembayaran'   => $request->pembayaran,
                'dukungan'   => $request->dukungan,
                'nama'   => $request->nama,
                'asalkota'   => $request->asalkota,
                'telp'   => $request->telp,
                'email'   => $request->email,
                'doa'   => $request->doa,
            ]);

        //return response
        return new UkomResource(true, 'Data Donatur Berhasil Diubah!', $donatur);
    }
}
