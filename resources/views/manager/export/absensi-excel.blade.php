<table>
    <thead>
        <tr>
            <th colspan="2"></th> <th colspan="{{ $daysInMonth }}" style="text-align: center; font-weight: bold; font-size: 14px; background-color: #f8f9fa;">
                Periode: {{ date('F', mktime(0, 0, 0, $bulan, 1)) }} {{ $tahun }}
            </th>
            
            <th colspan="4"></th> </tr>
        
        <tr>
            <th>Username</th>
            <th>Nama Karyawan</th>
            @for($i = 1; $i <= $daysInMonth; $i++)
                <th style="text-align: center;">{{ $i }}</th>
            @endfor
            <th>T. Absen</th>
            <th>T. Mangkir</th>
            <th>T. Izin</th>
            <th>T. Libur</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $karyawan)
        <tr>
            <td>{{ $karyawan['username'] }}</td>
            <td>{{ $karyawan['nama'] }}</td>
            @for($i = 1; $i <= $daysInMonth; $i++)
                @php
                    $status = $karyawan['calendar'][$i]['status'] ?? '';
                    $kode = '';
                    if($status == 'absen') $kode = 'A';
                    if($status == 'mangkir') $kode = 'M';
                    if($status == 'izin') $kode = 'I';
                    if($status == 'libur') $kode = 'L';
                @endphp
                <td style="text-align: center;">{{ $kode }}</td>
            @endfor
            <td style="text-align: center;">{{ $karyawan['total_absen'] }}</td>
            <td style="text-align: center;">{{ $karyawan['total_mangkir'] }}</td>
            <td style="text-align: center;">{{ $karyawan['total_izin'] }}</td>
            <td style="text-align: center;">{{ $karyawan['total_libur'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>