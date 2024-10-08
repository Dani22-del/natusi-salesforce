<?php

namespace App\Models;

use App\Models\DataMaster\MasterProduk;
use App\Models\DataMaster\MasterSatuan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanProduk extends Model
{
  use HasFactory;
  protected $table = 'satuan_produk_table';
  protected $primaryKey = 'id_satuan_produk';
  public $timestamp = true;
  public function master_satuan()
  {
    return $this->belongsTo(MasterSatuan::class, 'satuan_id');
  }
  // public function master_produk()
  // {
  //   return $this->belongsTo(MasterProduk::class, 'master_produk_id');
  // }
}
