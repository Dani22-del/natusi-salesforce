<?php

namespace App\Models\DataMaster;

use App\Models\MasterDriver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MasterGudang extends Model
{
  use HasFactory;
  protected $table = 'master_gudang';
  protected $primaryKey = 'id_master_gudang';
  public $timestamp = true;

  public function sales()
  {
    return $this->hasMany(MasterSales::class, 'gudang_id', 'id_master_gudang');
  }

  public function driver()
  {
    return $this->hasMany(MasterDriver::class, 'gudang_id', 'id_master_gudang');
  }
  public function users()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
