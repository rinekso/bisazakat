<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoA;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Expr\BinaryOp\Coalesce;

class CoAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = CoA::get();

        return view('admin.coa.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, CoA::rules(false));

        if (!CoA::create($request->all())) {
            return redirect()->route(ADMIN . '.coa.index')->with('errors', 'Create Gagal');
        }

        return redirect()->route(ADMIN . '.coa.index')->withSuccess('Create Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CoA  $coA
     * @return \Illuminate\Http\Response
     */
    public function show(CoA $coA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CoA  $coA
     * @return \Illuminate\Http\Response
     */
    public function edit(CoA $coA)
    {
        $item = $coA;

        return view('admin.coa.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CoA  $coA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoA $coA)
    {
        $this->validate($request, CoA::rules(true, $coA->coa_number));

        $coA->update($request->all());

        return redirect()->route(ADMIN . '.coa.index')->withSuccess('Update Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CoA  $coA
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoA $coA)
    {
        try {
            $coA->delete();
        } catch (QueryException $e) {
            return redirect()->route(ADMIN . '.coa.index')->with('warning', 'Delete Gagal');
        }
        return redirect()->route(ADMIN . '.coa.index')->withSuccess('Delete Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CoA  $coA
     * @return \Illuminate\Http\Response
     */
    public function updateActivationStatus(Request $request, CoA $coA)
    {
        //return  $request->post('is_active');
        CoA::where('coa_number', $coA->coa_number)->update([
            'is_active' => $request->post('is_active')
        ]);

        return redirect()->route(ADMIN . '.coa.edit', $coA->coa_number)->withSuccess('Update Berhasil');
    }
}
