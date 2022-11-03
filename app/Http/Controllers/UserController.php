<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
	public function showAllUsers()
	{
		$users =  $this->getAllUsers()->original['users'];
		return view('users.index', compact('users'));
	}
	public function showCreateUser()
	{
		return view('users.create-user');
	}

	public function getAllUsers()
	{
		$users = User::get();
		return response()->json(['users' => $users], 200);
	}

	public function getAllUsersWithLends()
	{
		$users = User::with('CustomerLends.Book')->get();
		return response()->json(['users' => $users], 200);
	}

	public function getAllLendsByUser(User $user)
	{
		$customerLends = $user->load('CustomerLends.Book.Category', 'CustomerLends.Book.Author')->CustomerLends;
		return response()->json(['customer_lends' => $customerLends], 200);
	}

	public function getAnUser(User $user)
	{
		return response()->json(['user' => $user], 200);
	}

	public function createUser(CreateUserRequest $request)
	{
		$user = new User($request->all());
		$user->save();
		return response()->json(['user' => $user], 201);
	}

	public function updateUser(User $user, UpdateUserRequest $request)
	{
		$user->update($request->all());
		return response()->json(['user' => $user->refresh()], 201);
	}

	public function deleteUser(User $user)
	{
		$user->delete();
		return response()->json([], 204);
	}
}
