<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nomor Antrean {{ $antrian->nomor_antrian }}</title>

    <style>
        /* Pengaturan Ukuran Kertas Struk (Roll Paper) */
        @page {
            size: 80mm auto; /* Lebar kertas 80mm standar struk dengan panjang otomatis */
            margin: 0;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #334155; 
            background: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact; /* Memaksa warna muncul saat cetak PDF */
        }

        /* Container utama struk */
        .struk-container {
            width: 280px; /* Ukuran aman kertas thermal 80mm agar tidak terpotong tepi */
            margin: 0 auto;
            padding: 15px 5px;
            text-align: center;
            box-sizing: border-box;
        }

        /* Elemen Gambar Logo */
        .logo {
            width: 300px; 
            height: auto;
            margin-bottom: 3px;
            display: inline-block;
        }

        /* Garis putus-putus berwarna biru utama */
        .border-dashed {
            border-top: 2px dashed #0284c7;
            margin: 12px 0;
            height: 0;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1px;
            color: #0f172a;
            margin-bottom: 12px;
        }

        /* Box Nomor Antrean Utama Berwarna Biru */
        .queue-box {
            border: 2px solid #0369a1;
            border-radius: 10px;
            padding: 14px 5px;
            margin-bottom: 12px;
            background-color: #eff6ff; /* Background biru sangat muda */
        }

        .number {
            font-size: 56px; 
            font-weight: bold;
            line-height: 1;
            color: #0369a1; /* Angka antrean berwarna biru tegas */
            margin-bottom: 6px;
        }

        .service {
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            color: #1e293b;
        }

        .text {
            font-size: 11px;
            line-height: 1.5;
            margin: 4px 0;
            color: #334155;
        }

        /* Box Kode Booking dengan warna aksen biru langit */
        .booking {
            margin: 12px 0;
            border: 1px dashed #0284c7;
            background: #f0f9ff;
            padding: 6px;
            font-size: 12px;
            font-weight: bold;
            color: #0369a1;
            border-radius: 6px;
        }

        /* Catatan Kaki */
        .note {
            margin-top: 10px;
            font-size: 9.5px;
            line-height: 1.4;
            text-align: left;
            color: #475569;
        }

        .footer {
            margin-top: 16px;
            font-size: 9px;
            color: #94a3b8;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="struk-container">
        
        <img src="{{ public_path('image/logo-bpsbiru.png') }}" class="logo" alt="Logo BPS">
        <div class="border-dashed"></div>

        <!-- JUDUL -->
        <div class="title">NOMOR ANTREAN</div>

        <!-- KARTU NOMOR BERWARNA BIRU -->
        <div class="queue-box">
            <div class="number">
                {{ $antrian->nomor_antrian }}
            </div>
            <div class="service">
                {{ $antrian->layanan->nama_layanan }}
            </div>
        </div>

        <!-- INFORMASI -->
        <p class="text">
            <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($antrian->tanggal_antrian)->format('d-m-Y') }} {{ $antrian->created_at->format('H:i') }} WIB
        </p>
        
        <p class="text" style="color: #0369a1; font-weight: bold; margin-top: 6px; font-size: 11.5px;">
            Silakan menuju ruang tunggu PST
        </p>

        <!-- BOOKING -->
        <div class="booking">
            KODE BOOKING: {{ $antrian->kode_booking }}
        </div>

        <div class="border-dashed"></div>

        <!-- CATATAN -->
        <div class="note">
            <b>*</b> Berlaku khusus tanggal {{ \Carbon\Carbon::parse($antrian->tanggal_antrian)->format('d-m-Y') }}.
            <br>
            <b>*</b> Tunjukkan struk ini kepada petugas saat tiba di lokasi untuk melakukan validasi.
        </div>

        <!-- FOOTER -->
        <div class="footer">
            -- Terima Kasih --<br>
            Sistem Antrean Online BPS Provinsi Kepulauan Bangka Belitung
        </div>

    </div>

</body>
</html>