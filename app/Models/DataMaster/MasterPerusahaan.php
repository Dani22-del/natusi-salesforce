<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MasterPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'master_perusahaan';
    protected $primaryKey = 'id_master_perusahaan';
    public $timestamp = true;

    public function users()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
