<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'rating',
        'location',
        'light_level',
        'water_frequency',
        'is_pet_friendly',
        'is_featured',
        'badge',
        'image',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($plant) {
            if (empty($plant->slug)) {
                $plant->slug = Str::slug($plant->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('images/' . $this->image))) {
            return asset('images/' . $this->image);
        }
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return asset('images/cart-1.png');
    }
}
