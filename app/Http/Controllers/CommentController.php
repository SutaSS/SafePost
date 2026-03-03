<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|min:3'
        ]);

        try {

            DB::beginTransaction();

            Comment::create([
                'content' => $request->input('content'),
                'post_id' => $postId,
                'user_id' => Auth::id(),
            ]);

            DB::commit();

            return back()->with('success', 'Comment berhasil ditambahkan');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Gagal menambahkan comment');
        }
    }

    public function destroy(Comment $comment)
    {
        try {

            // Optional: hanya pemilik bisa hapus
            if ($comment->user_id !== Auth::id()) {
                abort(403);
            }

            $comment->delete();

            return back()->with('success', 'Comment berhasil dihapus');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus comment');
        }
    }
};