<?php

namespace App\Models\DataMaster;

use App\Models\SalesOrderItem;
use App\Models\SatuanProduk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProduk extends Model
{
    use HasFactory;
    protected $table = 'master_produk';
    protected $primaryKey = 'id_master_produk';
    public $timestamp = true;

    public function principle()
    {
        return $this->belongsTo(MasterPrincipal::class, 'principle_id');
    }
    public function gudang()
    {
        return $this->belongsTo(MasterGudang::class, 'gudang_id');
    }
    public function stocks()
    {
        return $this->hasMany(MasterStock::class, 'produk_id', 'id_master_produk');
    }

    public function satuan()
    {
        return $this->hasMany(SatuanProduk::class, 'master_produk_id');
    }

    public function salesOrderItems()
    {
        return $this->hasMany(SalesOrderItem::class, 'produk_id');
    }
}
