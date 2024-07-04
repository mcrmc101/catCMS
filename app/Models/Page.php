<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        HasSEO;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'published'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function category()
    {
        return $this->belongsTo(PageCategory::class, 'page_category_id');
    }

    public function buildSlug()
    {
        $str = '';
        if ($this->category) {
            $str = $str . $this->category->slug . '/';
        }
        $str = $str . $this->slug;
        return $str;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
        $this->addMediaCollection('downloads');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
