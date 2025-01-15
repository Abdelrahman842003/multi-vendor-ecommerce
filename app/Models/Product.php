<?php

namespace App\Models;

use App\Models\Scopes\ProductScope;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'price',
        'compare_price',
        'rating',
        'featured',
        'status',
        'store_id',
        'category_id',
    ];
    public function scopeFilter(Builder $builder, $requestFilter)
    {
        $builder->where('products.name', 'like', '%' . ($requestFilter['name'] ?? '') . '%')->where('products.status', 'like', '%' . ($requestFilter['status'] ?? '') . '%');
    }


    protected static function booted()
    {
        static::addGlobalScope(new ProductScope());
    }

    public function store()
    {
        return $this->belongsTo(Store::class)->withDefault();
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

