<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class UserController extends Controller
{
    // 2. GUNAKAN TRAIT DI DALAM CLASS (Tanpa tanda merah/error lagi)
    use ApiResponse;

    public function index()
    {
        try {
            $users = User::select(['id', 'name', 'email', 'role'])
            ->orderBy('id', 'asc')
            ->paginate(10);
            return $this->successResponse($users, 'Users fetched successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch users', $e->getMessage(), 500);
        }
    }

    public function show(int $id)
    {
        try {
            $user = User::select('id', 'name', 'email', 'role')->findOrFail($id);
            return $this->successResponse($user, 'User fetched successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to fetch user', $e->getMessage(), 500);
        }
    }
}
