<?php

namespace App\Http\Controllers;

use App\Models\ProofOfPayment;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('can:update,profile')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('frontend.member', compact('user'));
    }

    /**
     * Show the form for editing the user profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('frontend.memberEdit', compact('user'));
    }

    /**
     * Show the form for editing the user password.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword(User $user)
    {
        return view('frontend.memberPasswordChange', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->except('_token', '_method', 'page'));
        if ($request->post('page') === 'user.profile') {
            return redirect()->route('profile.edit', $user->user_id);
        } else {
            return redirect()->route('profile.edit.password', $user->user_id);
        }
    }


    /**
     * Update the user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('profile.edit.password', $user->user_id)->with('warning', 'Password tidak cocok');
        }

        $user->password = $request->password;
        $user->save();

        return redirect()->route('profile.edit.password', $user->user_id)->with('success', 'Password berhasil diganti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Get user transaction history
     */
    public function getTransactionHistory(User $user)
    {
        return view('frontend.historitransaksi', compact('user'));
    }

    /**
     * Upload proof of payment/ proof of transfer
     */

    public function doUploadProofOfPayment(User $user, Transaction $transaction, Request $request)
    {
        $image = $request->file('bukti');
        $imageName = time()."-".$transaction->transaction_uuid.".".$image->getClientOriginalExtension();

        $proofOfPayment = ProofOfPayment::create(['image' => $image->storeAs('images', $imageName)]);

        $transaction->proof_of_payment_id = $proofOfPayment->proof_of_payment_id;
        $transaction->save();

        return redirect()->route('user.transaction.history', $user->user_id);
    }
}
