<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index(){

	$examples = \App\Example::all();

    return view('projects.example', compact('examples'));
    } 
}
