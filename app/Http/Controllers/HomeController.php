<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MitraProfile;

class HomeController extends Controller
{
    public function index()
    {
        $featuredMitras = MitraProfile::where('status', 'active')->take(3)->get();
        return view('home', compact('featuredMitras'));
    }

    public function jenisLimbah()
    {
        return view('jenis-limbah');
    }
}
