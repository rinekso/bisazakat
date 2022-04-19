<?php

namespace App\Http\Controllers\Admin;

use App\Models\Program;
use App\Models\ProgramProgress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Program $program)
    {
        $progressUpdates = ProgramProgress::where('program_id', $program->program_id)->get();

        return view('admin.programs.progress.show', compact('progressUpdates', 'program'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Program $program)
    {
        return view('admin.programs.progress.create', compact('program'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Program $program, Request $request)
    {
        $this->validate($request, ProgramProgress::rules(false));

        $data = array_merge($request->except('_token'), [
            'program_id' => $program->program_id
        ]);

        if (!$create = ProgramProgress::create($data)) {
            return redirect()->route(ADMIN . '.progress.index', $program->program_id)->with('errors', 'Create Gagal');
        }

        return redirect()->route(ADMIN . '.progress.index', $program->program_id)->withSuccess('Create Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program, ProgramProgress $programProgress)
    {
        return view('admin.programs.progress.edit', compact('program', 'programProgress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Program $program, ProgramProgress $programProgress, Request $request)
    {
        $this->validate($request, ProgramProgress::rules(false));

        if (!$update = $programProgress->update($request->all())) {
            return redirect()->route(ADMIN . '.progress.index', $program->program_id)->with('errors', 'Edit Gagal');
        }

        return redirect()->route(ADMIN . '.progress.index', $program->program_id)->withSuccess('Edit Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program, ProgramProgress $programProgress)
    {
        if (!$delete = $programProgress->delete()) {
            return redirect()->route(ADMIN . '.progress.index', $program->program_id)->with('errors', 'Delete Gagal');
        }

        return redirect()->route(ADMIN . '.progress.index', $program->program_id)->withSuccess('Delete Berhasil');
    }
}
