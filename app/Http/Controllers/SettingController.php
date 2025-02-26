<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Setting\StoreSettingRequest;
use App\Http\Requests\Setting\UpdateSettingRequest;

class SettingController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Setting::query();

        if ($request->has('group')) {
            $query->where('group', $request->input('group'));
        }

        if ($request->has('public')) {
            $query->where('is_public', $request->boolean('public'));
        }

        $settings = $query->paginate($request->input('per_page', 10));

        return $this->successResponse($settings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request): JsonResponse
    {
        $setting = Setting::create($request->validated());

        return $this->successResponse(
            $setting,
            'Setting created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting): JsonResponse
    {
        return $this->successResponse($setting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting): JsonResponse
    {
        $setting->update($request->validated());

        return $this->successResponse(
            $setting,
            'Setting updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting): JsonResponse
    {
        $setting->delete();

        return $this->successResponse(
            null,
            'Setting deleted successfully'
        );
    }

    /**
     * Get settings by group
     */
    public function getByGroup(string $group): JsonResponse
    {
        $settings = Setting::where('group', $group)->get();

        return $this->successResponse($settings);
    }

    /**
     * Get all public settings
     */
    public function getPublic(): JsonResponse
    {
        $settings = Setting::where('is_public', true)->get();

        return $this->successResponse($settings);
    }

    /**
     * Bulk update settings
     */
    public function bulkUpdate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string|exists:settings,key',
            'settings.*.value' => 'required|string',
        ]);

        foreach ($validated['settings'] as $item) {
            Setting::where('key', $item['key'])->update(['value' => $item['value']]);
        }

        return $this->successResponse(
            null,
            'Settings updated successfully'
        );
    }
}
