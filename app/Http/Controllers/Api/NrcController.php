<?php

namespace App\Http\Controllers\Api;

use App\Models\Nrc;
use Illuminate\Http\Request;
use App\Http\Resources\NrcResource;
use App\Http\Controllers\Controller;

class NrcController extends Controller
{
    public function index()
    {
        return NrcResource::collection(Nrc::all());
    }
}
