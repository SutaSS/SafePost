<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Exception;

class PostController extends Controller
{
    /**
     * Display list of posts (optimized)
     */
    public function index()
    {
        try {

            $posts = Post::with('user')
                ->latest()
                ->paginate(10);

            return view('posts.index', compact('posts'));

        } catch (Exception $e) {
            return back()->with('error', 'Gagal mengambil data post');
        }
    }

    /**
     * Show single post (SEO slug)
     */
    public function show($slug)
    {
        try {

            $post = Post::with('user')
                ->where('slug', $slug)
                ->firstOrFail();

            return view('posts.show', compact('post'));

        } catch (Exception $e) {
            abort(404);
        }
    }

    /**
     * Store new post
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required'
        ]);

        try {

            DB::beginTransaction();

            $slug = Str::slug($request->title);

            if (Post::where('slug', $slug)->exists()) {
                $slug .= '-' . time();
            }

            Post::create([
                'title' => $request->title,
                'slug' => $slug,
                'content' => $request->input('content'),
                'user_id' => Auth::id(),
            ]);

            DB::commit();

            return redirect()->route('posts.index')
                ->with('success', 'Post berhasil dibuat');

        } catch (Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Gagal membuat post');
        }
    }

    /**
     * Update post
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required'
        ]);

        try {

            DB::beginTransaction();

            $slug = Str::slug($request->title);

            if ($post->slug !== $slug) {
                if (Post::where('slug', $slug)->exists()) {
                    $slug .= '-' . time();
                }
            }

            $post->update([
                'title' => $request->title,
                'slug' => $slug,
                'content' => $request->input('content'),
            ]);

            DB::commit();

            return back()->with('success', 'Post berhasil diupdate');

        } catch (Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Gagal update post');
        }
    }

    /**
     * Delete post
     */
    public function destroy(Post $post)
    {
        try {

            $post->delete();

            return back()->with('success', 'Post berhasil dihapus');

        } catch (Exception $e) {

            return back()->with('error', 'Gagal menghapus post');
        }
    }
}