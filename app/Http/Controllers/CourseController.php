<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use App\Http\Requests\GetCourseRequest;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{

    // Get api/courses
    public function index(GetCourseRequest $request)
    {

        $courses = Course::with(['category:id,name', 'instructor:id,name'])

            //Search by judul
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })

            // Filter by category_id
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })

            // Filter by level
            ->when($request->filled('level'), function ($query) use ($request) {
                $query->where('level', $request->level);
            })

            // Sorting
            ->orderBy(
                $request->input('sort_by', 'created_at'),
                $request->input('order', 'asc')
            )->paginate($request->input('per_page', 6));

        // Cek apakah hasil pencarian/filter kosong
        if ($courses->isEmpty()) {
            return response()->json([
                'success' => false,
                'message'  => 'Kursus tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message'  => 'Data kursus berhasil diambil',
            'data'    => $courses
        ], 200);
    }

    // Get api/courses/{id}
    public function show(int $id)
    {
        $course = Course::with(['category:id,name', 'instructor:id,name'])->find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail kursus berhasil diambil',
            'data' => $course,
        ], 200);
    }

    public function store(StoreCourseRequest $request)
    {

        $validated = $request->validated();

        $validated['instructor_id'] = $request->user()->id;
        $validated['enrolled_count'] = 0;

        $course = Course::create($validated);
        $course->load(['category:id,name', 'instructor:id,name']);

        return response()->json([
            'success' => true,
            'message' => 'Kursus berhasil ditambahkan',
            'data' => $course,
        ], 201);
    }

    // Put  api/courses/{id}
    public function update(Request $request, int $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $user = $request->user();

        if ($user->role !== 'instructor' || $course->instructor_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk mengubah data ini'
            ], 403);
        }

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'rating'       => 'required|numeric|min:0|max:10',
            'category_id'  => 'required|exists:course_categories,id',
            'level'        => 'required|in:beginner,intermediate,advanced',
            'duration'     => 'required|integer|min:1',
            'thumbnail'    => 'nullable|string',
            'status'       => 'required|in:draft,published',
        ]);

        $course->update($validated);
        $course->load(['category:id,name', 'instructor:id,name']);

        return response()->json([
            'success' => true,
            'message' => 'Kursus berhasil di update',
            'data' => $course,
        ], 200);
    }

    // DELETE /api/courses/{id}
    public function destroy(Request $request, int $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $user = $request->user();

        if ($user->role !== 'instructor' || $course->instructor_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk mengubah data ini',
            ], 403);
        }

        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kursus berhasil dihapus',
            'data' => null,
        ], 200);
    }
}
