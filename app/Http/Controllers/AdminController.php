<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


class AdminController extends Controller {


	public function convertTable (Request $request) {
		
	}


	public function panel () {
		return view('admin/panel');
	}
}
