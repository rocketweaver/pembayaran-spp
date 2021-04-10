<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Models\Kelas;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!is_null($request->nama_kelas)) {
            $filteredKelas = Kelas::where('nama_kelas', 'like', '%'.$request->nama_kelas.'%')->orderBy('kompetensi_keahlian', 'asc')->orderBy('nama_kelas', 'asc')->paginate(10);
            return view('kelas.index', ['filteredKelas' => $filteredKelas]);
        }

        $kelas = Kelas::orderBy('kompetensi_keahlian', 'asc')->orderBy('nama_kelas', 'asc')->paginate(50);
        return view('kelas.index', ['kelas' => $kelas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelas.create');
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
            'nama_kelas' => 'required|max:10|unique:kelas',
            'kompetensi_keahlian' => 'required|max:50',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
        ]);

        return Helper::successMessage($request, 'dtambahkan', 'kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Request $request)
    // {
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::find($id);
        return view('kelas.edit', ['kelas' => $kelas]);
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
        $kelas = Kelas::findOrFail($id);

        $this->validate($request, [
            'nama_kelas' => 'required|max:10',
            'kompetensi_keahlian' => 'required|max:50',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
        ]);

        return Helper::successMessage($kelas, 'dperbarui', 'kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return Helper::successMessage($kelas, 'dihapus', 'kelas');
    }
}
