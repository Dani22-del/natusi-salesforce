<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStock extends Model
{
  use HasFactory;
  protected $table = 'master_stock';
  protected $primaryKey = 'id_master_stock';
  public $timestamp = true;

  public function produk()
{
    return $this->belongsTo(MasterProduk::class, 'produk_id', 'id_master_produk');
}

}
