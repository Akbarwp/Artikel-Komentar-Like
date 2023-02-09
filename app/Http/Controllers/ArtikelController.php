<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        return view('artikel.index', [
            'artikel' => Artikel::with('user')->latest()->get(),
        ]);
    }

    public function show(Request $request)
    {
        return view('artikel.show', [
            'artikel' => Artikel::where('slug', $request->slug)->with('user')->first(),
        ]);
    }
}
