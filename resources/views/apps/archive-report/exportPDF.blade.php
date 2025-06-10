<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>
    <h2>Laporan Arsip</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Klasifikasi</th>
                <th>Uraian Arsip</th>
                <th>Kurun Waktu</th>
                <th>Status</th>
                <th>Gedung</th>
                <th>Lemari</th>
                <th>Rak</th>
                <th>Baris</th>
                <th>Folder</th>
            </tr>
        </thead>
        <tbody>
            @foreach($archives as $i => $archive)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $archive->work_team_classification->code ?? '-' }}</td>
                    <td>{{ $archive->archive_description ?? '-' }}</td>
                    <td>{{ $archive->archive_lifespan ?? '-' }}</td>
                    <td>{{ $archive->archive_status->name ?? '-' }}</td>
                    <td>{{ $archive->building->name ?? '-' }}</td>
                    <td>{{ $archive->cabinet->name ?? '-' }}</td>
                    <td>{{ $archive->shelf->name ?? '-' }}</td>
                    <td>{{ $archive->shelf_row->name ?? '-' }}</td>
                    <td>{{ $archive->folder->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
