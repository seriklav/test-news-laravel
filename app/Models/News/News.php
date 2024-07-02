<?php

namespace App\Models\News;

use App\Enums\NewsStatusEnum;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Astrotomic\Translatable\Translatable;

/**
 * @property int $id
 * @property string $url
 * @property NewsStatusEnum $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read string $title
 * @property-read string $short_description
 * @property-read string $full_description
 *
 * @mixin Builder
 */
class News extends Model
{
    use Translatable;
    use HasFactory;

    protected $fillable = [
        'url',
        'status',
    ];

    public array $translatedAttributes = [
        'title',
        'short_description',
        'full_description',
    ];

    protected $casts = [
        'status' => NewsStatusEnum::class,
    ];

    public function toArray(): array
    {
        return array_merge(
            parent::toArray(),
            [
                'title'             => $this->title,
                'short_description' => $this->short_description,
                'full_description'  => $this->full_description,
            ]
        );
    }
}
