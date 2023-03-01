<?php

namespace App\DataTransferObjects;

interface CourseData
{
    public static function fromArray(array $data): self;
    public function toArray(): array;
}
