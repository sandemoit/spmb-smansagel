<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lembar Verifikasi Jalur {{ $jalur }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .kop {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop h2 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        .kop p {
            font-size: 12px;
            margin: 3px 0;
        }

        .divider {
            border: none;
            border-top: 1px solid black;
            margin: 5px 0 15px 0;
        }

        .header-title {
            font-size: 14px;
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
        }

        .foto-container {
            width: 110px;
            text-align: center;
            vertical-align: middle;
        }

        .foto-siswa {
            width: 100px;
            height: 130px;
            object-fit: cover;
            border: 1px solid #000;
        }

        .no-border {
            border: none;
        }

        .data-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .table-bordered-none td {
            border: none;
        }
    </style>
</head>

<body>
    <div class="kop">
        <table style="border: none; width: 100%;">
            <tr style="border: none;">
                <td style="width: 15%; border: none; text-align: center; vertical-align: top;">
                    <img src="{{ public_path('logo_sumsel.png') }}" width="80" alt="Logo Sumsel">
                </td>
                <td style="width: 70%; border: none; text-align: center; vertical-align: middle;">
                    <h2 style="margin-bottom: 5px;">PEMERINTAH PROVINSI SUMATERA SELATAN</h2>
                    <h2 style="margin-top: 0; margin-bottom: 5px;">SMA NEGERI 1 GELUMBANG</h2>
                    <p style="margin-top: 0; margin-bottom: 5px;">Jalan Palembang – Prabumulih KM. 58 Gelumbang, Muara
                        Enim Sumatera Selatan</p>
                    <p style="margin-top: 0; margin-bottom: 5px;">Laman: smanegeri1gelumbang.sch.id, Pos-el:
                        smanegerisatugelumbang@ymail.com</p>
                </td>
                <td style="width: 15%; border: none; text-align: center; vertical-align: top;">
                    <img src="{{ public_path('logo.png') }}" width="80" alt="Logo Sekolah">
                </td>
            </tr>
        </table>
        <hr class="divider">

        <div class="header-title">
            LEMBAR VERIFIKASI CALON MURID BARU<br>
            SMA NEGERI 1 GELUMBANG<br>
            TP. 2025 / 2026
        </div>
    </div>

    <table>
        <tr>
            <td width="30">1</td>
            <td width="200">Nomor Pendaftaran</td>
            <td width="10">:</td>
            <td>{{ $siswa->no_pendaftaran ?? '' }}</td>
            <td rowspan="10" class="foto-container">
                <img src="{{ public_path($siswa->foto_3x4) }}" alt="Foto Siswa" class="foto-siswa">
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Tanggal Pendaftaran</td>
            <td>:</td>
            <td>{{ $siswa->created_at }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Nama calon murid baru</td>
            <td>:</td>
            <td>{{ $siswa->nama_siswa }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Jenis kelamin</td>
            <td>:</td>
            <td>{{ $siswa->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>NISN</td>
            <td>:</td>
            <td>{{ $siswa->nisn }}</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Tempat lahir</td>
            <td>:</td>
            <td>{{ $siswa->tempat_lahir }}</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Tanggal lahir</td>
            <td>:</td>
            <td>{{ $siswa->tanggal_lahir }}</td>
        </tr>
        <tr>
            <td>8</td>
            <td>No HP/WA</td>
            <td>:</td>
            <td>{{ $siswa->nomor_hp }}</td>
        </tr>
        <tr>
            <td>9</td>
            <td>Alamat email aktif</td>
            <td>:</td>
            <td>{{ $siswa->user->email }}</td>
        </tr>
        <tr>
            <td>10</td>
            <td>Nama sekolah asal</td>
            <td>:</td>
            <td>{{ $siswa->sekolah_asal }}</td>
        </tr>
        <tr>
            <td>11</td>
            <td>Tahun lulus</td>
            <td>:</td>
            <td colspan="2">{{ $siswa->tahun_lulus }}</td>
        </tr>
        <tr>
            <td>12</td>
            <td>Alamat rumah</td>
            <td>:</td>
            <td colspan="2">{{ $siswa->alamat_rumah ?? 'DESA KARANG ENDAH RT.011 RW.05' }}</td>
        </tr>
        <tr>
            <td>13</td>
            <td>Jalur Pendaftaran</td>
            <td>:</td>
            <td colspan="2">{{ $siswa->jalur_pendaftaran->nama }}</td>
        </tr>
        <tr>
            <td>14</td>
            <td>Alamat Lengkap</td>
            <td>:</td>
            <td colspan="2">{{ $siswa->alamat }}</td>
        </tr>
        <tr>
            <td>15</td>
            <td>Jarak Dari Rumah Ke Sekolah</td>
            <td>:</td>
            <td colspan="2">{{ $siswa->jarak_kesekolah }}</td>
        </tr>
        <tr>
            <td>16</td>
            <td>Lokasi Rumah</td>
            <td>:</td>
            <td colspan="2">{{ $siswa->longitude }}, {{ $siswa->latitude }}</td>
        </tr>
    </table>

    <div class="data-title">Data Nilai Rapor:</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Semester</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilais as $index => $nilai)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $nilai->nama }}</td>
                    <td>{{ $nilai->semester }}</td>
                    <td>{{ $nilai->nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>
    <div style="text-align: right; font-style: italic; margin-bottom: 10px;">
        Gelumbang, ......, Mei 2025
    </div>
    <table style="width:100%;">
        <!-- Baris Atas -->
        <tr>
            <td class="text-center no-border" style="width:50%;">Orang Tua/Wali</td>
            <td class="text-center no-border" style="width:50%;">Calon Peserta Didik</td>
        </tr>
        <tr>
            <td style="height: 80px; border: none;"></td>
            <td style="height: 80px; border: none;"></td>
        </tr>
        <tr>
            <td class="text-center no-border">________________</td>
            <td class="text-center no-border">{{ $siswa->nama_siswa }}</td>
        </tr>

        <!-- Spasi antar baris -->
        <tr>
            <td colspan="2" style="height: 40px;" class="no-border"></td>
        </tr>

        <!-- Baris Bawah -->
        <tr>
            <td class="text-center no-border">Verifikator 1</td>
            <td class="text-center no-border">Verifikator 2</td>
        </tr>
        <tr>
            <td style="height: 80px;" class="no-border"></td>
            <td style="height: 80px;" class="no-border"></td>
        </tr>
        <tr>
            <td class="text-center no-border">________________</td>
            <td class="text-center no-border">________________</td>
        </tr>
    </table>

</body>

</html>
