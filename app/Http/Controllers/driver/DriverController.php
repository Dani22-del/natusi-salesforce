<?php

namespace App\Http\Controllers\driver;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterGudang;
use App\Models\MasterDriver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Validator, DB, Hash, Auth;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    private $title = 'Driver';
    private $menuActive = 'driver';
    private $submnActive = 'data_driver';
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = MasterDriver::with('users', 'gudang')
                ->orderBy('id_master_driver', 'ASC')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                <i class="ri-more-2-line"></i>
            </button>
            <div class="dropdown-menu " data-popper-placement="bottom-end">
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_master_driver . ')">
                    <i class="ri-pencil-line me-1"></i> Edit
                </a>
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_master_driver . ')">
                    <i class="ri-delete-bin-7-line me-1"></i> Delete
                </a>
            </div>
        </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data['title'] = $this->title;
        $data['menuActive'] = $this->menuActive;
        $data['submnActive'] = $this->submnActive;
        $data['smallTitle'] = '';

        return view($this->menuActive . '.' . $this->submnActive . '.main')->with('data', $data);
    }

    public function createDriver(Request $request)
    {
        try {
            $data['gudang'] = MasterGudang::where('perusahaan_id', 1)->get();
            $data['data'] = $request->id ? MasterDriver::find($request->id) : null;
            $content = view('driver.data_driver.form', $data)->render();
            return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => $e->getMessage()];
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($request->user_id),
            ],
            'name' => 'required|string|max:255',
            'password' => $request->user_id ? 'nullable|string|min:8' : 'required|string|min:8',
            'nama_lengkap' => 'required|string|max:255',
            'kode_driver' => 'required|string|max:50',
            'gudang_id' => 'required|integer',
            'no_telp' => 'required|digits_between:10,15',
            'foto' => 'nullable|image|max:2048',
        ]);

        try {
            if (!empty($request->user_id)) {
                $user = User::findOrFail($request->user_id);
            } else {
                $user = new User();
            }
            $user_login = Auth::user();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->status = "Aktif";
            $user->level_user = 4;
            $user->perusahaan_id = $user_login->perusahaan_id;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            if (!empty($request->id)) {
                $driver = MasterDriver::findOrFail($request->id);
            } else {
                $driver = new MasterDriver();
            }

            $driver->nama_lengkap = $request->nama_lengkap;
            $driver->kode_driver = $request->kode_driver;
            $driver->gudang_id = $request->gudang_id;
            $driver->no_telp = $request->no_telp;
            $driver->user_id = $user->id;
            $driver->foto = $request->hasFile('foto') ? $request->file('foto')->store('drivers', 'public') : $driver->foto;
            $driver->perusahaan_id =  $user_login->perusahaan_id;
            $driver->save();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => !empty($request->id) ? 'Berhasil Edit Data' : 'Berhasil Tambah Data',
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


    public function destroy(Request $request)
    {
        try {
            $user = MasterDriver::find($request->id);

            if (!$user) {
                return response()->json(
                    [
                        'error' => 'Data not found',
                    ],
                    404
                );
            }

            // Menghapus file foto jika ada
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }
            
            $user->delete();

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
