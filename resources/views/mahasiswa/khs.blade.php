@extends('mahasiswa.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2 class="text-center">JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
                <br>
                <h1 class="text-center">KARTU HASIL STUDI (KHS)</h1>
            </div>
        </div>
    </div>
    <a style="width: 120px; height: 40px" href="{{ route('mahasiswa.cetak_khs', $data->nim) }}"
            class="mt-4 btn btn-success float-right">Cetak
            KHS</a>
    <table class="mt-5 mr-auto" border="0" align="left">
        <thead>
            <tr>
                <td class="text-left">
                    <p class="text-dark font-weight-bold">Nama:</p>
                </td>
                <td>
                    <p class="text-dark">{{ $data->nama }}</p>
                </td>
            </tr>
            <tr>
                <td class="text-left">
                    <p class="text-dark font-weight-bold">NIM:</p>
                </td>
                <td>
                    <p class="text-dark">{{ $data->nim }}</p>
                </td>
            </tr>
            <tr>
                <td class="text-left">
                    <p class="text-dark font-weight-bold">Kelas:</p>
                </td>
                <td>
                    <p class="text-dark">{{ $data->kelas->nama_kelas }}</p>
                </td>
            </tr>
        </thead>
    </table>
    <table class="table table-bordered">
        <tr>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Nilai</th>
        </tr>
        @foreach ($data->khs as $khs)
            <tr>
                <td>{{ $khs->mataKuliah->nama_matkul }}</td>
                <td>{{ $khs->mataKuliah->sks }}</td>
                <td>{{ $khs->mataKuliah->semester }}</td>
                <td>{{ $khs->nilai }}</td>
            </tr>
        @endforeach
    </table>
@endsection
        