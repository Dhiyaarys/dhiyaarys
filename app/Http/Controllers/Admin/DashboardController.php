<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data petugas dalam model Petugas
        $petugas = Petugas::all()->count();
        // Ambil semua data masyarakat dalam model Masyarakat
        $masyarakat = Masyarakat::all()->count();
        // Ambil semua data pengaduan dalam model Pengaduan
        $pending = Pengaduan::where('status', '0')->get()->count();
        $proses = Pengaduan::where('status', 'proses')->get()->count();
        $selesai = Pengaduan::where('status', 'selesai')->get()->count();
        $pengaduan = Pengaduan::all()->count();

        return view('Admin.Dashboard.index', [
            'petugas' => $petugas, 
            'masyarakat' => $masyarakat, 
            'pending' => $pending,
            'proses' => $proses, 
            'selesai' => $selesai,
            'pengaduan' => $pengaduan,
        ]);
    }

    public function showPending()
    {
        $pengaduan = Pengaduan::where('status', '0')->get();
        return view('Admin.Pengaduan.index', ['pengaduan'=> $pengaduan]);
    }

    public function showProses()
    {
        $pengaduan = Pengaduan::where('status', 'proses')->get();
        return view('Admin.Pengaduan.index', ['pengaduan'=> $pengaduan]);
    }

    public function showSelesai()
    {
        $pengaduan = Pengaduan::where('status', 'selesai')->get();
        return view('Admin.Pengaduan.index', ['pengaduan'=> $pengaduan]);
    }
}
