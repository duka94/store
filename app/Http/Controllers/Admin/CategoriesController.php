<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::with([
            'createdBy',
            'updatedBy',
        ])->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CategoryRequest;
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->only(['name']));

        return redirect()->route('categories.index')->with([
            'title' => 'Created!',
            'type' => 'success',
            'status' => 'Category created!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        $category->with([
            'createdBy',
            'updatedBy',
        ]);

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $category->with([
            'createdBy',
            'updatedBy',
        ]);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Requests\CategoryRequest;
     * @param  Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->only(['name']));

        return redirect()->route('categories.index')->with([
            'title' => 'Updated!',
            'type' => 'success',
            'status' => "Category {$category->name} updated!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {

        DB::beginTransaction();
        try {
            $category->delete();
            $category->products()->delete();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            $exception->getMessage();
        }

        return redirect()->route('categories.index')->with([
            'title' => 'Deleted!',
            'type' => 'success',
            'status' => "Category {$category->name} deleted!"
        ]);
    }
}
