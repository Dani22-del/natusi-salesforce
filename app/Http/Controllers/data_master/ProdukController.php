<?php

namespace App\Http\Controllers\data_master;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterProduk;
use Illuminate\Http\Request;
use App\Models\DataMaster\MasterGudang;
use App\Models\DataMaster\MasterPrincipal;
use App\Models\DataMaster\MasterSatuan;
use App\Models\SatuanProduk;
use Illuminate\Support\Facades\Storage;
use DataTables, validator, DB, Hash, Auth;

class ProdukController extends Controller
{
  private $title = 'Data Produk';
  private $menuActive = 'data-master';
  private $submnActive = 'data_produk';
  public function index(Request $request)
  {
    // return view('data-master.data_produk.main');
    // return MasterProduk::with('principle', 'gudang', 'satuan.master_satuan')->get();
    if ($request->ajax()) {
      $data = MasterProduk::with('principle', 'gudang')
        ->orderBy('id_master_produk', 'DESC')
        ->get();

      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $btn = '<div class="dropdown">
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
              <i class="ri-more-2-line"></i>
          </button>
          <div class="dropdown-menu " data-popper-placement="bottom-end">
              <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_master_produk . ')">
                  <i class="ri-pencil-line me-1"></i> Edit
              </a>
              <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="detailProduk(' . $row->id_master_produk . ')">
                  <i class="ri-zoom-in-line"></i> Detail
              </a>
              <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_master_produk . ')">
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

  public function addProduk(Request $request)
  {
    // return $request->all();
    try {
      $data['produk'] = MasterSatuan::where('perusahaan_id', 1)->get();
      $data['principle'] = MasterPrincipal::all();
      $data['gudang'] = MasterGudang::where('perusahaan_id', 1)->get();
      $data['data'] = $request->id
        ? MasterProduk::with('principle', 'gudang', 'satuan.master_satuan')
          ->where('id_master_produk', $request->id)
          ->first()
        : null;
      $content = view('data-master.data_produk.form', $data)->render();
      return ['status' => 'success', 'content' => $content];
    } catch (\Exception $e) {
      return ['status' => 'success', 'content' => $e->getMessage()];
    }
  }

  public function store(Request $request)
  {
    // return $request->all();
    try {
      if (!empty($request->id)) {
        $new_master_produk = MasterProduk::find($request->id);
        $satuan_produk = SatuanProduk::where('master_produk_id', $request->id)->get();
        // $newuser = User::find($newsales->user_id);
        // $principal_sales = PrincipalSales::where('sales_id', $newsales->id_master_sales)->get();
      } else {
        $new_master_produk = new MasterProduk();
        $satuan_produk = new SatuanProduk();
      }
      $new_master_produk->gudang_id = $request->gudang;
      $new_master_produk->principle_id = $request->principle_id;
      $new_master_produk->kode_produk = $request->kode_produk;
      $new_master_produk->nama_produk = $request->nama_produk;
      $new_master_produk->harga_pokok_penjualan = $request->harga_pokok_penjualan;
      $new_master_produk->harga_tempo = $request->harga_tempo;
      $new_master_produk->foto_produk = $request->hasFile('foto_produk') ? $request->file('foto_produk')->store('data-produk','public') :  $new_master_produk->foto_produk;
      $new_master_produk->keterangan = $request->keterangan;
      $new_master_produk->perusahaan_id = 1;
      $new_master_produk->save();
      // return $newsales->id_master_sales;
      $selectedSatuan = $request->satuan;
      // Hapus semua principle yang tidak ada dalam pilihan user
      SatuanProduk::where('master_produk_id', $request->id)
        ->whereNotIn('satuan_id', $selectedSatuan)
        ->delete();
      foreach ($request->satuan as $item) {
        $cekSatuanProduk = SatuanProduk::where('master_produk_id', $request->id)
          ->where('satuan_id', $item)
          ->first();
        if ($cekSatuanProduk) {
          $satuan_produk = $cekSatuanProduk;
        } else {
          $satuan_produk = new SatuanProduk();
        }
        $satuan_produk->master_produk_id = !$request->id ? $new_master_produk->id_master_produk : $request->id;
        $satuan_produk->satuan_id = $item;
        $satuan_produk->save();
      }
      if ($new_master_produk) {
        if (!empty($request->id)) {
          return ['code' => '200', 'status' => 'success', 'message' => 'Berhasil Edit Data'];
        } else {
          return ['code' => '200', 'status' => 'success', 'message' => 'Berhasil Tambah Data'];
        }
      } else {
        return ['code' => '201', 'status' => 'error', 'message' => 'Error'];
      }
    } catch (\Exception $e) {
      $return = [
        'status' => 'error',
        'code' => '500',
        'message' => 'Terjadi Kesalahan di Sistem, Silahkan Hubungi Tim IT Anda!!',
        'errMsg' => $e,
      ];
      return response()->json($return);
    }
  }

  public function detailProduk(Request $request)
  {
    try {
      $data['produk'] = MasterSatuan::where('perusahaan_id', 1)->get();
      $data['principle'] = MasterPrincipal::all();
      $data['gudang'] = MasterGudang::where('perusahaan_id', 1)->get();
      $data['data'] = $request->id
        ? MasterProduk::with('principle', 'gudang', 'satuan.master_satuan')
          ->where('id_master_produk', $request->id)
          ->first()
        : null;
      $content = view('data-master.data_produk.show', $data)->render();
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
      $user['master_produk'] = MasterProduk::find($request->id);
      $user['satuan_produk'] = SatuanProduk::where('master_produk_id', $request->id)->get();

      if (!$user) {
        return response()->json(
          [
            'error' => 'Data not found',
          ],
          404
        );
      } else {
        $master_produk = $user['master_produk'];
        // if ($master_produk->foto_produk) { // assuming there's a foto_produk field in MasterProduk model
        //     Storage::delete($master_produk->foto_produk);
        // }
        if ($master_produk->foto_produk && Storage::exists('public/' . $master_produk->foto_produk)) {
          Storage::delete('public/' . $master_produk->foto_produk);
      }
        $user['master_produk']->delete();
        $user['satuan_produk']->each(function ($satuan_produk) {
          $satuan_produk->delete();
        });
      }

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
