<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Program::whereNotIn('program_id', [1,2,3])->get();

        return view('admin.programs.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::get()->mapWithKeys(function ($item) {
            return [$item['category_id'] => $item['name']];
        });


        return view('admin.programs.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Program::rules(false));

        $data = [];
        $data['slug'] = str_slug($request->post('title'));

        $data = array_merge($request->except('_token, _method'), $data);

        if (!$program = Program::create($data)) {
            return redirect()->route(ADMIN . '.programs.index')->with('errors', 'Create Gagal');
        }

        $image = $request->file('image');
        $imageName = time().str_slug($program->title).$program->id.".".$image->getClientOriginalExtension();

        $program->image = $image->storeAs('images', $imageName);
        $program->save();

        return redirect()->route(ADMIN . '.programs.index')->withSuccess('Create Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        $transactions = $program->transactions;

        return view('admin.programs.show', compact('program', 'transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        $category = Category::get()->mapWithKeys(function ($item) {
            return [$item['category_id'] => $item['name']];
        });

        $item = $program;

        return view('admin.programs.edit', compact('item', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $this->validate($request, Program::rules(true, $program->category_id));

        $program->update($request->all());

        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = time().str_slug($program->title).$program->id.".".$image->getClientOriginalExtension();

            Storage::delete($program->image);

            $program->image = $image->storeAs('images', $imageName);;
            $program->save();
        }

        return redirect()->route(ADMIN . '.programs.edit', $program->program_id)->withSuccess('Update Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        try {
            $program->delete();
            // Storage::delete($program->image);
        } catch (QueryException $e) {
            return redirect()->route(ADMIN . '.programs.index')->with('warning', 'Delete Gagal');
        }
        return redirect()->route(ADMIN . '.programs.index')->withSuccess('Delete Berhasil');
    }
}
