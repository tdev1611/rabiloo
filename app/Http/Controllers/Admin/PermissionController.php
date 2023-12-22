<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\PermissionService;

use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    protected $permissionService;
    function __construct(PermissionService $permissionService)
    {
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
        $permissions  =  $this->permissionService->getAll();
        return  view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        try {
            $data = $request->validated();
            // store
            $this->permissionService->store($data);

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
        $permission =  $this->permissionService->getPermissionById($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, string $id)
    {
        $data =  $request->validated();
        try {
            $this->permissionService->update($id, $data);

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
            $this->permissionService->delete($id);
            return back()->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
