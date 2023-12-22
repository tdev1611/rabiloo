<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\RoleService;
use App\Services\Admin\UserService;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $roleService;
    protected $user;
    function __construct(RoleService $roleService, UserService $user)
    {
        $this->roleService = $roleService;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user->getAll();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleService->getAll();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();
            // store
            $user = $this->user->store($data);
            // attach role
            $role = $request->input('role_id');
            $user->roles()->attach($role);

            $response = [
                'success' => true,
                'message' => 'Created Successfully'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->user->getUserById($id);
        $role_ids = $user->roles->pluck('id')->toArray();
        $roles = $this->roleService->getAll();

        return view('admin.users.edit', compact('user', 'roles', 'role_ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->validated();
        try {
            $user = $this->user->update($id, $data);

            $role = $request->input('role_id');
            $user->roles()->sync($role);

            $response = [
                'success' => true,
                'message' => 'Update Successfully'
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    function delete($id)
    {
        try {
            $this->user->delete($id);
            return back()->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
