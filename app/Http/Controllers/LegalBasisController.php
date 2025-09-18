<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalBasisController extends Controller
{
    public function index() {
        return view('apps.legal-basis.index');
    }
}
