<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataMaster\MasterCustomer;
use App\Models\DataMaster\MasterSales;
use App\Models\DataMaster\SalesOrder;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $timestamp = true;
    public function sales()
    {
      return $this->belongsTo(MasterSales::class, 'sales_id');
    }
    public function customer()
    {
      return $this->belongsTo(MasterCustomer::class, 'customer_id');
    }
    public function so()
    {
      return $this->belongsTo(SalesOrder::class, 'so_id');
    }
}
