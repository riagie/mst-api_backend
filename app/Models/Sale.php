<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 't_sales';
    protected $fillable = [
        'kode', 
        'tgl', 
        'cust_id', 
        'subtotal', 
        'diskon', 
        'ongkir', 
        'total_bayar'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id');
    }

    public function salesDet()
    {
        return $this->hasMany(SalesDet::class, 'sales_id');
    }
}
