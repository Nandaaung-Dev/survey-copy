<?php

namespace App\Http\Controllers\Api;

use App\Models\Township;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TownshipResource;

class TownshipController extends Controller
{
    public function index()
    {
        return TownshipResource::collection(Township::all());
    }
}
