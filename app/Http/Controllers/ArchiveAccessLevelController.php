<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchiveAccessLevelController extends Controller
{
    public function index(){
        return view('apps.archive-access-level.index');
    }
}
