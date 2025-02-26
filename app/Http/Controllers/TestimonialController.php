<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Testimonial\StoreTestimonialRequest;
use App\Http\Requests\Testimonial\UpdateTestimonialRequest;

class TestimonialController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of testimonials.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Testimonial::query();

        if ($request->has('visible')) {
            $query->where('is_visible', $request->boolean('visible'));
        }

        if ($request->has('rating')) {
            $query->where('rating', $request->integer('rating'));
        }

        $testimonials = $query->ordered()
            ->paginate($request->input('per_page', 10));

        return $this->successResponse($testimonials);
    }

    /**
     * Store a newly created testimonial.
     */
    public function store(StoreTestimonialRequest $request): JsonResponse
    {
        $testimonial = Testimonial::create($request->validated());

        return $this->successResponse(
            $testimonial,
            'Testimonial created successfully',
            201
        );
    }

    /**
     * Display the specified testimonial.
     */
    public function show(Testimonial $testimonial): JsonResponse
    {
        return $this->successResponse($testimonial);
    }

    /**
     * Update the specified testimonial.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): JsonResponse
    {
        $testimonial->update($request->validated());

        return $this->successResponse(
            $testimonial,
            'Testimonial updated successfully'
        );
    }

    /**
     * Remove the specified testimonial.
     */
    public function destroy(Testimonial $testimonial): JsonResponse
    {
        $testimonial->delete();

        return $this->successResponse(
            null,
            'Testimonial deleted successfully'
        );
    }

    /**
     * Update the order of multiple testimonials.
     */
    public function updateOrder(Request $request): JsonResponse
    {
        $request->validate([
            'testimonials' => 'required|array',
            'testimonials.*.id' => 'required|exists:testimonials,id',
            'testimonials.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->testimonials as $item) {
            Testimonial::where('id', $item['id'])
                ->update(['order' => $item['order']]);
        }

        return $this->successResponse(
            null,
            'Testimonial order updated successfully'
        );
    }
}