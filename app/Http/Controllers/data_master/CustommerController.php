<?php

namespace App\Http\Controllers\data_master;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterCustomer;
use Illuminate\Http\Request;
use DataTables, validator, DB, Hash, Auth;
use Illuminate\Support\Facades\Storage;

class CustommerController extends Controller
{
    private $title = 'Customer';
    private $menuActive = 'data-master';
    private $submnActive = 'data_custommer';
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterCustomer::orderBy('id', 'DESC');
            // return $data;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                      <i class="ri-more-2-line"></i>
                  </button>
                  <div class="dropdown-menu " data-popper-placement="bottom-end">
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="detailCustommer(' . $row->id . ')">
                          <i class="ri-zoom-in-line"></i> Detail
                      </a>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id . ')">
                          <i class="ri-pencil-line me-1"></i> Edit
                      </a>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id . ')">
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

    public function addCustommer(Request $request)
    {
        try {
            $data['data'] = $request->id ? MasterCustomer::find($request->id) : null;
            $content = view('data-master.data_custommer.form', $data)->render();
            return ['status' => 'success', 'content' => $content];
        } catch (\Exception $e) {
            return ['status' => 'success', 'content' => $e->getMessage()];
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_customer' => 'required|unique:master_customer,kode_customer' . ($request->id ? ',' . $request->id : ''),
            'nama_toko' => 'required|string|max:255',
            'alamat_toko' => 'required|string',
            'alamat_pengiriman' => 'required|in:alamat_toko,alamat_lainnya',
            'alamat_lainnya' => 'nullable|string|required_if:alamat_pengiriman,alamat_lainnya',
            'nama_pemilik' => 'required|string|max:255',
            'no_telepon' => 'required|numeric|unique:master_customer,no_telepon' . ($request->id ? ',' . $request->id : ''),
            'top' => 'required|in:Cash,Kredit 7 Hari,Kredit 12 Hari,Kredit 30 Hari',
            'limit_kredit' => 'nullable|integer',
            'jatuh_tempo' => 'nullable|date',
            'foto_toko' => 'nullable|image|max:2048'
        ], [
            'kode_customer.required' => 'Kode customer harus diisi.',
            'kode_customer.unique' => 'Kode customer sudah terdaftar.',
            'nama_toko.required' => 'Nama toko harus diisi.',
            'alamat_toko.required' => 'Alamat toko harus diisi.',
            'alamat_pengiriman.required' => 'Alamat pengiriman harus diisi.',
            'alamat_lainnya.required_if' => 'Alamat lainnya harus diisi jika pengiriman bukan ke alamat toko.',
            'nama_pemilik.required' => 'Nama pemilik harus diisi.',
            'no_telepon.required' => 'Nomor telepon harus diisi.',
            'no_telepon.numeric' => 'Nomor telepon harus berupa angka.',
            'no_telepon.unique' => 'Nomor telepon sudah terdaftar.',
            'top.required' => 'TOP harus dipilih.',
            'limit_kredit.integer' => 'Limit kredit harus berupa angka.',
            'jatuh_tempo.date' => 'Jatuh tempo harus berupa tanggal yang valid.',
            'foto_toko.image' => 'Foto toko harus berupa gambar.',
            'foto_toko.max' => 'Ukuran foto toko maksimal 2MB.'
        ]);

        try {
            if ($request->filled('id')) {
                $customer = MasterCustomer::findOrFail($request->id);
            } else {
                $customer = new MasterCustomer();
            }

            // Assign data dari request ke model
            $customer->kode_customer = $request->kode_customer;
            $customer->nama_toko = $request->nama_toko;
            $customer->alamat_toko = $request->alamat_toko;
            $customer->alamat_pengiriman = $request->alamat_pengiriman;
            $customer->alamat_lainnya = $request->alamat_lainnya;
            $customer->nama_pemilik = $request->nama_pemilik;
            $customer->no_telepon = $request->no_telepon;
            $customer->top = $request->top;
            $customer->limit_kredit = $request->limit_kredit;
            $customer->jatuh_tempo = $request->jatuh_tempo;

            // Handle the file upload with a custom name
            if ($request->hasFile('foto_toko')) {
                $file = $request->file('foto_toko');
                $filename = $request->kode_customer . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('customer', $filename, 'public');
                $customer->foto_toko = $path;
            }

            $customer->save();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => $request->filled('id') ? 'Berhasil Edit Data Customer' : 'Berhasil Tambah Data Customer',
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


    public function detailCustommer(Request $request)
    {
        try {
            $data['data'] = MasterCustomer::find($request->id);
            $content = view('data-master.data_custommer.show', $data)->render();
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
            $user = MasterCustomer::find($request->id);

            if (!$user) {
                return response()->json(
                    [
                        'error' => 'Data not found',
                    ],
                    404
                );
            }

            // Menghapus file foto jika ada
            if ($user->foto_toko && Storage::exists('public/' . $user->foto_toko)) {
                Storage::delete('public/' . $user->foto_toko);
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
