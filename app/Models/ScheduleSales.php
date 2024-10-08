<?php

namespace App\Models;

use App\Models\DataMaster\MasterCustomer;
use App\Models\DataMaster\MasterSales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleSales extends Model
{
    use HasFactory;
    protected $table = 'master_schedule_sales';
    protected $primaryKey = 'id_schedule_sales';
    public $timestamp = true;
    public function sales()
    {
      return $this->belongsTo(MasterSales::class, 'sales_id');
    }
    public function customer()
    {
      return $this->belongsTo(MasterCustomer::class, 'customer_id');
    }
}
