<?php

namespace App\Http\Controllers\data_master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataMaster\MasterPerusahaan;
use App\Models\User;
use DataTables, validator, DB, Hash, Auth;
use Illuminate\Validation\Rule;

class PerusahaanController extends Controller
{
    private $title = 'Data Perusahaan';
    private $menuActive = 'data-master';
    private $submnActive = 'data_perusahaan';

    public function index(Request $request)
    {

        
        if ($request->ajax()) {
            $data = MasterPerusahaan::with('users')
                ->orderBy('id_master_perusahaan', 'DESC')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                    <i class="ri-more-2-line"></i>
                </button>
                <div class="dropdown-menu " data-popper-placement="bottom-end">
                    <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_master_perusahaan . ')">
                        <i class="ri-pencil-line me-1"></i> Edit
                    </a>
                    <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_master_perusahaan . ')">
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
    public function addPerusahaan(Request $request)
    {

        try {

            $data['data'] = $request->id
                ? MasterPerusahaan::where('id_master_perusahaan', $request->id)->with('users')
                ->first()
                : null;
            $content = view('data-master.data_perusahaan.form', $data)->render();
            return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => $e->getMessage()];
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:255',
            'nomor_telepon_perusahaan' => 'required|numeric|unique:master_perusahaan,nomor_telepon_perusahaan' . ($request->id_master_perusahaan ? ',' . $request->id_master_perusahaan : ''),
            'jenis_perusahaan' => 'required|string|max:255',
            'nama_pic' => 'required|string|max:255',
            'nomor_hp_pic' => 'required|numeric|unique:master_perusahaan,nomor_hp_pic' . ($request->id_master_perusahaan ? ',' . $request->id_master_perusahaan : ''),
            'username' => 'required|string|max:255|unique:users,name' . ($request->id_master_perusahaan ? ',' . $request->id_master_perusahaan : ''),
            'email' => 'required|email|unique:users,email' . ($request->id_master_perusahaan ? ',' . $request->id_master_perusahaan : ''),
            'password' => $request->id_master_perusahaan ? 'nullable|min:8' : 'required|min:8',
            'status' => 'required|in:Aktif,Non-Aktif'
        ], [
            // Custom error messages
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi.',
            'alamat_perusahaan.required' => 'Alamat perusahaan harus diisi.',
            'nomor_telepon_perusahaan.required' => 'Nomor telepon perusahaan harus diisi.',
            'nomor_telepon_perusahaan.unique' => 'Nomor telepon perusahaan sudah terdaftar.',
            'nomor_telepon_perusahaan.numeric' => 'Nomor telepon perusahaan harus berupa angka.',
            'jenis_perusahaan.required' => 'Jenis perusahaan harus diisi.',
            'nama_pic.required' => 'Nama PIC harus diisi.',
            'nomor_hp_pic.required' => 'Nomor HP PIC harus diisi.',
            'nomor_hp_pic.unique' => 'Nomor HP PIC sudah terdaftar.',
            'nomor_hp_pic.numeric' => 'Nomor HP PIC harus berupa angka.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'status.required' => 'Status harus diisi.',
            'status.in' => 'Status harus Aktif atau Non-Aktif.'
        ]);


        try {
            if (!empty($request->id)) {
                $new_perusahaan = MasterPerusahaan::find($request->id);
                $user = User::where('id', $new_perusahaan->user_id)->first();
            } else {
                $new_perusahaan = new MasterPerusahaan();
                $user = new User();
            }
            $user->name = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->level_user = 2;
            $user->perusahaan_id = 0;
            $user->status = $request->status;
            $user->save();

            $new_perusahaan->user_id = $user->id;
            $new_perusahaan->nama_perusahaan = $request->nama_perusahaan;
            $new_perusahaan->alamat_perusahaan = $request->alamat_perusahaan;
            $new_perusahaan->nomor_telepon_perusahaan = $request->nomor_telepon_perusahaan;
            $new_perusahaan->jenis_perusahaan = $request->jenis_perusahaan;
            $new_perusahaan->nama_pic = $request->nama_pic;
            $new_perusahaan->nomor_hp_pic = $request->nomor_hp_pic;
            $new_perusahaan->save();

            $user->perusahaan_id = $new_perusahaan->id_master_perusahaan;
            $user->save();

            if ($new_perusahaan) {
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

    public function destroy(Request $request)
    {
        try {
            $data['master_perusahaan'] = MasterPerusahaan::find($request->id);
            $data['user'] = User::find($data['master_perusahaan']->user_id);

            if (!$data) {
                return response()->json(
                    [
                        'error' => 'Data not found',
                    ],
                    404
                );
            } else {

                $data['master_perusahaan']->delete();
                $data['user']->delete();
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
