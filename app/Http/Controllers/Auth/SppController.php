<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Models\Spp;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spp = Spp::paginate();
        return view('spp.index', ['spp' => $spp]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spp.create');
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
            'tahun' => 'required|integer',
            'nominal' => 'required|integer',
        ]);

        Spp::create([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        // return Helper::successMessage($request, 'dtambahkan', 'spp');
        return redirect()->route('spp.index');
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
        $spp = Spp::find($id);
        return view('spp.edit', ['spp' => $spp]);
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
        $spp = spp::findOrFail($id);

        $this->validate($request, [
            'tahun' => 'required|integer',
            'nominal' => 'required|integer',
        ]);

        $spp->update([
            'spp' => $request->spp,
            'nominal' => $request->nominal,
        ]);

        return Helper::successMessage($spp, 'dperbarui', 'spp');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spp = Spp::findOrFail($id);
        $spp->delete();
        return Helper::successMessage($spp, 'dihapus', 'spp');
    }
}
