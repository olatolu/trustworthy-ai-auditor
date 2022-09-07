<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }

    use SoftDeletes;

    public $table = 'categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'sections',
        'sections_labels',
        'sections_headings',
        'description',
        'start_at',
        'end_at',
        'is_active',
        'test_duration',
        'style',
        'radar_chart',
        'bar_chart',
        'bar_chart_section',
        'short_description',
        'bar_chart_label',
        'is_demo',
        'radar_report_header',
        'radar_report_footer',
        'bar_report_header',
        'bar_report_footer',
        'created_at',
        'updated_at',
        'deleted_at',
        'c_room',
        'column_report',
    ];

    protected $casts = [ 'sections_labels', 'sections_headings' ];

    public function categoryQuestions()
    {
        return $this->hasMany(Question::class, 'category_id', 'id');
    }

    public function categoryResults()
    {
        return $this->hasMany(Result::class, 'category_id', 'id');
    }

    public function categoryReports()
    {
        return $this->hasMany(Report::class, 'category_id', 'id');
    }

    public function getSectionsLabelsAttribute($value)
    {
        return json_decode($value);
    }

    public function setSectionsLabelsAttribute($value)
    {
        $this->attributes['sections_labels'] = json_encode($value);
    }

    public function getSectionsHeadingsAttribute($value)
    {
        return json_decode($value);
    }

    public function setSectionsHeadingsAttribute($value)
    {
        $this->attributes['sections_headings'] = json_encode($value);
    }
}
