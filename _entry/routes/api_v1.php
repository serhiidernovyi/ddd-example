<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('/first', function (Request $request) {
            return ['test' => 'test'];
        });
});


Route::post('/tokens/create', function (Request $request) {
    $user = \App\Models\User::where('email', $request->get('email'))->first();
    $token = $user->createToken('Test');
    return ['token' => $token->plainTextToken];
});
