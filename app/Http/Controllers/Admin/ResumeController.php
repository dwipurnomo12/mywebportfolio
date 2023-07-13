<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.section-resume.index', [
            'pendidikans'   => Pendidikan::all(),
            'pekerjaans'    => Pekerjaan::all()
        ]);
    }

     /**
     * Pendidikan store.
     */
    public function pendidikanStore(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'nama_sekolah'  => 'required',
            'tahun'         => 'required',
            'jurusan'       => 'required',
            'deskripsi'     => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status'    => 'error',
            ], 422);
        }

        $newPendidikan = new Pendidikan();
        $newPendidikan->nama_sekolah = $request->input('nama_sekolah');
        $newPendidikan->tahun        = $request->input('tahun');
        $newPendidikan->jurusan      = $request->input('jurusan');
        $newPendidikan->deskripsi    = $request->input('deskripsi');
        $newPendidikan->save();

        return response()->json([
            'status'    => 'success'
        ]);
    }

    /**
     * Pekerjaan store.
     */
    public function pekerjaanStore(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'nama_perusahaan'   => 'required',
            'tahun_krja'        => 'required',
            'posisi'            => 'required',
            'deskripsi_krja'    => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status'    => 'error',
            ], 422);
        }

        $newPekerjaan = new Pekerjaan();
        $newPekerjaan->nama_perusahaan = $request->input('nama_perusahaan');
        $newPekerjaan->tahun           = $request->input('tahun_krja');
        $newPekerjaan->posisi          = $request->input('posisi');
        $newPekerjaan->deskripsi       = $request->input('deskripsi_krja');
        $newPekerjaan->save();

        return response()->json([
            'status'    => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pendidikan  = Pendidikan::find($id);
        $pekerjaan   = Pekerjaan::find($id);

        if($pendidikan){
            $pendidikan->delete();
        }elseif($pekerjaan){
            $pekerjaan->delete();
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        
        return response()->json([
            'success'   => true,
            'message'   => 'Berhasil dihapus'
        ]);  
    }
}
