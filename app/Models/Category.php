<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = [
        'title'
    ];

    protected $hidden=[
        'created_at',
        'updated_at',
        'deleted_at',
        'translations'
    ];

    protected $fillable=[
        'slug'
    ];

    public function meals()
    {
        return $this->hasMany(
            Meal::class
        );
    }
}
