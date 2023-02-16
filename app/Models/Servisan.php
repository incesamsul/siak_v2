<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servisan extends Model
{
    use HasFactory;
    protected $table = 'servisan';
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand', 'id_brand');
    }

    public function model()
    {
        return $this->belongsTo(ModelLaptop::class, 'id_model', 'id_model');
    }

}
