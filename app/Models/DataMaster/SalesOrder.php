<?php

namespace App\Models\DataMaster;

use App\Models\SalesOrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
  use HasFactory;
  protected $table = 'master_so';
  protected $primaryKey = 'id';
  public $timestamp = true;

  public function customer()
{
    return $this->belongsTo(MasterCustomer::class, 'customer_id', 'id');
}

public function sales()
{
    return $this->belongsTo(MasterSales::class, 'sales_id', 'id_master_sales');
}

public function items()
{
    return $this->hasMany(SalesOrderItem::class, 'sales_order_id');
}
}
