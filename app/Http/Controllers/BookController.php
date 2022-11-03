<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
	public function showHomeWithBooks()
	{
		$books = $this->getAllBooks()->original['books'];
		return view('index', compact('books'));
	}

	public function getAllBooks()
	{
		$books = Book::get();
		return response()->json(['books' => $books], 200);
	}
}
