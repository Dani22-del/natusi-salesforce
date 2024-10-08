<?php

namespace App\Models;

use App\Models\DataMaster\MasterPrincipal;
use App\Models\DataMaster\MasterSales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrincipalSales extends Model
{
  use HasFactory;
  protected $table = 'principal_sales';
  protected $primaryKey = 'id_principle_sales';
  public $timestamp = true;

  public function master_principal()
  {
    return $this->belongsTo(MasterPrincipal::class, 'principle_id');
  }
  // public function master_sales()
  // {
  //   return $this->belongsTo(MasterSales::class, 'sales_id');
  // }
}
