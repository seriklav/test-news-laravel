<?php

namespace App\Dtos\News;

use Spatie\LaravelData\Data;

class NewsData extends Data
{
    public function __construct(
        public ?array $title,
        public ?string $url,
        public ?array $short_description,
        public ?array $full_description,
        public ?string $status
    ) {
    }
}
