<!DOCTYPE html>
<html>
<head>
    <title>Rekap Pengaduan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        @font-face {
            font-family: 'Arial';
            src: url('https://fonts.googleapis.com/css2?family=Arial&display=swap');
        }

        body {
            font-family: 'Arial', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        body {
            font-size: 12pt;
            line-height: 1.5;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div style="text-align: center; margin-bottom: 20px;">
        <h2>Rekap Pengaduan</h2>
        <p>Generated on: {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">NO</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Pengirim</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduans as $pengaduan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengaduan->judul }}</td>
                <td>{{ $pengaduan->deskripsi }}</td>
                <td>{{ $pengaduan->user->name }}</td>
                <td>{{ $pengaduan->lokasi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
