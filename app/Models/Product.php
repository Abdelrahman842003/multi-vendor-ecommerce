<?php

namespace App\Models;

use App\Models\Scopes\ProductScope;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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


    public function scopeActive(Builder $builder)
    {
        $builder->where('products.status', '=', 'active');
    }

    public function scopeProductsReturn(Builder $builder)
    {
        $builder->where('store_id', '=', auth()->user()->store_id);
    }


//    protected static function booted()
//    {
//        static::addGlobalScope(new ProductScope());
//    }

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


    // Accessors => get.....Attribute  =>getImageUrlAttribute => call ==> image_url
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://tavet.se/wp-content/uploads/2020/06/no-product-image.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return asset('storage/attachments/' . $this->image);
    }

    public function getSalePriceAttribute()
    {
        if (!$this->compare_price) {
            return false;
        }
        return round(($this->price * $this->compare_price / 100), 1);

    }

}
