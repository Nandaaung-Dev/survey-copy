<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegionResource;

class RegionController extends Controller
{
    public function index()
    {
        return RegionResource::collection(Region::all());
    }
}
