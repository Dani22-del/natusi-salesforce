<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterCustomer;
use App\Models\DataMaster\MasterSales;
use App\Models\PrincipalSales;
use App\Models\ScheduleSales;
use Illuminate\Http\Request;
use DataTables, validator, DB, Hash, Auth;


class ScheduleController extends Controller
{
    private $title = 'Schedule';
    private $menuActive = 'sales';
    private $submnActive = 'schedule';
    public function index(Request $request)
    {

      if ($request->ajax()) {
        $data = ScheduleSales::with('sales', 'customer')
          ->orderBy('id_schedule_sales', 'DESC')
          ->get();
  
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
              $btn = '<div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                  <i class="ri-more-2-line"></i>
              </button>
              <div class="dropdown-menu " data-popper-placement="bottom-end">
                  <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_schedule_sales . ')">
                      <i class="ri-pencil-line me-1"></i> Edit
                  </a>
                  <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_schedule_sales . ')">
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

    public function createSchedule(Request $request)
    {
      // return $request->all();
      try {
        if($request->sales_id){
          $principelSales = PrincipalSales::with('master_principal')->where('sales_id',$request->sales_id)->get();
          $principelSalesData = $principelSales->map(function($principelSale) {
              return [
                  'principle_id' => $principelSale->principle_id,
                  'principle_name' => $principelSale->master_principal->nama_principal, 
              ];
          });
        
          return response()->json($principelSalesData);
        }
        $user_login = Auth::user();
        $data['sales'] = MasterSales::where('perusahaan_id', $user_login->perusahaan_id)->get();
        $data['customer'] = MasterCustomer::all();
        $data['data']= $request->id ? ScheduleSales::find($request->id) : null;
        $content = view('sales.schedule.form', $data)->render();
        return ['status' => 'success', 'content' => $content];
      } catch(\Exception $e) {
        return ['status' => 'success', 'content' => $e->getMessage()];
      }
    }

    public function detailSchedule() {
      try {
        $data['data']="";
        $content = view('sales.schedule.detail', $data)->render();
        return ['status' => 'success', 'content' => $content];
      } catch(\Exception $e) {
        return ['status' => 'success', 'content' => $e->getMessage()];
      }
    }

    public function store(Request $request)
    {
        try {
          if (!empty($request->id)) {
              $newdata = ScheduleSales::find($request->id);
          } else {
              $newdata = new ScheduleSales();
          }
          $newdata->tanggal = $request->tanggal;
          $newdata->sales_id = $request->sales_id;
          $newdata->customer_id = $request->customer_id;
          $newdata->jenis = "Day";
          $newdata->status_kunjung = "Belum";
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
        $user = ScheduleSales::find($request->id);
  
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
