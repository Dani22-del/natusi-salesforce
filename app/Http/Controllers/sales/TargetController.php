<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterSales;
use App\Models\TargetSales;
use DataTables, validator, DB, Hash, Auth;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TargetSales::with('sales')->orderBy('id', 'DESC')->get();

            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function ($row) {
                  $btn = '<div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                      <i class="ri-more-2-line"></i>
                  </button>
                  <div class="dropdown-menu " data-popper-placement="bottom-end">
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_master_sales . ')">
                          <i class="ri-pencil-line me-1"></i> Edit
                      </a>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_master_sales . ')">
                          <i class="ri-delete-bin-7-line me-1"></i> Delete
                      </a>
                  </div>
              </div>';
                return $btn;
              })
              ->rawColumns(['action'])
              ->make(true);
          }
        return view('sales.target.main');
    }

    public function createDataTarget(Request $request)
    {
        try {
            $data['sales'] = MasterSales::all();
            $data['data'] = "";
            $content = view('sales.target.form', $data)->render();
            return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => $e->getMessage()];
        }
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'sales_id' => 'required|exists:master_sales,id_master_sales', // Memastikan ID sales valid
            'kode_sales' => 'required|string',
            'bulan' => 'required|date_format:Y-m', // Validasi format bulan & tahun
            'target' => 'required|numeric|min:0'
        ]);

        // Simpan data ke database
        try {
            TargetSales::create([
                'sales_id' => $validatedData['sales_id'],
                'kode_sales' => $validatedData['kode_sales'],
                'bulan' => $validatedData['bulan'],
                'target' => $validatedData['target'],
            ]);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
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
