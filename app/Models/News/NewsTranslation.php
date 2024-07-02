<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $news_id
 * @property string $locale
 * @property string $title
 * @property string|null $short_description
 * @property string|null $full_description
 */
class NewsTranslation extends Model
{
    public $timestamps = false;

    public $fillable = [
        'locale',
        'title',
        'short_description',
        'full_description',
    ];

}
