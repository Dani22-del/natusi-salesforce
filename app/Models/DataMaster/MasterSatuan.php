<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSatuan extends Model
{
  use HasFactory;
  protected $table = 'master_satuan';
  protected $primaryKey = 'id_master_satuan';
  public $timestamp = true;
}
