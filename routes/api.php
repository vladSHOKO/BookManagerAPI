<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BookController;

Route::get('/books', [BookController::class, 'getCollection'])->middleware('auth:sanctum');
Route::get('/books/{id}', [BookController::class, 'getBookById'])->middleware('auth:sanctum');
Route::post('/books', [BookController::class, 'createBook'])->middleware('auth:sanctum');
Route::patch('/books/{id}', [BookController::class, 'updateBook'])->middleware('auth:sanctum');
Route::delete('/books/{id}', [BookController::class, 'deleteBook'])->middleware('auth:sanctum');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = \App\Models\User::query()->where(['email' => $request->email])->first();

    if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'The provided credentials are incorrect.'
            ]);
    }

    return response()->json(['token' => $user->createToken('api-token', ['*'], now()->addMinutes(1440))->plainTextToken]);
});
