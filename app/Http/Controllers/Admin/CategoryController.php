<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\CoA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Category::with('coa')->get();

        return view('admin.category.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coa = CoA::get()->mapWithKeys(function ($item) {
            return [$item['coa_number'] => $item['title']];
        });


        return view('admin.category.create', compact('coa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Category::rules(false));

        if (!Category::create($request->all())) {
            return redirect()->route(ADMIN . '.categories.index')->with('errors', 'Create Gagal');
        }

        return redirect()->route(ADMIN . '.categories.index')->withSuccess('Create Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $item = $category;
        $coa = CoA::get()->mapWithKeys(function ($item) {
            return [$item['coa_number'] => $item['coa_number']];
        });

        return view('admin.category.edit', compact('item', 'coa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, Category::rules(true, $category->category_id));

        $category->update($request->all());

        return redirect()->route(ADMIN . '.coa.index')->withSuccess('Update Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
        } catch (QueryException $e) {
            return redirect()->route(ADMIN . '.categories.index')->with('warning', 'Delete Gagal');
        }
        return redirect()->route(ADMIN . '.categories.index')->withSuccess('Delete Berhasil');
    }
}
