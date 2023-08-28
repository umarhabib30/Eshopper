<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'price',
        'stock',
        'stock_limit',
        'description',
        'image',
        'cat_id',
        'subcat_id',
    ];

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = ImageHelper::saveImage($value,'product_images');
    }

    public function getImageAttribute($value)
    {
        return asset($value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcat_id');
    }
}
