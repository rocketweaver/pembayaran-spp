<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use App\Models\Siswa;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->level != 'siswa') {
            $petugas = Petugas::find($id);
            return view('users.edit-profile', ['users' => $petugas]);
        }
        $siswa = Siswa::find($id);
        return view('users.edit-profile', ['users' => $siswa]);
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
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed'
        ]);

        if(auth()->user()->level != 'siswa') {
            $petugas = Petugas::find($id);
            $user = User::where('id_petugas', $id);
            DB::transaction(function () use($petugas, $user, $request){
                $petugas->update([
                    'nama_petugas' => $request->nama_lengkap,
                    'username' => $request->username,
                    'password' => $request->password
                ]);

                $user->update([
                    'username' => $request->username,
                    'password' => Hash::make($request->password)
                ]);
            });

            return redirect()->route('users.edit', $petugas->id_petugas)->with('berhasil', 'data berhasil diperbarui');
        }
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
