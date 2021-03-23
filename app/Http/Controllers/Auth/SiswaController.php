<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::all();
        return view('siswa.index', ['siswa' => $siswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn' => 'required|max:10',
            'nis' => 'required|max:8',
            'nama' => 'required|max:35',
            'id_kelas' => 'required|integer',
            'alamat' => 'required',
            'no_telp' => 'required|max:13',
            'id_spp' => 'required|integer'
        ]);

        DB::transaction(function () use($request) {
            $siswa = Siswa::create([
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'id_spp' => $request->id_spp
            ]);
    
            User::create([
                'nisn' => $siswa->nisn,
                'username' => $siswa->nis,
                'password' => Hash::make($siswa->nis),
                'level' => 'siswa'
            ]);
        });

        return Helper::successMessage($request, 'ditambahkan', 'siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        $user = User::where('nisn', $nisn);

        $this->validate($request, [
            'nisn' => 'required|max:10',
            'nis' => 'required|max:8',
            'nama' => 'required|max:35',
            'id_kelas' => 'required|integer',
            'alamat' => 'required',
            'no_telp' => 'required|max:13',
            'id_spp' => 'required|integer'
        ]);

        DB::transaction(function () use($id, $request, $siswa, $user) {
            $siswa->update([
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'id_spp' => $request->id_spp
            ]);
            
            $user->update([
                'nisn' => $request->nisn,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'level' => $request->level
            ]);
        });

        return Helper::successMessage($request, 'diperbarui', 'siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        $user = User::where('nisn', $nisn);

        DB::transaction(function () use($user, $siswa){
            $user->delete();
            $siswa->delete();
        });

        return Helper::successMessage($siswa, 'dihapus', 'siswa');
    }
}
