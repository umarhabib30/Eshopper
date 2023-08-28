<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $fillable=[
        'grandtotal','grand_qty',
    ];

    public function sale_items()
    {
        return $this->hasMany(SalesItem::class,'sale_id');
    }
}
