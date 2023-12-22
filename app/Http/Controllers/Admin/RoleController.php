<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\RoleService;
use App\Services\Admin\PermissionService;
use App\Http\Requests\RoleRequest;


class RoleController extends Controller
{
    protected $roleService;
    protected $permissionService;
    function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles  =  $this->roleService->getAll();
        $permissions  =  $this->permissionService->getAll();
        return  view('admin.roles.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        try {
            $data = $request->validated();
            // store
            $role =  $this->roleService->store($data);
            $response = [
                'success' => true,
                'message' => 'Created Successfully'
            ];
            $permission = $request->input('permission_id');
            $role->permissions()->attach($permission);
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
        $role =  $this->roleService->getRoleById($id);
        $permission_ids = $role->permissions->pluck('id')->toArray();
        $permissions  =  $this->permissionService->getAll();

        return view('admin.roles.edit', compact('role', 'permissions','permission_ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $data =  $request->validated();
        try {
            $this->roleService->update($id, $data);

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
            $this->roleService->delete($id);
            return back()->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
