<?php

namespace App\Models\dashboard;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'price',
        'compare_price',
        'options',
        'rating',
        'featured',
        'status',
        'store_id',
        'category_id'

    ];
    protected $hidden = [
        'created_at','updated_at','deleted_at','image'

    ];

    protected $appends = ['image_url'];

    function category()
    {
        return $this->belongsTo(category::class);
    }

    function store()
    {
        return $this->belongsTo(Store::class);
    }


    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope);
        static::creating(function(Product $product){
            $product->slug = Str::slug($product->name);
        });
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://pharmastoreapp.com/content/images/thumbs/default-image_450.png';
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getSaleAttribute()
    {
        if ($this->compare_price) {
            return round(100 - (100 * $this->price / $this->compare_price), 1);
        }
    }


    public function scopeFilter(Builder $builder ,$filters)
    {
        $option = array_merge([
            'store_id'=>null,
            'category'=>null,
            'tags_id'=>[],
            'status'=>'active'

        ],$filters);

        $builder->when($option['store_id'],function($builder,$value)
        {
            $builder->where('store_id',$value);
        });

        $builder->when($option['category'], function ($builder, $value) {
            $builder->where('category', $value);
        });

        $builder->when($option['tags_id'], function ($builder, $value) {
            $builder->whersRaw('Exists (SELECT 1 FROM product_tag WHERE tag_id = ? AND product_id=products.id)',[$value]);
        });

        $builder->when($option['status'], function ($query, $status) {
            return $query->where('status', $status);
        });

    }
}
