<!DOCTYPE html>
<html>
<head>
    <title>Data Nilai Mahasiswa</title>
</head>
<body>

<h2>Data Nilai Mahasiswa</h2>

<p><strong>Nama Mahasiswa :</strong> {{ $mahasiswa->nama }}</p>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Mata Kuliah</th>
        <th>Nilai</th>
    </tr>

    @foreach($mahasiswa->nilai as $nilai)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $nilai->matakuliah->nama }}</td>
        <td>{{ $nilai->nilai }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>