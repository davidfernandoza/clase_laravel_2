<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

	public function showBooks()
	{
		return view('books.index');
	}

	public function showHomeWithBooks()
	{
		$books = $this->getAllBooks()->original['books'];
		return view('index', compact('books'));
	}

	public function getAllBooks()
	{
		$books = Book::with('Author')->get();
		return response()->json(['books' => $books], 200);
	}

	public function saveBook(Request $request)
	{
		$book = new Book($request->all());
		$book->save();
		return response()->json(['book' => $book], 200);
	}
}
