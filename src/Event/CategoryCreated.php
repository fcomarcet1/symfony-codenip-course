<?php

declare(strict_types=1);

namespace App\Event;

class CategoryCreated
{
    public function __construct(
        public  string $id,
        public  string $name,
        public  string $createdAt,
    )
    {
    }
}