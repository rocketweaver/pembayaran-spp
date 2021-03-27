<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>
</head>
<body>
    <style>
        h1, p, small{
            display: block;
            text-align: center
        }
        table, th, td {
            padding: 10px;
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center
        }
    </style>
    <h1>Laporan Pembayaran SPP</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Petugas</th>
                <th>Nama Siswa</th>
                <th>Tanggal Pembayaran</th>
                <th>Bulan Dibayar</th>
                <th>Tahun Dibayar</th>
                <th>SPP</th>
                <th>Total Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($pembayaran as $item)
                <tr>
                    <td>{{$i++}}</td>
                    @if (is_null($item->id_petugas))
                        <td class="text-danger">Kosong</td>
                    @else
                        <td>{{$item->petugas->nama_petugas}}</td>
                    @endif
                    @if (is_null($item->nisn))
                        <td class="text-danger">Kosong</td>
                    @else
                        <td>{{$item->siswa->nama}}</td>
                    @endif
                    <td>{{$item->tgl_bayar}}</td>
                    <td>{{$item->bulan_dibayar}}</td>
                    <td>{{$item->tahun_dibayar}}</td>
                    @if (is_null($item->nisn))
                        <td class="text-danger">Kosong</td>
                    @else
                        <td>{{$item->siswa->spp->nominal}}</td>
                    @endif
                    <td>{{$item->jumlah_bayar}}</td>
                </tr>                            
            @endforeach
        </tbody>
    </table>
    @if (auth()->user()->level != 'siswa')
        <p>Pencetak: <b>{{auth()->user()->petugas->nama_petugas}}</b></p>
    @else
        <p>Pencetak: <b>{{auth()->user()->siswa->nama}}</b></p>
    @endif
    @php
        echo "<small>".date("d-m-Y")."</small>";
    @endphp
</body>
</html>