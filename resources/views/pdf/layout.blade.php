<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <style>
        @page { margin: 100px 40px 60px 40px; }

        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #222; line-height: 1.5; }

        header { position: fixed; top: -80px; left: 0; right: 0; border-bottom: 2px solid #212529; padding-bottom: 6px; }
        header .nama { font-size: 18px; font-weight: bold; }
        header .sub { font-size: 10px; color: #555; }

        footer { position: fixed; bottom: -40px; left: 0; right: 0; font-size: 9px; color: #666;
                 border-top: 1px solid #bbb; padding-top: 4px; }
        footer .kanan { position: absolute; right: 0; top: 4px; }
        footer .halaman:after { content: "Halaman " counter(page); }

        h1 { font-size: 15px; margin: 0 0 4px 0; }
        .info { font-size: 10px; color: #555; margin-bottom: 8px; }

        table.data { width: 100%; border-collapse: collapse; margin-top: 8px; }
        table.data th, table.data td { border: 1px solid #888; padding: 5px 6px; vertical-align: top; }
        table.data th { background: #e9ecef; text-align: left; }
        table.data tr { page-break-inside: avoid; }
        .tengah { text-align: center; }

        .badge { padding: 1px 5px; font-size: 9px; color: #fff; background: #6c757d; }
        .badge-admin, .badge-published { background: #198754; }
        .badge-danger { background: #dc3545; }
        .badge-draft { background: #b58100; }

        .ttd { margin-top: 30px; float: right; width: 200px; text-align: center; page-break-inside: avoid; }
        .ttd .garis { margin-top: 55px; border-top: 1px solid #222; padding-top: 3px; font-weight: bold; }
    </style>
</head>
<body>
    <header>
        <div class="nama">{{ config('app.name') }}</div>
        <div class="sub">@yield('subjudul', 'Laporan resmi')</div>
    </header>

    <footer>
        <span class="kanan halaman"></span>
        Dicetak {{ now()->translatedFormat('d F Y, H:i') }}
        @isset($pencetak) oleh {{ $pencetak->name }} @endisset
    </footer>

    <div class="konten">
        @yield('content')
    </div>
</body>
</html>