<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;

class ProjectController extends Controller
{
    use ApiResponse;

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $perPage = $perPage > 100 ? 100 : $perPage;

        $projects = Project::paginate($perPage);

        return $this->successResponse(
            $projects,
            'Projects retrieved successfully'
        );
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = Project::create($request->validated());
        return $this->successResponse($project, 'Project created successfully', 201);
    }

    public function show(Project $project): JsonResponse
    {
        return $this->successResponse($project, 'Project retrieved successfully');
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $project->update($request->validated());
        return $this->successResponse($project, 'Project updated successfully');
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();
        return $this->successResponse(null, 'Project deleted successfully', 200);
    }
}
