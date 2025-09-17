<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Nilai Kematangan</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .column {
            float: left;
        }

        .left {
            width: 25%;
        }

        .right {
            width: 70%;
            text-align: center;
            font-size: 16px;
            letter-spacing: 1px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .table-container {
            padding: auto 30px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
        }

        th {
            background-color: #63a4f7;
        }

        td:first-child,
        td:last-child {
            /* text-align: center; */
        }

        .text {
            text-indent: 30px
        }

        .textT {
            padding-left: 40px;
            padding-right: 30px;
            line-height: 23px;
        }

        .domain {
            font-weight: bold;
        }
    </style>
</head>


<body>
    <div class="row">
        <div class="column left">
            <img src="./assets/images/logos/logo-spbe.png" width="110px" style="padding-left: 35px;" />
        </div>
        <div class="column right" style="line-height: 10px">
            <p><b>LAPORAN HASIL EVALUASI</b></p>
            <p><b>SISTEM PEMERINTAHAN BERBASIS ELEKTRONIK</b></p>
            <p><b>DINAS KOMUNIKASI DAN INFORMASI KOTA KENDARI</b></p>
            <p>Alamat : Gedung Menara, Jl. Drs. H. Abdullah Silondae No.8</p>
        </div>
    </div>
    <hr />
    <div>
        <p class="text textT">Penilaian tingkat kematangan Sistem
            Pemerintahan Berbasis
            Elektronik domain layanan dan manajemen di Dinas
            Komunikasi dan
            Informasi Kota Kendari adalah sebagai berikut:</p>

        <div class="table-container">
            <table>
                <tr>
                    <th>NAMA INDEKS</th>
                    <th>NILAI</th>
                </tr>
                <tr>
                <tr>
                    <td class="domain">Domain Layanan</td>
                    <td class="domain">{{ $indeksDomain1 }}</td>
                </tr>
                @php
                    $counterLayanan = 1;
                @endphp
                @foreach ($aspeks as $aspek => $item)
                            @if ($item->id <= 2)
                                        <tr>
                                            <td width="70%">
                                                {{ $item->nama_aspek }}
                                            </td>
                                            <td width="20%">{{ $item->nilaiAspek  }}</td>
                                        </tr>
                                        @php
                                            $counterLayanan++;
                                        @endphp
                            @endif
                @endforeach
                </tr>
                <tr>
                <tr>
                    <td class="domain">Domain Manajemen</td>
                    <td class="domain">{{ $indeksDomain2 }}</td>
                </tr>
                @php
                    $counterManajemen = 1;
                @endphp
                @foreach ($aspeks as $aspek => $item)
                            @if ($item->id >= 3)
                                        <tr>
                                            <td width="70%">
                                                {{ $item->nama_aspek }}
                                            </td>
                                            <td width="20%">{{ $item->nilaiAspek  }}</td>
                                        </tr>
                                        @php
                                            $counterManajemen++;
                                        @endphp
                            @endif
                @endforeach
                </tr>
            </table>
        </div>

        <div class="table-container">
            <table>
                <tr>
                    <th>No.</th>
                    <th>Indikator</th>
                    <th>Nilai</th>
                </tr>
                <tr>
                    @foreach ($penilaian as $index => $item)
                        <tr>
                            <td width="10%">{{ $index + 1 }}</td>
                            <td width="70%">{{ \Illuminate\Support\Str::after($item->nama_indikator, ' - ') }}</td>
                            <td width="20%">{{ $item->nilai }}</td>
                        </tr>
                    @endforeach
                </tr>
            </table>
        </div>

        <p class="text textT">Hasil evaluasi menunjukkan tingkat kematangan SPBE domain layanan dan manajemen di Dinas
            Komunikasi dan
            Infromasi
            Kota Kendari adalah <b>{{ $aplikasi->predikat }}</b> dengan nilai
            <b>{{ number_format($aplikasi->kematangan, 2) }}</b>.
        </p>
    </div>

    </p>
</body>

</html>