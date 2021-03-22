<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helper\Helper;
use App\Models\Petugas;
use App\Models\User;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = Petugas::all();
        return view('petugas.index', ['petugas' => $petugas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas.create');
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
            'nama_petugas' => 'required|max:35',
            'username' => 'required|max:25',
            'password' => 'required|confirmed',
            'level' => 'required'
        ]);

        DB::transaction(function () use($request) {
            $petugas = Petugas::create([
                'nama_petugas' => $request->nama_petugas,
                'username' => $request->username,
                'password' => $request->password,
                'level' => $request->level
            ]);
    
            User::create([
                'id_petugas' => $petugas->id_petugas,
                'password' => Hash::make($petugas->password),
                'username' => $petugas->username,
                'level' => $petugas->level
            ]);
        });

        return Helper::successMessage($request, 'ditambahkan', 'petugas');
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
        $petugas = Petugas::find($id);
        return view('petugas.edit', ['petugas' => $petugas]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);
        $user = User::where('id_petugas', $id);

        $this->validate($request, [
            'nama_petugas' => 'required|max:35',
            'username' => 'required|max:25',
            'password' => 'required|confirmed',
            'level' => 'required'
        ]);

        DB::transaction(function () use($id, $request, $petugas, $user) {
            $petugas->update([
                'nama_petugas' => $request->nama_petugas,
                'username' => $request->username,
                'password' => $request->password,
                'level' => $request->level
            ]);
            
            $user->update([
                'id_petugas' => $id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'level' => $request->level
            ]);
        });

        return Helper::successMessage($request, 'diperbarui', 'petugas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $user = User::where('id_petugas', $id);

        DB::transaction(function () use($user, $petugas){
            $user->delete();
            $petugas->delete();
        });

        return Helper::successMessage($petugas, 'dihapus', 'petugas');
    }
}
