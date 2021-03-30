<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Petugas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bulanOrTahun = $request->bulan_or_tahun; 
        if (!is_null($bulanOrTahun)) {
            $filteredPembayaran = Pembayaran::where('bulan_dibayar', 'like', '%'.$bulanOrTahun.'%')->orWhere('tahun_dibayar', 'like', '%'.$bulanOrTahun.'%')->orderBy('tgl_bayar', 'asc')->paginate(10);
            return view('pembayaran.index', ['filteredPembayaran' => $filteredPembayaran]);
        }
        $pembayaran = Pembayaran::orderBy('tgl_bayar', 'asc')->paginate(10);
        return view('pembayaran.index', ['pembayaran' => $pembayaran]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->level == 'siswa') {
            return redirect()->route('pembayaran.index');
        } else {
            $petugas = Petugas::all();
            $siswa = Siswa::all();
            return view('pembayaran.create', ['petugas' => $petugas, 'siswa' => $siswa]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->level == 'siswa') {
            return redirect()->route('pembayaran.index');
        } else {
            $this->validate($request, [
                'petugas' => 'required',
                'siswa' => 'required',
                'tanggal_pembayaran' => 'required',
                'tahun_pembayaran' => 'required|max:4',
                'jumlah_pembayaran' => 'required|integer'
            ]);
    
            if (Pembayaran::where('nisn', $request->siswa)->where('bulan_dibayar', $request->bulan_pembayaran)->where('tahun_dibayar', $request->tahun_pembayaran)->exists()) {
                return back()->with('custom-message', 'Pembayaran telah dilakukan')->with('error-border', 'border-red');
            } else {
                DB::transaction(function () use($request) {
                    $pembayaran = Pembayaran::create([
                        'id_petugas' => $request->petugas,
                        'nisn' => $request->siswa,
                        'tgl_bayar' => $request->tanggal_pembayaran,
                        'bulan_dibayar' => $request->bulan_pembayaran,
                        'tahun_dibayar' => $request->tahun_pembayaran,
                        'jumlah_bayar' => $request->jumlah_pembayaran
                    ]);
                });
    
                return Helper::successMessage($request, 'ditambahkan', 'pembayaran');
            } 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nisn)
    {
        if (auth()->user()->level == 'siswa') {
            $pembayaran = Pembayaran::where('nisn', $nisn)->orderBy('tgl_bayar')->paginate(10);
    
            return view('pembayaran.index', ['pembayaran' => $pembayaran]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pembayaran = Pembayaran::find($id);
        $petugas = Petugas::all();
        $siswa = Siswa::all();
        return view('pembayaran.edit', ['pembayaran' => $pembayaran, 'petugas' => $petugas, 'siswa' => $siswa]);
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
        if (auth()->user()->level == 'siswa') {
            return redirect()->route('pembayaran.index');
        } else {
            $pembayaran = Pembayaran::findOrFail($id);

            $this->validate($request, [
                'tanggal_pembayaran' => 'required',
                'tahun_pembayaran' => 'required|max:4',
                'jumlah_pembayaran' => 'required|integer'
            ]);
    
            if (Pembayaran::where('nisn', $request->siswa)->where('bulan_dibayar', $request->bulan_pembayaran)->where('tahun_dibayar', $request->tahun_pembayaran)->exists()) {
                return back()->with('custom-message', 'Pembayaran telah dilakukan')->with('error-border', 'border-red');
            } else {
                $pembayaran->update([
                    'id_petugas' => $request->petugas,
                    'nisn' => $request->siswa,
                    'tgl_bayar' => $request->tanggal_pembayaran,
                    'bulan_dibayar' => $request->bulan_pembayaran,
                    'tahun_dibayar' => $request->tahun_pembayaran,
                    'jumlah_bayar' => $request->jumlah_pembayaran
                ]);
                return Helper::successMessage($request, 'diperbarui', 'pembayaran');
            } 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->level == 'siswa') {
            return redirect()->route('pembayaran.index');
        } else {
            $pembayaran = Pembayaran::findOrFail($id);
    
            $pembayaran->delete();
    
            return Helper::successMessage($pembayaran, 'dihapus', 'pembayaran');
        }
    }

    public function exportPdf()
    {
        $pembayaran = Pembayaran::all();
 
    	$pdf = PDF::loadview('pembayaran.export-pdf', ['pembayaran'=>$pembayaran]);
    	return $pdf->download('laporan-pembayaran.pdf');
    }
}
