<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterCustomer;
use App\Models\DataMaster\MasterSales;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    private $title = 'Pembayaran';
    private $menuActive = 'keuangan';
    private $submnActive = 'pembayaran';
    public function index(Request $request)
    {
        return view('keuangan.pembayaran.main');
        
      // if ($request->ajax()) {
      //   $data = ScheduleSales::with('sales', 'customer')
      //     ->orderBy('id_schedule_sales', 'DESC')
      //     ->get();
  
      //   return Datatables::of($data)
      //     ->addIndexColumn()
      //     ->addColumn('action', function ($row) {
      //         $btn = '<div class="dropdown">
      //         <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
      //             <i class="ri-more-2-line"></i>
      //         </button>
      //         <div class="dropdown-menu " data-popper-placement="bottom-end">
      //             <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="editForm(' . $row->id_schedule_sales . ')">
      //                 <i class="ri-pencil-line me-1"></i> Edit
      //             </a>
      //             <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="deleteForm(' . $row->id_schedule_sales . ')">
      //                 <i class="ri-delete-bin-7-line me-1"></i> Delete
      //             </a>
      //         </div>
      //     </div>';
      //       return $btn;
      //     })
      //     ->rawColumns(['action'])
      //     ->make(true);
      // }
      // $this->data['title'] = $this->title;
      // $this->data['menuActive'] = $this->menuActive;
      // $this->data['submnActive'] = $this->submnActive;
      // $this->data['smallTitle'] = '';
      // return view($this->menuActive . '.' . $this->submnActive . '.' . 'main')->with('data', $this->data);
    }

    public function createPembayaran(Request $request)
  {
    try {
      $data['data'] = '';
      $content = view('keuangan.pembayaran.form', $data)->render();
      return ['status' => 'success', 'content' => $content];
    } catch (\Exception $e) {
      return ['status' => 'success', 'content' => $e->getMessage()];
    }
  }

    public function store(Request $request)
    {

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

    public function destroy(string $id)
    {
        //
    }
}
