<?php

namespace App\Models;

use App\Models\DataMaster\MasterGudang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDriver extends Model
{
    use HasFactory;
    protected $table = 'master_driver';
    protected $primaryKey = 'id_master_driver';
    public $timestamp = true;

    public function users()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function gudang()
  {
    return $this->belongsTo(MasterGudang::class, 'gudang_id', 'id_master_gudang');
  }
}
