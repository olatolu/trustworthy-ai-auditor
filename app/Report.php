<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    //

    use SoftDeletes;

    public $table = 'reports';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
        'category_id',
        'sections_descriptions',
        'section_id',
        'questions_descriptions',
        'demo_description',
        'question_id',
        'is_for',
    ];

    protected $casts = [ 'sections_descriptions', 'questions_descriptions' ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getSectionsDescriptionsAttribute($value)
    {
        return json_decode($value);
    }

//    public function setSectionsDescriptionsAttribute($value)
//    {
//        $this->attributes['sections_descriptions'] = json_encode($value);
//    }
}
