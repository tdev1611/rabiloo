<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\CategoryService;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $category;
    function __construct(CategoryService $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->category->getAll();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            // store
            $this->category->store($data);

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
        $category = $this->category->categoryById($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $data = $request->validated();
        try {
            $this->category->update($id, $data);

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
            $this->category->delete($id);
            return back()->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    function restore($id)
    {
        try {
            $this->category->restore($id);
            return redirect()->back()->with('success', 'Restored  Success ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function forceDelete($id)
    {
        try {
            $this->category->forceDelete($id);
            return redirect()->back()->with('success', 'forceDeleted  Success ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}
