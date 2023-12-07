<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class BookController extends Controller
{
    protected $database;
    protected $dbname = 'books';

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index()
{
    $reference = $this->database->getReference($this->dbname);
    $books = $reference->getValue();

    // Check if $books is null and set it to an empty array if it is
    if (is_null($books)) {
        $books = [];
    }

    // Initialize the counter
    $i = 0;

    return view('book.index', compact('books', 'i'));
}


public function create()
{
    // Pass an empty array or a new Book object to the view
    $book = new \stdClass();
    $book->title = '';
    $book->author = '';

    return view('book.create', compact('book'));
}


    public function store(Request $request)
    {
        request()->validate(Book::$rules);

        $postData = $request->all();
        $postRef = $this->database->getReference($this->dbname)->push($postData);

        if ($postRef) {
            return redirect()->route('books.index')
                ->with('success', 'Book created successfully.');
        } else {
            return back()->with('error', 'Error creating book.');
        }
    }

    public function show($id)
    {
        $reference = $this->database->getReference($this->dbname.'/'.$id);
        $book = $reference->getValue();

        return view('book.show', compact('book'));
    }

    public function edit($id)
    {
        $reference = $this->database->getReference($this->dbname.'/'.$id);
        $book = $reference->getValue();
        $book['id'] = $id;

        return view('book.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        request()->validate(Book::$rules);

        $updateData = $request->all();
        $reference = $this->database->getReference($this->dbname.'/'.$id);
        $result = $reference->update($updateData);

        if ($result) {
            return redirect()->route('books.index')
                ->with('success', 'Book updated successfully');
        } else {
            return back()->with('error', 'Error updating book.');
        }
    }

    public function destroy($id)
    {
        $reference = $this->database->getReference($this->dbname.'/'.$id);
        $result = $reference->remove();

        if ($result) {
            return redirect()->route('books.index')
                ->with('success', 'Book deleted successfully');
        } else {
            return back()->with('error', 'Error deleting book.');
        }
    }
}
