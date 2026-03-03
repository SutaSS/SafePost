<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
Route::resource('posts', PostController::class);

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
});

Route::get('/sitemap.xml', function () {

    $sitemap = Sitemap::create();

    $posts = Post::latest()->get();

    foreach ($posts as $post) {
        $sitemap->add(
            Url::create("/posts/{$post->slug}")
                ->setLastModificationDate($post->updated_at)
        );
    }

    return $sitemap->toResponse(request());
});

Route::middleware('auth')->group(function () {

    Route::post('/posts/{post}/comments', 
        [CommentController::class, 'store'])
        ->name('comments.store');

    Route::delete('/comments/{comment}', 
        [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});
require __DIR__.'/auth.php';
