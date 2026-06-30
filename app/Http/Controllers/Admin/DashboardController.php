<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller {
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$products = Product::count();
		$users = User::count();

		return view('admin.dashboard', compact('products', 'users'));
	}

	public function stock() {
		return view('admin.stock.index');
	}
}
