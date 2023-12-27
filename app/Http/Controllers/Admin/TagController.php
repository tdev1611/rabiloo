<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\TagService;

use App\Http\Requests\TagRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TagController extends Controller
{

    protected $tag;
    function __construct(TagService $tag)
    {
        $this->tag = $tag;
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
        $permissions = $this->tag->getAll();
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        try {
            $data = $request->validated();
            // store
            $this->tag->store($data);

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
        try {
            $tag = $this->tag->getTagById($id);
            return view('admin.tags.edit', compact('tag'));
        } catch (ModelNotFoundException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, string $id)
    {
        $data =  $request->validated();
        try {
            $this->tag->update($id, $data);

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
            $this->tag->delete($id);
            return back()->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
