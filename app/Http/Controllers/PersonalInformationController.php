<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\UserTrait;

class PersonalInformationController extends Controller
{
	use UserTrait;

	public function showAllPersonalInformations()
	{
		$this->buildUserObject();
	}
}
