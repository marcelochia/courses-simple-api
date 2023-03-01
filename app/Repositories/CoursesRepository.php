<?php

namespace App\Repositories;

use App\DataTransferObjects\CourseData;
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
    
    public function create(CourseData $data): Course
    {
        return Course::create($data->toArray());
    }

    public function update(Course $course, CourseData $data): bool
    {
        return $course->update($data->toArray());
    }

    public function delete(Course $course): bool
    {
        return $course->delete();
    }
}
