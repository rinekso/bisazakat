<?php

namespace App\Http\Controllers\Admin;

class DashboardController extends \App\Http\Controllers\Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }
}
