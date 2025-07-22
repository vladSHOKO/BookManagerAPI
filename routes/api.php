<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BookController;

Route::get('/books', [BookController::class, 'getCollection']);
Route::get('/books/{id}', [BookController::class, 'getBookById']);
Route::post('/books', [BookController::class, 'createBook']);
Route::patch('/books/{id}', [BookController::class, 'updateBook']);
Route::delete('/books/{id}', [BookController::class, 'deleteBook']);
