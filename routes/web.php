<?php

use Faker\Factory;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

Route::get('/', function () {
    return view('welcome');
})->name('level.01');

Route::get('/550a141f12de6', function (Request $request) {
    $hdrs = $request->header();
    $hdrs['next'] = route('level.03');
    $hdrs['accept'] = substr($hdrs['accept'][0], 0, 21) . '-ZmxhZ3s5NDNlNGYwMjcwNmFjZDAyNjVlMTNkMzA0MzNhNGYxOX0=-' . substr($hdrs['accept'][0], 21);
    return response()->json($hdrs);
})->name('level.02');

Route::get('/d95774d03a3ef', function () {
    $faker = Factory::create();
    for ($i = 0; $i < 50; $i++) {
        if ($i === 34) {
            setcookie('cookie_ga_' . $i, 'ZmxhZ3s4N2MzZTgwMzIwMzkzYjVmNDE2NjFhNzVjZjBjZDFlY30=', 3600, '/d95774d03a3ef');
        } else {
            setcookie('cookie_ga_' . $i, base64_encode($faker->uuid), 3600, '/d95774d03a3ef');
        }
    }
    return view('landing');
})->name('level.03');

Route::post('/upload222452525', function (Request $request) {
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        if ($file->getSize() <= 16) {
            $uuid = str_replace('-', '', Uuid::uuid4());
            $file->storeAs('public/uploads', $uuid . '.' . $file->getClientOriginalExtension());
            return response()->json([
                'msg' => 'success',
                'path' => '/storage/uploads/' . $uuid . '.' . $file->getClientOriginalExtension()
            ]);
        } else {
            return response()->json([
                'err' => 'File size is too large.... think small',
                'size' => $file->getSize()
            ]);
        }
    } else
        return response()->json('none', 422);
})->name('upload');
