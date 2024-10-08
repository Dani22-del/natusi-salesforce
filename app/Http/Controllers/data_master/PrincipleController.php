<?php

namespace App\Http\Controllers\data_master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataMaster\MasterPrincipal;
use DataTables, validator, DB, Hash, Auth;

class PrincipleController extends Controller
{
    private $title = 'Principal';
    private $menuActive = 'data-master';
    private $submnActive = 'data_principle';
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterPrincipal::orderBy('id_master_principal', 'DESC');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                <i class="ri-more-2-line"></i>
            </button>
            <div class="dropdown-menu " data-popper-placement="bottom-end">
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_master_principal . ')">
                    <i class="ri-pencil-line me-1"></i> Edit
                </a>
                <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_master_principal . ')">
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

    public function addPrinciple(Request $request)
    {
        // return $request->all();
        try {
            $data['data'] = $request->id ? MasterPrincipal::find($request->id) : null;
            $content = view('data-master.data_principle.form', $data)->render();
            return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => $e->getMessage()];
        }
    }
    public function store(Request $request)
    {
        // return $request->all();
        // dd($request->all());
        try {
            if (!empty($request->id)) {
                $newdata = MasterPrincipal::where('id_master_principal', $request->id)->first();
            } else {
                $newdata = new MasterPrincipal();
            }
            $newdata->kode_principal = $request->kode_principal;
            $newdata->nama_principal = $request->nama_principal;
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
        try {
            $user = MasterPrincipal::find($request->id);

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
