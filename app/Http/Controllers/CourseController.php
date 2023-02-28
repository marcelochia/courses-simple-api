<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseFormRequest;
use App\Repositories\CoursesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    public function __construct(private CoursesRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $courses = $this->repository->all();

        return response()->json([
            'content' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseFormRequest $request): JsonResponse
    {
        $data = $request->validated();
        $course = $this->repository->create($data);

        return response()->json($course, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $course = $this->repository->findById($id);

        if (is_null($course)) {
            return response()->json(
                ['message' => 'Course not found.'],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json([
            'content' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $course = $this->repository->findById($id);

        if (is_null($course)) {
            return response()->json(
                ['message' => 'Course not found.'],
                Response::HTTP_NOT_FOUND
            );
        }

        $data = $request->all();
        $data['teacher_name'] = $request->teacherName;
        $this->repository->update($course, $data);
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $course = $this->repository->findById($id);

        if (is_null($course)) {
            return response()->json(
                ['message' => 'Course not found.'],
                Response::HTTP_NOT_FOUND
            );
        }

        $this->repository->delete($course);

        return response()->json();
    }
}
