<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterCustomer;
use App\Models\DataMaster\MasterSales;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('keuangan.pembayaran.main');
    }

    public function createPembayaran(Request $request)
  {
    try {
      $data['data'] = '';
      $content = view('keuangan.pembayaran.form', $data)->render();
      return ['status' => 'success', 'content' => $content];
    } catch (\Exception $e) {
      return ['status' => 'success', 'content' => $e->getMessage()];
    }
  }

    public function store(Request $request)
    {

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
