<?php

namespace App\Http\Controllers;

use App\Object;
use Illuminate\Http\Request;

class ObjectController extends Controller
{
    public function index()
    {
        return view('role.index', [
            'roles' => Object::all(),
        ]);
    }
}
