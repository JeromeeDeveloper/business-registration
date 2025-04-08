<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/gemini-chat', function (Request $request) {
    $message = $request->input('message');
    $model = env('GEMINI_MODEL_ID'); // should now just be: tunedModels/ga-ai-here-djkeq8t7ju5x

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
    ])->post("https://generativelanguage.googleapis.com/v1beta/{$model}:generateContent?key=" . env('GEMINI_API_KEY'), [
        'contents' => [
            ['parts' => [['text' => $message]]]
        ]
    ]);

    if (!$response->successful()) {
        return response()->json([
            'error' => 'Gemini API request failed',
            'status' => $response->status(),
            'body' => $response->body()
        ], $response->status());
    }

    return $response->json();
});

