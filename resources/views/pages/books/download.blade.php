<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <style>

        body{
            font-family: sans-serif;
            font-size:12px;
        }

        .header{
            text-align:center;
            margin-bottom:15px;
        }

        .header h2{
            margin:0;
        }

        .header p{
            margin:3px;
        }

        hr{
            border:1px solid black;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th,
        table td{
            border:1px solid black;
            padding:6px;
        }

        table th{
            text-align:center;
        }

        .title{
            text-align:center;
            margin-bottom:15px;
        }

        .footer{
            margin-top:40px;
            width:100%;
        }

        .signature{
            width:200px;
            float:right;
            text-align:center;
        }

        .watermark{
            position: fixed;
            top: 40%;
            left: 15%;
            transform: rotate(-35deg);
            font-size: 90px;
            color: rgba(180,180,180,0.25);
            z-index: -1000;
            font-weight: bold;
        }

        .watermark img{
            width:350px;
            opacity:0.1;
        }
    </style>

</head>

<body>
    <div class="watermark"> DRAFT </div>
    {{-- <div class="watermark">
        <img src="{{ public_path('logo.png') }}">
    </div> --}}
    
    <div class="header">

        <h2>PERPUSTAKAAN XYZ</h2>

        <p>Jl. Contoh No.123</p>

        <p>Telp. 08123456789</p>

    </div>

    <hr>

    <div class="title">

        <h3>LAPORAN DATA BUKU</h3>

        <p>
            Tanggal Cetak :
            {{ now()->format('d F Y') }}
        </p>

    </div>

    <table>

        <thead>

            <tr>

                <th>No</th>

                <th>Judul</th>

                <th>Kategori</th>

                <th>Penulis</th>

                <th>Tahun</th>

                <th>Stok</th>

            </tr>

        </thead>

        <tbody>

            @foreach($data as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->judul }}</td>

                    <td>{{ $item->category->nama_kategori }}</td>

                    <td>{{ $item->penulis }}</td>

                    <td>{{ $item->tahun_terbit }}</td>

                    <td>{{ $item->stok }}</td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="footer">

        <div class="signature">

            <p>{{ now()->format('d F Y') }}</p>

            <br><br><br>

            <p>(Administrator)</p>

        </div>

    </div>

{{-- nomor halaman --}}
<script type="text/php">
if (isset($pdf)) {

    $x = 520;
    $y = 820;

    $text = "Halaman {PAGE_NUM} / {PAGE_COUNT}";

    $font = $fontMetrics->get_font("Helvetica");

    $size = 10;

    $pdf->page_text($x, $y, $text, $font, $size);
}
</script>
</body>

</html>