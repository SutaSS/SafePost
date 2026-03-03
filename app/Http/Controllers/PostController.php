<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;

class PostController extends Controller
{
    /**
     * Display list of posts (optimized)
     */
    public function index()
    {
        try {

            $query = Post::with('user')->latest();

            if (request()->filled('search')) {
                $query->where('title', 'like', '%' . request('search') . '%');
            }

            $posts = $query->paginate(10)->withQueryString();

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

            // Dynamic SEO
            SEOTools::setTitle($post->title);
            SEOTools::setDescription(Str::limit(strip_tags($post->content), 160));
            SEOTools::opengraph()->setUrl(url()->current());
            SEOTools::opengraph()->addProperty('type', 'article');
            SEOTools::twitter()->setSite('@SafePost');
            SEOTools::jsonLd()->setType('Article');
            SEOTools::jsonLd()->addValue('headline', $post->title);
            SEOTools::jsonLd()->addValue('author', $post->user->name);
            SEOTools::jsonLd()->addValue('datePublished', $post->created_at);

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