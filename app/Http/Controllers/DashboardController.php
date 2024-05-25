<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Valas;
use App\Models\CounterRate;
use App\Events\ValasEvent;
use App\Events\CounterRateEvent;
use App\Models\Video;
use App\Events\VideoEvent;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $valas = Valas::all();
        $counterRate = CounterRate::all();

        return view('dashboard.edit', compact('valas', 'counterRate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeValas(Request $request)
    {
        $valas = new Valas;

        $valas->kode = $request->kode;
        $valas->nama = $request->nama;
        $valas->harga_beli = $request->beli;
        $valas->harga_jual = $request->jual;
        $valas->status = 1;
        $valas->save();

        $valas = Valas::where('status', 1)->get();
        $half = $valas->count() / 2;

        $valas1 = $valas->slice(0, $half);
        $valas2 = $valas->slice($half);

        event(new ValasEvent($valas1, $valas2));

        return redirect()->route('dashboard.edit')->with('success', 'Data valas berhasil ditambahkan');
    }

    public function storeCounterRate(Request $request)
    {
        $counterRate = new CounterRate;

        $counterRate->kode = $request->kode;
        $counterRate->mata_uang = $request->mata_uang;
        $counterRate->tenor_1_bulan = $request->tenor_1_bulan;
        $counterRate->tenor_3_bulan = $request->tenor_3_bulan;
        $counterRate->tenor_6_bulan = $request->tenor_6_bulan;
        $counterRate->tenor_12_bulan = $request->tenor_12_bulan;
        $counterRate->tenor_24_bulan = $request->tenor_24_bulan;

        $counterRate->save();

        $counterRate = CounterRate::all();

        event(new CounterRateEvent($counterRate));


        return redirect()->route('dashboard.edit')->with('success', 'Data counter rate berhasil ditambahkan');
    }

    public function storeVideo(Request $request)
    {
        $video = new Video;
        
        if ($request->hasFile('video_file'))
        {
            $videoFile = $request->file('video_file');
            $destinationPath = 'assets/video';
            $videoName = $videoFile->getClientOriginalName();

            $videoFile->move(public_path($destinationPath), $videoName);

            $video->judul = $videoName;
            $video->path_video = $destinationPath . '/' . $videoName;
        }  

        $video->save();

        // get latest first video
        $video = Video::latest()->first();

        event(new VideoEvent($video));

        return redirect()->route('dashboard.edit')->with('success', 'Data video berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editValas(string $id)
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
