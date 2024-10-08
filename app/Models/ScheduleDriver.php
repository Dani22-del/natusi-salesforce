<?php

namespace App\Models;
use App\Models\DataMaster\MasterCustomer;
use App\Models\MasterDriver;
use App\Models\DataMaster\SalesOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDriver extends Model
{
    use HasFactory;
    protected $table = 'master_schedule_driver';
    protected $primaryKey = 'id_schedule_driver';
    public $timestamp = true;
    public function driver()
    {
      return $this->belongsTo(MasterDriver::class, 'driver_id');
    }
    public function customer()
    {
      return $this->belongsTo(MasterCustomer::class, 'customer_id');
    }
    public function so()
    {
      return $this->belongsTo(SalesOrder::class, 'so_id');
    }
}
