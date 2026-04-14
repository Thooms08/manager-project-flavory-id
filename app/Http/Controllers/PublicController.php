<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function faq()
    {
        return view('faq');
    }

    public function SyaratKetentuan()
    {
        return view('syarat-ketentuan');
    }

    public function KebijakanPrivasi()
    {
        return view('kebijakan-privasi');
    }
}
