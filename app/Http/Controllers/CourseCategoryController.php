<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    // Get api/categories
    public function index()
    {
        $categories = CourseCategory::all();

        return response()->json([
            'success' => true,
            'message' => 'Data kategori berhasil diambil',
            'data' => $categories,
        ], 200);
    }

    // Get api/categories/{id}
    public function show(int $id)
    {
        $category = CourseCategory::with(['courses.instructor:id,name'])->find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail kategori berhasil diambil',
            'data' => $category,
        ], 200);
    }

    // Post api/categories
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'        => 'required|string|max:100|unique:course_categories,name',
                'description' => 'nullable|string',
                'icon'        => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $e->errors(),
            ], 422);
        }

        $category = CourseCategory::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan',
            'data'    => $category,
        ], 201);
    }

    // Put api/categories/{id}
    public function update(Request $request, int $id)
    {
        $category = CourseCategory::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'name'        => 'required|string|max:100|unique:course_categories,name,' . $id,
                'description' => 'nullable|string',
                'icon'        => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $e->errors(),
            ], 422);
        }

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil di update',
            'data'    => $category,
        ], 200);
    }

    // Delete api/categories/{id}
    public function destroy(int $id)
    {
        $category = CourseCategory::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        if ($category->courses()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak dapat dihapus karena masih memiliki kursus terkait',
            ], 409);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus',
            'data' => null,
        ], 200);
    }
}
