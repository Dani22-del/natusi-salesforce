<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPrincipal extends Model
{
  use HasFactory;
  protected $table = 'master_principal';
  protected $primaryKey = 'id_master_principal';
  public $timestamp = true;
}
