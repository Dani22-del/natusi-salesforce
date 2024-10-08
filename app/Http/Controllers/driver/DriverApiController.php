<?php

namespace App\Http\Controllers;

use App\Models\MasterDriver;
use Illuminate\Http\Request;

class DriverApiController extends Controller
{
    public function index()
    {
        $data = MasterDriver::with('users', 'gudang')
            ->orderBy('id_master_driver', 'ASC')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
