<?php

namespace App\Http\Controllers\Api;

use App\Models\Quarter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuarterResource;

class QuarterController extends Controller
{
    public function index()
    {
        return QuarterResource::collection(Quarter::all());
    }
}
