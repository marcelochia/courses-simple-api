<?php

namespace App\Services;

use App\Repositories\CoursesRepository;
use Illuminate\Support\Collection;

class CreateCourseService
{
    public function __construct(private CoursesRepository $repository) {}

    public function execute(): Collection
    {
        return $this->repository->all();
    }
}
