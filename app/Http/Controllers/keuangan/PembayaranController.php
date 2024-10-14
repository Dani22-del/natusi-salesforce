<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterCustomer;
use App\Models\DataMaster\MasterSales;
use Illuminate\Http\Request;
use DataTables, validator, Hash, Auth;
use App\Models\DataMaster\SalesOrder;
use App\Models\MasterPiutang;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    private $title = 'Pembayaran';
    private $menuActive = 'keuangan';
    private $submnActive = 'pembayaran';
    public function index(Request $request)
    {
     
        // return view('keuangan.pembayaran.form_cetak');
      if ($request->ajax()) {
        $data = Pembayaran::with('sales', 'customer','so')
          ->orderBy('id_pembayaran', 'DESC')
          ->get();
  
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
              $btn = '<div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                  <i class="ri-more-2-line"></i>
              </button>
              <div class="dropdown-menu " data-popper-placement="bottom-end">
                  <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_pembayaran . ')">
                      <i class="ri-pencil-line me-1"></i> Edit
                  </a>
                  <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_pembayaran . ')">
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

    public function createPembayaran(Request $request)
  {
    if($request->so_id){
      $so = SalesOrder::find($request->so_id);
      return response()->json(['date' => $so->tanggal_invoice]);
    }
    try {
      $data['so'] = SalesOrder::all();
      $data['data'] = $request->id ? Pembayaran::find($request->id) : null;
      $content = view('keuangan.pembayaran.form', $data)->render();
      return ['status' => 'success', 'content' => $content];
    } catch (\Exception $e) {
      return ['status' => 'success', 'content' => $e->getMessage()];
    }
  }

    public function store(Request $request)
    {
        try {
          if (!empty($request->id)) {
              $new_pembayaran = Pembayaran::find($request->id);
              $so = SalesOrder::find($request->so_id);
              $piutang = MasterPiutang::where('so_id',$request->so_id)->first();
          } else {
              $new_pembayaran = new Pembayaran();
              $so = SalesOrder::find($request->so_id);
              $piutang = MasterPiutang::where('so_id',$request->so_id)->first();
          }
        
          $tanggalInvoice = date('YmdHis');
          $no_invoice = 'INV-' . $tanggalInvoice . '-' . mt_rand(1000, 9999);
          $new_pembayaran->customer_id = $so->customer_id;
          $new_pembayaran->sales_id = $so->sales_id;
          $new_pembayaran->no_kwitansi = $no_invoice;
          $new_pembayaran->tanggal_bayar = $request->tanggal;
          $new_pembayaran->metode_bayar = $request->metode_bayar;
          $new_pembayaran->jumlah_bayar = $request->nominal_bayar;
          $new_pembayaran->so_id = $request->so_id;
          $new_pembayaran->piutang_id = $piutang->id_piutang;
          $new_pembayaran->save();

          if ($new_pembayaran->jumlah_bayar == 0) {
            // If jumlah_bayar is 0
                $piutang->jumlah_bayar = $new_pembayaran->jumlah_bayar;
                $piutang->sisa_piutang = $piutang->total_invoice - $piutang->jumlah_bayar;
            } else {
                // If jumlah_bayar is greater than 0
                $piutang->sisa_piutang = $piutang->sisa_piutang - $new_pembayaran->jumlah_bayar;
            }
          $piutang->save();

          if ($new_pembayaran) {
              if (!empty($request->id)) {
                  return ['code' => '200', 'status' => 'success', 'message' => 'Berhasil Edit Data','id' =>$new_pembayaran->id_pembayaran];
              } else {
                  return ['code' => '200', 'status' => 'success', 'message' => 'Berhasil Tambah Data','id' =>$new_pembayaran->id_pembayaran];
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

    public function printForm($id)
{
    // Cari pembayaran berdasarkan ID
    $pembayaran = Pembayaran::find($id);
    $so = SalesOrder::where('id', $pembayaran->so_id)->first();
    $sales = MasterSales::where('id_master_sales', $so->sales_id)->first();
    $customer = MasterCustomer::where('id', $so->customer_id)->first();
    $piutang = MasterPiutang::where('so_id', $pembayaran->so_id)->first();

    // Kembalikan tampilan untuk form cetak
    return view('keuangan.pembayaran.form_cetak', compact('pembayaran', 'so', 'sales', 'customer', 'piutang'));
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
          $user = Pembayaran::find($request->id);

          if (!$user) {
              return response()->json(
                  [
                      'error' => 'Data not found',
                  ],
                  404
              );
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
