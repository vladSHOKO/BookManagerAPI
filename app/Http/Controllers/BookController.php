<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Routing\Controller;
use \Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BookController extends Controller
{
    public function getCollection(): JsonResponse
    {
        $books = Book::with('user')->get();

        return response()->json($books);
    }

    public function getBookById(int $id): JsonResponse
    {
        $book = Book::with('user')->find($id);
        abort_unless(isset($book), 404, 'Book not found');

        return response()->json(['status' => 'success', 'book_data' => $book]);
    }

    public function createBook(BookRequest $request): JsonResponse
    {
        $data = $request->validated();
        $book = new Book();
        $book->fill($data);
        abort_unless($book->save(), 400, 'Book not created');

        return response()->json(['status' => 'success', 'book_data' => $book]);
    }

    public function updateBook(BookRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $book = Book::with('user')->find($id);
        abort_unless(isset($book), 404, 'Book not found');

        return response()->json(['status' => 'success', 'book_data' => $book]);
    }

    public function deleteBook(int $id): JsonResponse
    {
        $book = Book::with('user')->find($id);
        abort_unless(isset($book), 404, 'Book not found');
        $book->delete();

        return response()->json(['status' => 'success']);
    }
}
