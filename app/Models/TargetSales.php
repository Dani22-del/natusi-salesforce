<?php

namespace App\Models;

use App\Models\DataMaster\MasterSales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetSales extends Model
{
    use HasFactory;
    protected $table = 'target_sales';
    protected $primaryKey = 'id';
    public $timestamp = true;

    public function sales()
    {
        return $this->belongsTo(MasterSales::class, 'sales_id');
    }
}
