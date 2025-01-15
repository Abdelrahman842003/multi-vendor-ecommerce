<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'logo_image',
        'cover_image',
        'status',];



    // local scope Filter
    public function scopeFilter(Builder $builder ,$requestFilter)
    {
        $builder->where('stores.name', 'like', '%' . ($requestFilter['name'] ?? '') . '%')
            ->where('stores.status', 'like', '%' . ($requestFilter['status'] ?? '') . '%');
    }

    // global scope
    protected static function booted(){
        static::addGlobalScope(new StoreScope);
    }
}
