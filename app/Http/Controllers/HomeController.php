<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        $mainProgram = Program::getMainProgram();

        if ($mainProgram == null) {
            $mainProgram = Program::first();
        }

        $latestProgram = Program::orderBy('created_at', 'DESC')
                            ->limit(6)
                            ->get();

        $transactionTotal = Transaction::where('status', Transaction::SUCCESS)->sum('amount');

        return view('frontend.mainpage', compact('mainProgram', 'latestProgram', 'users', 'transactionTotal'));
    }
}
