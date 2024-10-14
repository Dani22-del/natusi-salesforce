<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPiutang extends Model
{
    use HasFactory;
    protected $table = 'master_piutang';
    protected $primaryKey = 'id_piutang';
    public $timestamp = true;
}
