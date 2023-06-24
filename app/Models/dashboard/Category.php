<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','parent_id','description','image','status','slug'
    ];

    public function products(){
        return $this->hasMany(Product::class);
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
    
}
