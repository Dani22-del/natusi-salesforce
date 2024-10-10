<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\MasterCustomer;
use App\Models\DataMaster\MasterProduk;
use App\Models\DataMaster\MasterSales;
use App\Models\DataMaster\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Support\Str;
use DataTables, validator, Hash, Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesOrder::with('customer', 'sales')->orderBy('id', 'DESC');
            // return $data;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true">
                      <i class="ri-more-2-line"></i>
                  </button>
                  <div class="dropdown-menu " data-popper-placement="bottom-end">
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="detailSales(' . $row->id . ')">
                          <i class="ri-zoom-in-line"></i> Detail
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
        return view('sales.sales_order.main');
    }

    public function createSales(Request $request)
    {
        $data['customers'] = MasterCustomer::all();
        $data['produk'] = MasterProduk::all();
        $data['data'] = null;
        $content = view('sales.sales_order.form', $data)->render();
        return ['status' => 'success', 'content' => $content, 'data' => $data];
    }


    public function store(Request $request)
    {
        $request->validate([
            'cart' => 'required|array|min:1',
            'cart.*.customer_id' => 'required|exists:master_customer,id',
            'cart.*.produk_id' => 'required|exists:master_produk,id_master_produk',
            'cart.*.tanggal_invoice' => 'required|date',
            'cart.*.top' => 'required|in:Cash,Kredit 7 Hari,Kredit 12 Hari,Kredit 30 Hari',
            'cart.*.qty' => 'required|integer|min:1',
            'cart.*.discount' => 'nullable|numeric',
            'cart.*.keterangan_discount' => 'nullable|string',
            'cart.*.limit_kredit' => 'nullable|numeric',
        ]);

        $sale = MasterSales::find(6);
        $tanggalInvoice = Carbon::parse($request->cart[0]['tanggal_invoice']);
        $no_invoice = 'INV-' . $tanggalInvoice->format('YmdHis') . '-' . rand(1000, 9999);
        $kodeSO = 'SO-' . rand(1000, 9999);
        $totalInvoice = 0;

        DB::beginTransaction(); // Mulai transaksi

        try {
            // Simpan data sales order
            $salesOrder = new SalesOrder();
            $salesOrder->schedule_id = 1;
            $salesOrder->kode_so = $kodeSO;
            $salesOrder->sales_id = $sale->id_master_sales;
            $salesOrder->kode_sales = $sale->kode_sales;
            $salesOrder->customer_id = $request->cart[0]['customer_id']; // Ambil dari cart
            $salesOrder->kode_customer = MasterCustomer::find($request->cart[0]['customer_id'])->kode_customer; // Ambil kode_customer
            $salesOrder->no_invoice = $no_invoice;
            $salesOrder->tanggal_invoice = $request->cart[0]['tanggal_invoice']; // Ambil tanggal_invoice
            $salesOrder->top = $request->cart[0]['top']; // Ambil top
            $salesOrder->status_approve = 'Pending';

            // Hitung total_invoice dari semua item dalam cart
            foreach ($request->cart as $item) {
                $produk = MasterProduk::find($item['produk_id']);
                $totalInvoice += $this->calculateSubtotal(
                    $produk->harga_pokok_penjualan,
                    $item['qty'],
                    $item['discount'] ?? 0
                );
            }

            $salesOrder->total_invoice = $totalInvoice; // Simpan total_invoice
            $salesOrder->save(); // Simpan sales order

            // Simpan setiap item ke dalam sales order items
            foreach ($request->cart as $item) {
                $salesOrderItem = new SalesOrderItem();
                $salesOrderItem->sales_order_id = $salesOrder->id; // Mengaitkan dengan sales order
                $salesOrderItem->produk_id = $item['produk_id'];
                $salesOrderItem->qty = $item['qty'];
                $salesOrderItem->discount = $item['discount'] ?? 0;
                $salesOrderItem->keterangan_discount = $item['keterangan_discount'] ?? null;
                $salesOrderItem->subtotal = $item['subtotal'];
                $salesOrderItem->limit_kredit = $item['limit_kredit'] ?? null; // Simpan limit_kredit
                $salesOrderItem->save(); // Simpan item
            }

            DB::commit(); // Komit transaksi jika semua berhasil

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    private function calculateSubtotal($harga, $qty, $discount)
    {
        $discountAmount = ($harga * $qty * $discount) / 100;
        return ($harga * $qty) - $discountAmount;
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $salesOrder = SalesOrder::findOrFail($id);

            if ($salesOrder->status_approve !== 'Pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Sales Order sudah diupdate sebelumnya.'
                ], 400);
            }

            if ($request->action === 'accept') {
                $salesOrder->status_approve = 'Dikirim';
            } elseif ($request->action === 'reject') {
                $salesOrder->status_approve = 'Ditolak';
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Aksi tidak valid.'
                ], 400);
            }

            $salesOrder->save();

            return response()->json([
                'success' => true,
                'message' => 'Status Sales Order berhasil diperbarui.',
                'new_status' => $salesOrder->status_approve
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function detailSales(Request $request)
    {
        $salesOrder = SalesOrder::with(['sales', 'customer', 'items.produk'])->find($request->id);

        $totalHarga = $salesOrder->items->sum(function ($item) {
            return $item->subtotal;
        });

        $data = [
            'salesOrder' => $salesOrder,
            'totalHarga' => $totalHarga,
        ];

        $content = view('sales.sales_order.detail-sales', $data)->render();
        return ['status' => 'success', 'content' => $content, 'data' => $data];
    }

    public function getOrderItemDetails(Request $request)
    {
        $orderItem = SalesOrderItem::with('produk')->find($request->id);

        if ($orderItem) {
            return response()->json($orderItem);
        }
        return response()->json(['error' => 'Order item not found'], 404);
    }

    public function updateOrderItem(Request $request)
    {
        $orderItem = SalesOrderItem::find($request->id);

        if ($orderItem) {
            $orderItem->qty = $request->qty;
            $orderItem->discount = $request->diskon;
            $orderItem->subtotal = $request->sub_total;
            $orderItem->save();

            $masterSoId = $orderItem->salesOrder->id;
            $totalInvoice = SalesOrderItem::where('sales_order_id', $masterSoId)->sum('subtotal');

            $masterSo = SalesOrder::find($masterSoId);
            if ($masterSo) {
                $masterSo->total_invoice = $totalInvoice;
                $masterSo->save();
            }

            return response()->json(['success' => true, 'message' => 'Order item updated successfully', 'total_invoice' => $totalInvoice]);
        }

        return response()->json(['success' => false, 'message' => 'Order item not found']);
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $user = SalesOrder::find($request->id);

            if (!$user) {
                return response()->json(
                    [
                        'metaData' => [
                            'status' => 404,
                            'success' => false,
                            'message' => 'Data not found'
                        ]
                    ],
                    404
                );
            }

            $user->delete();

            return response()->json([
                'metaData' => [
                    'status' => 200,
                    'success' => true,
                    'message' => 'Data berhasil dihapus'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'metaData' => [
                        'status' => 500,
                        'success' => false,
                        'message' => 'Terjadi kesalahan, silahkan coba lagi'
                    ],
                    'response' => [
                        'error' => $e->getMessage()
                    ]
                ],
                500
            );
        }
    }

    public function destroyOrderItem(Request $request)
    {
        try {
            $user = SalesOrderItem::find($request->id);

            if (!$user) {
                return response()->json(
                    [
                        'metaData' => [
                            'status' => 404,
                            'success' => false,
                            'message' => 'Data not found'
                        ]
                    ],
                    404
                );
            }

            $user->delete();

            return response()->json([
                'metaData' => [
                    'status' => 200,
                    'success' => true,
                    'message' => 'Data berhasil dihapus'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'metaData' => [
                        'status' => 500,
                        'success' => false,
                        'message' => 'Terjadi kesalahan, silahkan coba lagi'
                    ],
                    'response' => [
                        'error' => $e->getMessage()
                    ]
                ],
                500
            );
        }
    }
}
