<?php

namespace App\Http\Controllers;

use Alert;
use App\Admin;
use Illuminate\Http\Request;

class PageController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the admin login page
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getAdminLogin(){
		return view('auth.admin.login');
	}

	/**
	 * Authenticate the admin
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function authAdmin(Request $request){
		// Validate the request
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required|min:6'
		]);

		if(!auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){

			alert()->error('Sorry. These credentials don\'t match our records', 'Wrong Credentials')->persistent('Got It');

			return redirect()->back()->withInput()->with('error', 'Login Failed');
		}

		return redirect()->route('admin.home');
	}
}
