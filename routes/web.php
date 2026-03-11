<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;

// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    return view('welcome');
});

// Read-only posts index
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Sitemap
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

// ==================== GOOGLE AUTH ROUTES ====================
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// ==================== TWO-FACTOR AUTH ROUTES ====================
// Setelah login, user harus verify 2FA dulu
Route::middleware('auth')->group(function () {
    Route::get('/2fa/verify', [TwoFactorController::class, 'show'])->name('2fa.verify.form');
    Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');
});

// ==================== AUTHENTICATED ROUTES (AFTER 2FA) ====================
Route::middleware(['auth', 'verified', 'twofactor'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2FA Enablement
    Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
    Route::post('/2fa/confirm', [TwoFactorController::class, 'confirm'])->name('2fa.confirm');
    Route::delete('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');

    // Posts (Create, Update, Delete)
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Comments
    Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Catch-all post slug MUST be defined after posts/create
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');

require __DIR__.'/auth.php';
