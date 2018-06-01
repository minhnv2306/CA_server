<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Ward;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function getWardOfProvince($provinceId)
    {
        $wards = Ward::where('matp', $provinceId)->get();

        return view('ward.index', [
            'wards' => $wards
        ]);
    }

    public function getCommuneOfWard($wardId)
    {
        $communes = Commune::where('maqh', $wardId)->get();

        return view('commune.index', [
            'communes' => $communes
        ]);
    }
}
