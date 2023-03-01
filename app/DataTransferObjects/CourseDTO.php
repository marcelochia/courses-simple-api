<?php

namespace App\DataTransferObjects;

class CourseDTO implements CourseData
{
    public function __construct(
        public readonly string $number,
        public readonly string $name,
        public readonly string $category,
        public readonly string $prerequisite,
        public readonly string $teacher_name,
        public readonly string $duration
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['number'],
            $data['name'],
            $data['category'],
            $data['prerequisite'],
            $data['teacherName'],
            $data['duration'],
        );
    }

    public function toArray(): array
    {
        $array = [];
        foreach ($this as $key => $value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                $array[$key] = $value->toArray();
            } else {
                $array[$key] = $value;
            }
        }
        return $array;
    }
    
}
