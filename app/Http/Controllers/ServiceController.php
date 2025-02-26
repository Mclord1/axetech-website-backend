<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;

class ServiceController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Service::query();

        if ($request->has('visible')) {
            $query->where('is_visible', $request->boolean('visible'));
        }

        $services = $query->orderBy('order')
            ->paginate($request->input('per_page', 10));

        return $this->successResponse($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request): JsonResponse
    {
        $service = Service::create($request->validated());

        return $this->successResponse(
            $service,
            'Service created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service): JsonResponse
    {
        return $this->successResponse($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service): JsonResponse
    {
        $service->update($request->validated());

        return $this->successResponse(
            $service,
            'Service updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service): JsonResponse
    {
        // Clean up any associated files if needed
        if ($service->icon) {
            Storage::delete($service->icon);
        }
        if ($service->image) {
            Storage::delete($service->image);
        }

        $service->delete();

        return $this->successResponse(
            null,
            'Service deleted successfully'
        );
    }

    public function updateOrder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'services' => 'required|array',
            'services.*.id' => 'required|exists:services,id',
            'services.*.order' => 'required|integer|min:0',
        ]);

        foreach ($validated['services'] as $item) {
            Service::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return $this->successResponse(
            null,
            'Service order updated successfully'
        );
    }
}
