<?php

namespace App\Models;

use App\Models\Scopes\ProductScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'store_id',
        'parent_id',
        'slug',
        'description',
        'image',
        'status',
        'created_at',
        'updated_at',

    ];

    // global scope
    protected static function booted()
    {
        static::addGlobalScope(new ProductScope());
    }


    // local scope Filter
    public function scopeFilter(Builder $builder ,$requestFilter)
    {
        $builder->where('categories.name', 'like', '%' . ($requestFilter['name'] ?? '') . '%')
            ->where('categories.status', 'like', '%' . ($requestFilter['status'] ?? '') . '%');
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function parent(){
        return $this->belongsTo(Category::class,'parent_id')->withDefault();
    }
    public function product(){
        return $this->hasMany(Product::class);
    }

}
