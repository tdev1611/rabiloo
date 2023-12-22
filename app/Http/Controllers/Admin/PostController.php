<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\PostService;
use App\Services\Admin\CategoryService;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    protected $categoryService;
    protected $postService;
    function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postService->getAll();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data  = $request->validated();
        try {
            $data['user_id'] = 1;
            // handle uploadImg
            $request->hasFile('image') ? $data['image'] = $this->postService
                ->upLoadImg($request->file('image'), $request->slug) : null;
            // store
            $this->postService->store($data);

            return back()->with('success', 'Thêm Thành Công');
        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
