<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use SoftDeletes;

    public $table = 'results';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'profile_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'total_points',
        'category_id',
        'is_report',
        'pdf',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withPivot(['option_id', 'points']);
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
