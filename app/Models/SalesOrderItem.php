<?php

namespace App\Models;

use App\Models\DataMaster\MasterProduk;
use App\Models\DataMaster\SalesOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderItem extends Model
{
    use HasFactory;
    protected $table = 'sales_order_items';
    protected $primaryKey = 'id';
    public $timestamp = true;

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'sales_order_id');
    }

    public function produk()
    {
        return $this->belongsTo(MasterProduk::class, 'produk_id');
    }
}
