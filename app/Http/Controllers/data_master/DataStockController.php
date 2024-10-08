<?php

namespace App\Http\Controllers\data_master;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterProduk;
use App\Models\DataMaster\MasterStock;
use Illuminate\Http\Request;
use DataTables, validator, DB, Hash, Auth;

class DataStockController extends Controller
{
    private $title = 'Data Stock';
    private $menuActive = 'data-master';
    private $submnActive = 'data_stock';
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterStock::with('produk')->orderBy('id_master_stock', 'DESC')->get();
            // return $data;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                      <i class="ri-more-2-line"></i>
                  </button>
                  <div class="dropdown-menu " data-popper-placement="bottom-end">
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_master_stock . ')">
                          <i class="ri-pencil-line me-1"></i> Edit
                      </a>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_master_stock . ')">
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

    public function addStock(Request $request)
    {
        try {
            $data['produk'] = MasterProduk::all();
            $data['data'] = $request->id_master_stock ? MasterStock::find($request->id_master_stock) : null;
            $content = view('data-master.data_stock.form', $data)->render();
            return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => $e->getMessage()];
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:master_produk,id_master_produk|unique:master_stock,produk_id,' . ($request->id_master_stock ?? 'NULL') . ',id_master_stock',
            'nama_produk' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'deskripsi' => 'required|string|max:500'
        ], [
            'produk_id.required' => 'Produk ID harus diisi.',
            'produk_id.unique' => 'Produk sudah terdaftar.',
            'produk_id.exists' => 'Produk ID tidak valid, pastikan produk terdaftar.',
            'nama_produk.required' => 'Nama produk harus diisi.',
            'nama_produk.string' => 'Nama produk harus berupa teks.',
            'nama_produk.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'qty.required' => 'Kuantitas harus diisi.',
            'qty.integer' => 'Kuantitas harus berupa angka.',
            'qty.min' => 'Kuantitas harus minimal 1.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 500 karakter.',
        ]);

        try {
            if ($request->filled('id_master_stock')) {
                $stock = MasterStock::findOrFail($request->id_master_stock);
            } else {
                $stock = new MasterStock();
            }

            // Assign data dari request ke model
            $stock->produk_id = $request->produk_id;
            $stock->nama_produk = $request->nama_produk;
            $stock->qty = $request->qty;
            $stock->deskripsi = $request->deskripsi;
            $stock->save();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => $request->filled('id_master_stock') ? 'Berhasil Edit Data Customer' : 'Berhasil Tambah Data Customer',
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

    public function detailStock()
    {
        try {
            $data['data'] = "";
            $content = view('data-master.data_stock.detail', $data)->render();
            return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => $e->getMessage()];
        }
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        try {
            $data = MasterStock::find($request->id);

            if (!$data) {
                return response()->json(
                    [
                        'error' => 'Data not found',
                    ],
                    404
                );
            }

            $data->delete();

            return response()->json([
                'success' => 'Data Berhasil Dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => 'Terjadi kesalahan, silahkan coba lagi',
                ],
                500
            );
        }
    }
}
