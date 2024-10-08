<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterSales;
use App\Models\DataMaster\MasterGudang;
use App\Models\DataMaster\MasterPrincipal;
use App\Models\PrincipalSales;
use App\Models\User;
use DataTables, validator, DB, Hash, Auth;
use Illuminate\Http\Request;

class DataSalesController extends Controller
{
  private $title = 'Data Sales';
  private $menuActive = 'sales';
  private $submnActive = 'data_sales';
  public function index(Request $request)
  {
    // $data = MasterSales::with('principal_sales.master_principal')->first();
    // $data = MasterSales::with('users', 'gudang')
    //   ->orderBy('id_master_sales', 'DESC')
    //   ->get();
    // return $data;
    if ($request->ajax()) {
      $data = MasterSales::with('users', 'gudang')
        ->orderBy('id_master_sales', 'DESC')
        ->get();

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
    $this->data['title'] = $this->title;
    $this->data['menuActive'] = $this->menuActive;
    $this->data['submnActive'] = $this->submnActive;
    $this->data['smallTitle'] = '';
    return view($this->menuActive . '.' . $this->submnActive . '.' . 'main')->with('data', $this->data);
  }

  public function createDataSales(Request $request)
  {
    // $data = MasterSales::with('users', 'gudang', 'principal_sales.master_principal')
    //   ->where('id_master_sales', $request->id)
    //   ->first();
    // $principle = $data->principal_sales->master_principal->nama_principal;
    // return $principle;
    // $data['data'] = $request->id ? MasterSales::find($request->id) : null;
    // return $data;
    // dd($request->all());
    // return $request->all();
    // $data = ['data'];
    // $data['data'] = gudang;
    // $content = view('sales.data_sales.form', $data)->render();
    // return ['status' => 'success', 'content' => $content, 'data' => $data];
    // $data['principle'] = MasterPrincipal::all();
    // return $data;
    try {
      $user_login = Auth::user();
      $data['gudang'] = MasterGudang::where('perusahaan_id', $user_login->perusahaan_id)->get();
      $data['principle'] = MasterPrincipal::all();
      $data['data'] = $request->id
        ? MasterSales::with('users', 'gudang', 'principal_sales.master_principal')
          ->where('id_master_sales', $request->id)
          ->first()
        : null;

      $content = view('sales.data_sales.form', $data)->render();
      return ['status' => 'success', 'content' => $content];
    } catch (\Exception $e) {
      return ['status' => 'success', 'content' => $e->getMessage()];
    }
  }

  public function store(Request $request)
  {
    // return $request->principle_id;

    try {
      if (!empty($request->id)) {
        $newsales = MasterSales::where('id_master_sales', $request->id)->first();
        $newuser = User::find($newsales->user_id);
        $principal_sales = PrincipalSales::where('sales_id', $newsales->id_master_sales)->get();
      } else {
        $newsales = new MasterSales();
        $newuser = new User();
        $principal_sales = new PrincipalSales();
      }
      $user_login = Auth::user();
      $newuser->email = $request->email;
      $newuser->name = $request->username;
      $newuser->password = Hash::make($request->password);
      $newuser->status = $request->status;
      $newuser->perusahaan_id = $user_login->perusahaan_id;
      $newuser->level_user = 3;
      $newuser->save();

      $newsales->user_id = $newuser->id;
      $newsales->nama_lengkap = $request->nama_lengkap;
      $newsales->kode_sales = $request->kode_sales;
      $newsales->gudang_id = $request->gudang_id;
      $newsales->no_telp = $request->no_telp;
      $newsales->status = $request->status;
      $newsales->perusahaan_id = $user_login->perusahaan_id;
      
      $newsales->foto = $request->hasFile('file_foto') ? $request->file('file_foto')->store('data-sales','public') :  $newsales->foto;
      $newsales->save();
      // return $newsales->id_master_sales;
      $selectedPrinciples = $request->principle_id;
      // Hapus semua principle yang tidak ada dalam pilihan user
      PrincipalSales::where('sales_id', $newsales->id_master_sales)
        ->whereNotIn('principle_id', $selectedPrinciples)
        ->delete();
      foreach ($request->principle_id as $item) {
        $cekPrincipalSales = PrincipalSales::where('sales_id', $request->id)
          ->where('principle_id', $item)
          ->first();
        if (!empty($cekPrincipalSales)) {
          $principal_sales = $cekPrincipalSales;
        } else {
          $principal_sales = new PrincipalSales();
        }
        $principal_sales->sales_id = !$request->id ? $newsales->id_master_sales : $request->id;
        $principal_sales->principle_id = $item;
        $principal_sales->save();
      }
      if ($newsales) {
        if (!empty($request->id)) {
          return ['code' => '200', 'status' => 'success', 'message' => 'Berhasil Edit Data'];
        } else {
          return ['code' => '200', 'status' => 'success', 'message' => 'Berhasil Tambah Data'];
        }
      } else {
        return ['code' => '201', 'status' => 'error', 'message' => 'Error'];
      }
    } catch (Exception $e) {
      $return = [
        'status' => 'error',
        'code' => '500',
        'message' => 'Terjadi Kesalahan di Sistem, Silahkan Hubungi Tim IT Anda!!',
        'errMsg' => $e,
      ];
      return response()->json($return);
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

  public function destroy(Request $request)
  {
    try {
      $user['sales'] = MasterSales::find($request->id);
      $user['principal'] = PrincipalSales::where('sales_id', $request->id)->get();
      $user['user'] = User::find($user['sales']->user_id);

      if (!$user) {
        return response()->json(
          [
            'error' => 'Data not found',
          ],
          404
        );
      } else {
        $user['sales']->delete();
        $user['principal']->each(function ($principal) {
          $principal->delete();
        });
        $user['user']->delete();
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
