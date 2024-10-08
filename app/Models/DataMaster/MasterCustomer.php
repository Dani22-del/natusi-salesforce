<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCustomer extends Model
{
  use HasFactory;
  protected $table = 'master_customer';
  protected $guarded = ['id'];
  public $timestamp = true;

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class, 'customer_id', 'id');
    }

}
