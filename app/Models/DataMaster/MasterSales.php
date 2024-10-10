<?php

namespace App\Models\DataMaster;

use App\Models\PrincipalSales;
use App\Models\TargetSales;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class MasterSales extends Model
{
  use HasFactory;
  protected $table = 'master_sales';
  protected $primaryKey = 'id_master_sales';
  public $timestamp = true;

  public function users()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
  public function gudang()
  {
    return $this->belongsTo(MasterGudang::class, 'gudang_id', 'id_master_gudang');
  }
  public function principal_sales()
  {
    return $this->hasMany(PrincipalSales::class, 'sales_id');
  }

  public function salesOrders()
{
    return $this->hasMany(SalesOrder::class, 'sales_id', 'id_master_sales');
}

public function targetSales()
{
    return $this->hasMany(TargetSales::class, 'sales_id');
}

}
