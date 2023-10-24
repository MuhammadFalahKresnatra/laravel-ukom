<?php

namespace App\Http\Controllers\Api;

//import Model "ProgramDonasi"
use App\Models\ProgramDonasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import Resource "UkomResource"
use App\Http\Resources\UkomResource;
use Illuminate\Support\Facades\Storage;
//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class ProgramDonasiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $programdonasis = ProgramDonasi::latest()->paginate(30);

        //return collection of posts as a resource
        return new UkomResource(true, 'List Data Program Donasi', $programdonasis);
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
            'program'     => 'required',
            'namainstansi'   => 'required',
            'telp'   => 'required',
            'email'   => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'namaprogram'   => 'required',
            'maksimaldonasi'   => 'required',
            'rincian'   => 'required',
            'namayayasan'   => 'required',
            'tujuandonasi'   => 'required',
            'alamat'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $status = 0;

        //create post
        $donatur = ProgramDonasi::create([
            'program'     => $request->program,
            'namainstansi'   => $request->namainstansi,
            'telp'   => $request->telp,
            'email'   => $request->email,
            'image'     => $image->hashName(),
            'namaprogram'   => $request->namaprogram,
            'maksimaldonasi'   => $request->maksimaldonasi,
            'rincian'   => $request->rincian,
            'namayayasan'   => $request->namayayasan,
            'tujuandonasi'   => $request->tujuandonasi,
            'alamat'   => $request->alamat,
            'status'   => $status,
        ]);

        //return response
        return new UkomResource(true, 'Data Program Donasi Berhasil Ditambahkan!', $donatur);
    }

    /**
     * show
     *
     * @param  mixed $progamdonasi
     * @return void
     */
    public function show($id)
    {
        //find donatur by ID
        // $progamdonasi = ProgramDonasi::join('donaturs' , 'program_donasis.id' , '=' , 'donaturs.idprogram')
        // ->select('donaturs.doa' , 'program_donasis.*')
        // ->find($id);
        $progamdonasi = ProgramDonasi::find($id);

        //return single post as a resource
        return new UkomResource(true, 'Detail Data Progam Donasi!', $progamdonasi);
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
            'program'     => 'required',
            'namainstansi'   => 'required',
            'telp'   => 'required',
            'email'   => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'namaprogram'   => 'required',
            'maksimaldonasi'   => 'required',
            'rincian'   => 'required',
            'namayayasan'   => 'required',
            'tujuandonasi'   => 'required',
            'alamat'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $progamdonasi = ProgramDonasi::find($id);

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/'.basename($progamdonasi->image));

            //update post with new image
            $progamdonasi->update([
                'program'     => $request->program,
                'namainstansi'   => $request->namainstansi,
                'telp'   => $request->telp,
                'email'   => $request->email,
                'image'     => $image->hashName(),
                'namaprogram'   => $request->namaprogram,
                'maksimaldonasi'   => $request->maksimaldonasi,
                'rincian'   => $request->rincian,
                'namayayasan'   => $request->namayayasan,
                'tujuandonasi'   => $request->tujuandonasi,
                'alamat'   => $request->alamat,
                'status'   => $request->status,
            ]);

        } else {

            //update post without image
            $progamdonasi->update([
                'program'     => $request->program,
                'namainstansi'   => $request->namainstansi,
                'telp'   => $request->telp,
                'email'   => $request->email,
                'namaprogram'   => $request->namaprogram,
                'maksimaldonasi'   => $request->maksimaldonasi,
                'rincian'   => $request->rincian,
                'namayayasan'   => $request->namayayasan,
                'tujuandonasi'   => $request->tujuandonasi,
                'alamat'   => $request->alamat,
                'status'   => $request->status,
            ]);
        }

        //return response
        return new UkomResource(true, 'Data Program Donasi Berhasil Diubah!', $progamdonasi);
    }
}
