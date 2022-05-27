<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $mahasiswa = $mahasiswa = DB::table('mahasiswa')->get(); // Mengambil semua isi tabel
        // $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(3);
        // return view('mahasiswa.index', compact('mahasiswa'));
        // with('i', (request()->input('page', 1) - 1) * 5);
        // $mahasiswa = Mahasiswa::latest('nim')->paginate(3);
        $mahasiswa = Mahasiswa::with('kelas')->latest('nim')->paginate(3);
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'Tanggal_lahir' => 'required',
            ]);
            $mahasiswa = new Mahasiswa;
            $mahasiswa->Nim = $request->Nim;
            $mahasiswa->Nama = $request->Nama;
            $mahasiswa->Jurusan = $request->Jurusan;
            $mahasiswa->Email = $request->Email;
            $mahasiswa->Alamat = $request->Alamat;
            $mahasiswa->Tanggal_lahir = $request->Tanggal_lahir;
            $mahasiswa->save();

            $kelas = new Kelas;
            $kelas->id = $request->kelas;

            $mahasiswa->kelas()->associate($kelas);
            $mahasiswa->save();

            return redirect()
                ->route('mahasiswa.index')
                ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        // $Mahasiswa = Mahasiswa::where('nim',$Nim)->first();
        // return view('mahasiswa.detail', compact('Mahasiswa'));
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim',$Nim)->first();
        return view('mahasiswa.detail', ['Mahasiswa' => $Mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'Tanggal_lahir' => 'required',
        ]);
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $mahasiswa->Nim = $request->get('Nim');
        $mahasiswa->Nama = $request->get('Nama');
        $mahasiswa->Jurusan = $request->get('Jurusan');
        $mahasiswa->Email = $request->get('Email');
        $mahasiswa->Alamat = $request->get('Alamat');
        $mahasiswa->Tanggal_lahir = $request->get('Tanggal_lahir');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        // Mahasiswa::where('nim',$Nim)->firstOrFail()->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        Mahasiswa::where('nim',$Nim)->first()->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function searchMhs(Request $request)
    {
        $search     = $request->search;
        $mahasiswa  = Mahasiswa::where("nim", "LIKE", "%$search%")
            ->orWhere("nama", "LIKE", "%$search%")
            ->orWhere("jurusan", "LIKE", "%$search%")
            ->orWhere("email", "LIKE", "%$search%")
            ->orWhere("alamat", "LIKE", "%$search%")
            ->orWhere("tanggal_lahir", "LIKE", "%$search%")
            ->paginate(3);
        return view('mahasiswa.index', compact('mahasiswa'));
    }
    public function tampil_khs($nim)
    {
        $data = Mahasiswa::where('nim', $nim)->with(['kelas', 'khs.mataKuliah'])->first();
        return view('mahasiswa.khs', compact('data'));
    }
}
