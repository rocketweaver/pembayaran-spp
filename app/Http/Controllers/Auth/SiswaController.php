<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\User;
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
    public function index(Request $request)
    {
        $namaOrKelas = $request->nama_or_kelas;
        if(!is_null($namaOrKelas)) {
            $filteredSiswa = Siswa::whereHas('kelas', function ($query) use($namaOrKelas) {
                $query->where('nama_kelas', 'like', '%'.$namaOrKelas.'%');
            })->orWhere('nama', 'like', '%'.$namaOrKelas.'%')->orderBy('id_kelas')->orderBy('nama', 'asc')->paginate(10);
            return view('siswa.index', ['filteredSiswa' => $filteredSiswa]);
        }
        $siswa = Siswa::orderBy('id_kelas')->orderBy('id_kelas')->orderBy('nama', 'asc')->paginate(10);
        return view('siswa.index', ['siswa' => $siswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('siswa.create', ['kelas' => $kelas, 'spp' => $spp]);
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
            'nama' => 'required|string|max:35',
            'kelas' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required|max:13',
            'spp' => 'required'
        ]);

        DB::transaction(function () use($request) {
            $siswa = Siswa::create([
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'id_kelas' => $request->kelas,
                'alamat' => $request->alamat,
                'no_telp' => $request->nomor_telepon,
                'id_spp' => $request->spp
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
    // public function show($id)
    // {
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nisn)
    {
        $siswa = Siswa::find($nisn);
        $kelas = Kelas::all();
        $spp = Spp::all();

        return view('siswa.edit', ['kelas' => $kelas,'siswa' => $siswa, 'spp' => $spp]);
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
            'nama' => 'required|string|max:35',
            'alamat' => 'required',
            'nomor_telepon' => 'required|max:13',
        ]);

        DB::transaction(function () use($request, $siswa, $user) {
            $siswa->update([
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'no_telp' => $request->nomor_telepon,
                'id_spp' => $request->id_spp
            ]);
            
            $user->update([
                'username' => $request->nis,
                'password' => Hash::make($request->nis),
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

        $siswa->delete();

        return Helper::successMessage($siswa, 'dihapus', 'siswa');
    }
}
