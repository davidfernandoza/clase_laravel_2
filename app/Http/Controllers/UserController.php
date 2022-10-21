<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\UserTrait;

class UserController extends Controller
{
	use UserTrait;

	public function getAnUser()
	{
		// code...
	}

	public function showAllUsers()
	{
		$this->buildUserObject();
	}
}
