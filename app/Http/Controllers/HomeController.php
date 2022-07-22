<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function select2()
    {
        return view('paginas.select2');
    }

    public function select2Livewire()
    {
        return view('paginas.select2_livewire');
    }

    public function select2LivewireCOmponentes()
    {
        return view('paginas.select2_livewire_componentes');
    }

    public function tomSelect()
    {
       return view('paginas.tom_select');
    }

    public function selectNormal()
    {
       return view('paginas.select_normal');
    } 
}
