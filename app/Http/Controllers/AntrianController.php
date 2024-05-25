<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\NomorAntrian;
use App\Models\LoketAntrian;
use App\Models\PelayananAktif;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\WaktuPelayanan;
use App\Events\NomorAntrianEvent;
use Illuminate\Support\Facades\DB;
use App\Models\Valas;
use App\Models\CounterRate;
use App\Events\TvEvent;
use App\Models\Video;

class AntrianController extends Controller
{
    public function index()
    {
        $no_loket = Auth::user()->loket_id;

        // tampilkan nomor antrian yang sedang dipanggil
        $pelayananAktif = PelayananAktif::with('nomorAntrian')->where('loket_id', $no_loket)->first();

        if ($pelayananAktif) {
            $nomorAntrian = $pelayananAktif->nomorAntrian->nomor_antrian;
        } else {
            $nomorAntrian = "-";
        }

        // tampilkan sisa nomor antrian yang belum dipanggil di layanan tersebut
        $sisaNomorAntrian = NomorAntrian::where('status', false)->where('layanan_id', Auth::user()->loket_id)->count();

        return view('dashboard', compact('no_loket', 'pelayananAktif', 'nomorAntrian', 'sisaNomorAntrian'));
    }

    public function createNomorAntrian($layananId)
    {
        // Cari layanan berdasarkan id
        $layanan = Layanan::find($layananId);

        // Pastikan layanan ditemukan
        if (!$layanan) {
            return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
        }

        // Buat nomor antrian baru
        $nomorAntrian = NomorAntrian::create([
            'layanan_id' => $layanan->layanan_id,
            'nomor_antrian' => $this->generateNomorAntrian($layananId),
            'status' => false,
        ]);

        $waktuPelayanan = WaktuPelayanan::create([
            'layanan_id' => $layanan->layanan_id,
            'loked_id' => null,
            'nomor_antrian_id' => $nomorAntrian->nomor_antrian_id,
            'waktu_mulai_tunggu' => Carbon::now(),
        ]);

        // sisa nomor antrian yang belum dipanggil terbaru di layanan tersebut
        $sisaNomorAntrian = NomorAntrian::where('layanan_id', $layananId)->where('status', false)->count();

        // broadcast sisa nomor antrian yang belum dipanggil di layanan tersebut
        event(new NomorAntrianEvent($sisaNomorAntrian, $layananId));


        return redirect()->route('touchscreen')->with('message', 'Nomor antrian telah berhasil dibuat');
    }

    private function generateNomorAntrian($layananId)
    {
        $lastNomorAntrian = NomorAntrian::where('layanan_id', $layananId)->latest()->first();

        if (!$lastNomorAntrian) {
            return 1;
        }

        $today = Carbon::now()->startOfDay();
        $lastNomorAntrianDate = Carbon::parse($lastNomorAntrian->created_at)->startOfDay();

        if ($lastNomorAntrianDate->lt($today)) {
            return 1;
        }

        return $lastNomorAntrian->nomor_antrian + 1;
    }

    public function panggilNomorAntrianSelanjutnya ($loketId)
    {
        // Cari loket berdasarkan id
        $loket = LoketAntrian::find($loketId);

        // Pastikan loket ditemukan
        if (!$loket) {
            return response()->json(['message' => 'Loket tidak ditemukan'], 404);
        }

        // cek jika masih ada pelayanan aktif
        $pelayananAktif = PelayananAktif::where('loket_id', $loket->loket_id)->first();
        if ($pelayananAktif) {
            return response()->json(['message' => 'Masih ada nomor antrian yang sedang dipanggil'], 400);
        }

        // Cari nomor antrian yang belum dipanggil
        $nomorAntrian = NomorAntrian::where('status', false)->where('layanan_id', $loket->layanan_id)->first();

        // Pastikan nomor antrian ditemukan
        if (!$nomorAntrian) {
            return response()->json(['message' => 'Tidak ada nomor antrian yang belum dipanggil'], 404);
        }

        // Update status nomor antrian menjadi sudah dipanggil
        $nomorAntrian->status = true;
        $nomorAntrian->save();

        // update waktu selesai tunggu
        $waktuPelayanan = WaktuPelayanan::where('nomor_antrian_id', $nomorAntrian->nomor_antrian_id)->first();
        $waktuPelayanan->waktu_selesai_tunggu = Carbon::now();
        $waktuPelayanan->total_waktu_tunggu = $waktuPelayanan->waktu_selesai_tunggu->diffInSeconds($waktuPelayanan->waktu_mulai_tunggu);
        $waktuPelayanan->waktu_mulai_pelayanan = Carbon::now();
        $waktuPelayanan->loket_id = $loket->loket_id;
        $waktuPelayanan->save();

        $nomorAntrianTerakhirLayanan_1 = WaktuPelayanan::where('layanan_id', 1)
            ->whereDate('created_at', Carbon::today())
            ->with('nomorAntrian')
            ->with('loket')
            ->latest()
            ->first();

        $nomorAntrianTerakhirLayanan_2 = WaktuPelayanan::where('layanan_id', 2)
            ->whereDate('created_at', Carbon::today())
            ->with('nomorAntrian')
            ->with('loket')
            ->latest()
            ->first();

        $today = Carbon::today();

        $nomorAntrianTerakhir_1 = WaktuPelayanan::where('loket_id', 1)
            ->whereDate('created_at', $today)
            ->with('nomorAntrian')
            ->latest()
            ->first();

        $nomorAntrianTerakhir_2 = WaktuPelayanan::where('loket_id', 2)
            ->whereDate('created_at', $today)
            ->with('nomorAntrian')
            ->latest()
            ->first();

        $nomorAntrianTerakhir_3 = WaktuPelayanan::where('loket_id', 3)
            ->whereDate('created_at', $today)
            ->with('nomorAntrian')
            ->latest()
            ->first();

        $nomorAntrianTerakhir_4 = WaktuPelayanan::where('loket_id', 4)
            ->whereDate('created_at', $today)
            ->with('nomorAntrian')
            ->latest()
            ->first();

        $nomorAntrianTerakhir_5 = WaktuPelayanan::where('loket_id', 5)
            ->whereDate('created_at', $today)
            ->with('nomorAntrian')
            ->latest()
            ->first();

        $nomorAntrianTerakhir = [
            1 => $nomorAntrianTerakhir_1,
            2 => $nomorAntrianTerakhir_2,
            3 => $nomorAntrianTerakhir_3,
            4 => $nomorAntrianTerakhir_4,
            5 => $nomorAntrianTerakhir_5,
        ];


        $nomorAntrianTerakhirLayanan = [
            1 => $nomorAntrianTerakhirLayanan_1,
            2 => $nomorAntrianTerakhirLayanan_2,
        ];

        // broadcast nomor antrian terakhir layanan dan nomor antrian terakhir
        event(new TvEvent($nomorAntrianTerakhir, $nomorAntrianTerakhirLayanan));

        $pelayananAktif = PelayananAktif::create([
            'loket_id' => $loket->loket_id,
            'nomor_antrian_id' => $nomorAntrian->nomor_antrian_id,
        ]);


        return response()->json(['message' => 'Nomor antrian ' . $nomorAntrian->nomor_antrian . ' berhasil dipanggil', 'nomor_antrian' => $nomorAntrian, 'sisa_antrian' => NomorAntrian::where('status', false)->where('layanan_id', $loket->layanan_id)->count()], 200);
    }

    public function selesaiNomorAntrian ($loketId)
    {
        // Cari loket berdasarkan id
        $loket = LoketAntrian::find($loketId);

        // Pastikan loket ditemukan
        if (!$loket) {
            return response()->json(['message' => 'Loket tidak ditemukan'], 404);
        }

        // Cari nomor antrian yang sedang dipanggil di loket tersebut
        $pelayananAktif = PelayananAktif::where('loket_id', $loket->loket_id)->first();

        // Pastikan nomor antrian ditemukan
        if (!$pelayananAktif) {
            return response()->json(['message' => 'Nomor antrian tidak ditemukan'], 404);
        }

        // Cari nomor antrian yang sedang dipanggil
        $nomorAntrian = NomorAntrian::find($pelayananAktif->nomor_antrian_id);

        // Pastikan nomor antrian ditemukan
        if (!$nomorAntrian) {
            return response()->json(['message' => 'Nomor antrian tidak ditemukan'], 404);
        }

        // Update status nomor antrian menjadi sudah selesai
        $nomorAntrian->status = true;
        $nomorAntrian->save();

        // update waktu selesai pelayanan
        $waktuPelayanan = WaktuPelayanan::where('nomor_antrian_id', $nomorAntrian->nomor_antrian_id)->first();
        $waktuPelayanan->waktu_selesai_pelayanan = Carbon::now();
        $waktuPelayanan->total_waktu_pelayanan = $waktuPelayanan->waktu_selesai_pelayanan->diffInSeconds($waktuPelayanan->waktu_mulai_pelayanan);
        $waktuPelayanan->save();

        // Hapus nomor antrian yang sudah selesai
        $pelayananAktif->delete();

        return response()->json(['message' => 'Nomor antrian ' . $nomorAntrian->nomor_antrian . ' berhasil selesai', 'nomor_antrian' => $nomorAntrian, 'sisa_antrian' => NomorAntrian::where('status', false)->where('layanan_id', $loket->layanan_id)->count()], 200);
    }

    public function panggilUlangNomorAntrian ($loketId)
    {
        // Cari loket berdasarkan id
        $loket = LoketAntrian::find($loketId);

        // Pastikan loket ditemukan
        if (!$loket) {
            return response()->json(['message' => 'Loket tidak ditemukan'], 404);
        }

        // Cari nomor antrian yang sedang dipanggil di loket tersebut
        $pelayananAktif = PelayananAktif::where('loket_id', $loket->loket_id)->first();

        // Pastikan nomor antrian ditemukan
        if (!$pelayananAktif) {
            return response()->json(['message' => 'Nomor antrian tidak ditemukan'], 404);
        }

        // Cari nomor antrian yang sedang dipanggil
        $nomorAntrian = NomorAntrian::find($pelayananAktif->nomor_antrian_id);

        // Pastikan nomor antrian ditemukan
        if (!$nomorAntrian) {
            return response()->json(['message' => 'Nomor antrian tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Nomor antrian ' . $nomorAntrian->nomor_antrian . ' berhasil dipanggil ulang', 'nomor_antrian' => $nomorAntrian, 'sisa_antrian' => NomorAntrian::where('status', false)->where('layanan_id', $loket->layanan_id)->count()], 200);
    }

    public function tv()
    {
        $nomorAntrianTerakhirLayanan_1 = WaktuPelayanan::where('layanan_id', 1)->with('nomorAntrian')->with('loket')->latest()->first();
        $nomorAntrianTerakhirLayanan_2 = WaktuPelayanan::where('layanan_id', 2)->with('nomorAntrian')->with('loket')->latest()->first();

        $nomorAntrianTerakhir_1 = WaktuPelayanan::with('nomorAntrian')->where('loket_id', 1)->latest()->first();
        $nomorAntrianTerakhir_2 = WaktuPelayanan::with('nomorAntrian')->where('loket_id', 2)->latest()->first();
        $nomorAntrianTerakhir_3 = WaktuPelayanan::with('nomorAntrian')->where('loket_id', 3)->latest()->first();
        $nomorAntrianTerakhir_4 = WaktuPelayanan::with('nomorAntrian')->where('loket_id', 4)->latest()->first();
        $nomorAntrianTerakhir_5 = WaktuPelayanan::with('nomorAntrian')->where('loket_id', 5)->latest()->first();

        $nomorAntrianTerakhir = [
            1 => $nomorAntrianTerakhir_1,
            2 => $nomorAntrianTerakhir_2,
            3 => $nomorAntrianTerakhir_3,
            4 => $nomorAntrianTerakhir_4,
            5 => $nomorAntrianTerakhir_5,
        ];

        $nomorAntrianTerakhirLayanan = [
            1 => $nomorAntrianTerakhirLayanan_1,
            2 => $nomorAntrianTerakhirLayanan_2,
        ];

        $valas = Valas::all();
        $half = $valas->count() / 2;

        $valas1 = $valas->slice(0, $half);
        $valas2 = $valas->slice($half);

        $counterRate = CounterRate::all();

        // get the latest video
        $video = Video::latest()->first();

        return view('tv', compact('nomorAntrianTerakhir', 'nomorAntrianTerakhirLayanan', 'valas1', 'valas2', 'counterRate', 'video'));
    }
}
