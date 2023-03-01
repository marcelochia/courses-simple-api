<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\CourseDTO;
use App\Http\Requests\CourseFormRequest;
use App\Http\Resources\CourseResource;
use App\Repositories\CoursesRepository;
use Error;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PDOException;

class CourseController extends Controller
{
    public function __construct(private CoursesRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $courses = $this->repository->all();
    
            return response()->json([
                'data' => CourseResource::collection($courses)
            ]);
        } catch (PDOException $e) {
            Log::critical("The database is down: {$e->getMessage()}");
            return response()->json(
                [
                    'error' => [
                        'message' => 'Something is wrong now. Try again in a few moments.'
                    ]
                ],
                Response::HTTP_BAD_GATEWAY
            );
        } catch (Exception|Error $e) {
            Log::error("Something is wrong: {$e->getMessage()}");
            return response()->json(
                [
                    'error' => [
                        'message' => 'Something is wrong now. Try again in a few moments.'
                    ]
                ],
                Response::HTTP_BAD_GATEWAY
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseFormRequest $request): JsonResponse
    {
        try {
            $data = CourseDTO::fromArray($request->validated());
            $course = $this->repository->create($data);
    
            return response()->json(['data' => new CourseResource($course)], Response::HTTP_CREATED);
        } catch (PDOException $e) {
            Log::critical("The database is down: {$e->getMessage()}");
            return response()->json(
                [
                    'error' => [
                        'message' => 'Something is wrong now. Try again in a few moments.'
                    ]
                ],
                Response::HTTP_BAD_GATEWAY
            );
        } catch (Exception|Error $e) {
            Log::error("Something is wrong: {$e->getMessage()}");
            return response()->json(
                [
                    'error' => [
                        'message' => 'Something is wrong now. Try again in a few moments.'
                    ]
                ],
                Response::HTTP_BAD_GATEWAY
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $course = $this->repository->findById($id);
    
            if (is_null($course)) {
                return response()->json(
                    ['message' => 'Course not found.'],
                    Response::HTTP_NOT_FOUND
                );
            }
    
            return response()->json([
                'data' => new CourseResource($course)
            ]);
        } catch (PDOException $e) {
            Log::critical("The database is down: {$e->getMessage()}");
            return response()->json(
                [
                    'error' => [
                        'message' => 'Something is wrong now. Try again in a few moments.'
                    ]
                ],
                Response::HTTP_BAD_GATEWAY
            );
        } catch (Exception|Error $e) {
            Log::error("Something is wrong: {$e->getMessage()}");
            return response()->json(
                [
                    'error' => [
                        'message' => 'Something is wrong now. Try again in a few moments.'
                    ]
                ],
                Response::HTTP_BAD_GATEWAY
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseFormRequest $request, string $id): JsonResponse
    {
        try { 
            $course = $this->repository->findById($id);
            
            if (is_null($course)) {
                return response()->json(
                    ['message' => 'Course not found.'],
                    Response::HTTP_NOT_FOUND
                );
            }
            
            $data = CourseDTO::fromArray($request->validated());
            $this->repository->update($course, $data);
    
            return response()->json(['data' => new CourseResource($course)]);
        } catch (PDOException $e) {
            Log::critical("The database is down: {$e->getMessage()}");
            return response()->json(
                [
                    'error' => [
                        'message' => 'Something is wrong now. Try again in a few moments.'
                    ]
                ],
                Response::HTTP_BAD_GATEWAY
            );
        } catch (Exception|Error $e) {
            Log::error("Something is wrong: {$e->getMessage()}");
            return response()->json(
                [
                    'error' => [
                        'message' => 'Something is wrong now. Try again in a few moments.'
                    ]
                ],
                Response::HTTP_BAD_GATEWAY
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $course = $this->repository->findById($id);

            if (is_null($course)) {
                return response()->json(
                    ['message' => 'Course not found.'],
                    Response::HTTP_NOT_FOUND
                );
            }

            $this->repository->delete($course);

            return response()->json();
        } catch (PDOException $e) {
            Log::critical("The database is down: {$e->getMessage()}");
            return response()->json(
                [
                    'error' => [
                        'message' => 'Something is wrong now. Try again in a few moments.'
                    ]
                ],
                Response::HTTP_BAD_GATEWAY
            );
        } catch (Exception|Error $e) {
            Log::error("Something is wrong: {$e->getMessage()}");
            return response()->json(
                [
                    'error' => [
                        'message' => 'Something is wrong now. Try again in a few moments.'
                    ]
                ],
                Response::HTTP_BAD_GATEWAY
            );
        }
    }
}
