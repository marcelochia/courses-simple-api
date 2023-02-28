<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Collection;

class CoursesRepository
{
    public function all(): Collection
    {
        return Course::all();
    }

    public function findById(int $id): ?Course
    {
        return Course::find($id);
    }
    
    public function create(array $data): Course
    {
        return Course::create($data);
    }

    public function update(Course $course, array $data): bool
    {
        return $course->update($data);
    }

    public function delete(Course $course): bool
    {
        return $course->delete();
    }
}
