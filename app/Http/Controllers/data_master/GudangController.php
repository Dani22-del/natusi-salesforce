<?php

namespace App\Http\Controllers\data_master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataMaster\MasterGudang;
use App\Models\User;
use DataTables, validator, DB, Hash, Auth;

class GudangController extends Controller
{
  private $title = 'Gudang';
  private $menuActive = 'data-master';
  private $submnActive = 'data_gudang';
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = MasterGudang::orderBy('id_master_gudang', 'DESC');
      // return $data;
      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn = '<div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                <i class="ri-more-2-line"></i>
            </button>
            <div class="dropdown-menu " data-popper-placement="bottom-end">
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_master_gudang . ')">
                    <i class="ri-pencil-line me-1"></i> Edit
                </a>
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_master_gudang . ')">
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

    // return $this->data;
    return view($this->menuActive . '.' . $this->submnActive . '.' . 'main')->with('data', $this->data);
  }

  public function addGudang(Request $request)
  {
    try {
      $data['data'] = $request->id ? MasterGudang::find($request->id) : null;
      $content = view('data-master.data_gudang.form', $data)->render();
      return ['status' => 'success', 'content' => $content];
    } catch (\Exception $e) {
      return ['status' => 'success', 'content' => $e->getMessage()];
    }
  }

  public function store(Request $request)
  {
    try {
      if (!empty($request->id)) {
        $newdata = MasterGudang::where('id_master_gudang', $request->id)->first();
        $user = User::where('id', $newdata->user_id)->first();

      } else {
        $newdata = new MasterGudang();
        $user = new User();

      }
      $user_login = Auth::user();
      $user->name = $request->username;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->level_user = 5;
      $user->perusahaan_id = $user_login->perusahaan_id;
      $user->status = "Aktif";
      $user->save();

      $newdata->user_id = $user->id;
      $newdata->kode_gudang = $request->kode_gudang;
      $newdata->nama_gudang = $request->nama_gudang;
      $newdata->alamat_gudang = $request->alamat_gudang;
      $newdata->telepon = $request->telepon;
      $newdata->perusahaan_id =  $user_login->perusahaan_id;;
      $newdata->save();
      if ($newdata) {
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
    // return $request->all();
    try {
      $user = MasterGudang::find($request->id);

      if (!$user) {
        return response()->json(
          [
            'error' => 'Data not found',
          ],
          404
        );
      } else {
        $user->delete();
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
