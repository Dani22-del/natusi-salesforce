<?php

namespace App\Http\Controllers\driver;

use App\Http\Controllers\Controller;
use App\Models\MasterDriver;
use App\Models\ScheduleDriver;
use App\Models\DataMaster\MasterCustomer;
use App\Models\DataMaster\SalesOrder;
use Illuminate\Http\Request;
use DataTables, validator, DB, Hash, Auth;


class ScheduleController extends Controller
{
    private $title = 'Schedule Driver';
    private $menuActive = 'driver';
    private $submnActive = 'schedule';
    public function index(Request $request)
    {
      // return view('driver.schedule.main');
   
      if ($request->ajax()) {
        $data = ScheduleDriver::with('driver', 'customer','so')
          ->orderBy('id_schedule_driver', 'DESC')
          ->get();
  
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
              $btn = '<div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                  <i class="ri-more-2-line"></i>
              </button>
              <div class="dropdown-menu " data-popper-placement="bottom-end">
                  <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_schedule_driver . ')">
                      <i class="ri-pencil-line me-1"></i> Edit
                  </a>
                  <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_schedule_driver . ')">
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
      try {
        $user_login = Auth::user();
        $data['driver'] = MasterDriver::where('perusahaan_id', $user_login->perusahaan_id)->get();
        $data['customer'] = MasterCustomer::all();
        $data['so'] = SalesOrder::all();
        $data['data']= $request->id ? ScheduleDriver::find($request->id) : null;
        $content = view('driver.schedule.form', $data)->render();
        return ['status' => 'success', 'content' => $content];
      } catch(\Exception $e) {
        return ['status' => 'success', 'content' => $e->getMessage()];
      }
    }

    public function store(Request $request)
    {
        try {
          if (!empty($request->id)) {
              $newdata = ScheduleDriver::find($request->id);
          } else {
              $newdata = new ScheduleDriver();
          }
          $newdata->tanggal = $request->tanggal;
          $newdata->driver_id = $request->driver_id;
          $newdata->customer_id = $request->customer_id;
          $newdata->so_id = $request->so_id;
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
        $user = ScheduleDriver::find($request->id);
  
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
