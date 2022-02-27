<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Meal extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    protected $hidden=[
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
        'category_id',
        'translations'
    ];

    protected $translatedAttributes = [
        'title',
        'description'
    ];

    protected $appends = [
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $perPage = 20;

    protected $fillable =[
        'slug',
        'status',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(
            Category::class
        )->select([
                'id',
                'slug'
            ]);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'meal_tags',
            'meal_id',
            'tag_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(
            Ingredient::class,
            'meal_ingredients',
            'meal_id',
            'ingredient_id'
        );
    }

    public function tagid()
    {
        return $this->hasMany(
            MealTag::class
        );
    }


    public function getStatusAttribute()
    {
        $request = request();

        $diff_time = $request->diff_time;


        if(!empty($diff_time) && is_numeric($diff_time)){

            if ($this->getAttributeValue('deleted_at') != null){

                return 'deleted';

            }elseif ($this->getAttributeValue('updated_at') > $this->getAttributeValue('created_at')){

                return 'modified';

            }else{

                return 'created';
            }
        }else{

            return 'created';
        }


    }


    public function scopeTrashedConditional($query, $runThis = true) {
        if ($runThis) {
            return $query->withTrashed();
        } else {
            return;
        }
    }
}
