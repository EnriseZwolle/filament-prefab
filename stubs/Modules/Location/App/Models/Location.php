<?php

namespace App\Models;

use App\Contracts\IsSearchable;
use App\Contracts\Menuable;
use App\Traits\HasVisibility;
use App\Traits\Searchable;
use App\Traits\Seoable;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model implements IsSearchable, Menuable
{
    use HasFactory;
    use HasVisibility;
    use Seoable;
    use Searchable;

    protected $guarded = [];

    protected $casts = [
        'visible' => 'bool',
        'content' => 'array',
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function getMenuOptions(): array
    {
        return self::query()->pluck('name', 'id')->toArray();
    }

    public function getRoute(): string
    {
        return route('location.show', ['location' => $this]);
    }

    public static function getResourceName(): string
    {
        return __('Location');
    }
}
