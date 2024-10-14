<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterCustomer;
use App\Models\DataMaster\MasterSales;
use Illuminate\Http\Request;
use DataTables, validator, Hash, Auth;
use App\Models\Piutang;

class PiutangController extends Controller
{
    private $title = 'Piutang';
    private $menuActive = 'keuangan';
    private $submnActive = 'piutang';
    public function index(Request $request)
    {
        // return view('keuangan.piutang.main');
        if ($request->ajax()) {
            $data = Piutang::with('sales', 'customer','so')
              ->orderBy('id_piutang', 'DESC')
              ->get();
      
            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function ($row) {
                  $btn = '<div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                      <i class="ri-more-2-line"></i>
                  </button>
                  <div class="dropdown-menu " data-popper-placement="bottom-end">
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_piutang . ')">
                          <i class="ri-pencil-line me-1"></i> Edit
                      </a>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_piutang . ')">
                          <i class="ri-delete-bin-7-line me-1"></i> Delete
                      </a>
                  </div>
              </div>';
                return $btn;
              })
              ->rawColumns(['action'])
              ->make(true);
          }
          $this->data['title'] = $this->title;
          $this->data['menuActive'] = $this->menuActive;
          $this->data['submnActive'] = $this->submnActive;
          $this->data['smallTitle'] = '';
          return view($this->menuActive . '.' . $this->submnActive . '.' . 'main')->with('data', $this->data);
    }

    public function createPiutang(Request $request)
    {
        try {
            $data['customer'] = MasterCustomer::all();
            $data['sales'] = MasterSales::all();
            $data['data'] = '';
            $content = view('keuangan.piutang.form', $data)->render();
            return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => $e->getMessage()];
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:master_customer,id',
            'kode_customer' => 'required|string|max:50',
            'sales_id' => 'required|exists:sales,id',
            'kode_sales' => 'required|string|max:50',
            'no_invoice' => 'required|string|max:100',
            'tgl_invoice' => 'required|date',
            'nominal_invoice' => 'required|numeric|min:0',
            'total_bayar' => 'required|numeric|min:0',
            'sisa_piutang' => 'required|numeric|min:0',
        ], [
            'customer_id.required' => 'ID Customer harus diisi',
            'customer_id.exists' => 'Customer tidak ditemukan di database',
            'kode_customer.required' => 'Kode Customer harus diisi',
            'kode_customer.max' => 'Kode Customer tidak boleh lebih dari 50 karakter',
            'sales_id.required' => 'ID Sales harus diisi',
            'sales_id.exists' => 'Sales tidak ditemukan di database',
            'kode_sales.required' => 'Kode Sales harus diisi',
            'kode_sales.max' => 'Kode Sales tidak boleh lebih dari 50 karakter',
            'no_invoice.required' => 'No Invoice harus diisi',
            'no_invoice.max' => 'No Invoice tidak boleh lebih dari 100 karakter',
            'tgl_invoice.required' => 'Tanggal Invoice harus diisi',
            'tgl_invoice.date' => 'Tanggal Invoice harus berupa tanggal yang valid',
            'nominal_invoice.required' => 'Nominal Invoice harus diisi',
            'nominal_invoice.numeric' => 'Nominal Invoice harus berupa angka',
            'nominal_invoice.min' => 'Nominal Invoice tidak boleh kurang dari 0',
            'total_bayar.required' => 'Total Bayar harus diisi',
            'total_bayar.numeric' => 'Total Bayar harus berupa angka',
            'total_bayar.min' => 'Total Bayar tidak boleh kurang dari 0',
            'sisa_piutang.required' => 'Sisa Piutang harus diisi',
            'sisa_piutang.numeric' => 'Sisa Piutang harus berupa angka',
            'sisa_piutang.min' => 'Sisa Piutang tidak boleh kurang dari 0',
        ]);


        try {
            if ($request->filled('id')) {
                $data = MasterCustomer::findOrFail($request->id);
            } else {
                $data = new MasterCustomer();
            }

            // Assign data dari request ke model
            $data->customer_id = $request->customer_id;
            $data->kode_customer = $request->kode_customer;
            $data->sales_id = $request->sales_id;
            $data->kode_sales = $request->kode_sales;
            $data->no_invoice = $request->no_invoice;
            $data->tgl_invoice = $request->tgl_invoice;
            $data->nominal_invoice = $request->nominal_invoice;
            $data->total_bayar = $request->total_bayar;
            $data->sisa_piutang = $request->sisa_piutang;
            $data->save();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => $request->filled('id') ? 'Berhasil Edit Data Piutang' : 'Berhasil Tambah Data Piutang',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Terjadi Kesalahan di Sistem, Silahkan Hubungi Tim IT Anda!!',
                'errMsg' => $e->getMessage(),
            ]);
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
