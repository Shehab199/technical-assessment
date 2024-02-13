<?php

namespace App\Http\Controllers;

use App\Models\SavedArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SavedArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {
        $request->validate([
            'article_id' => 'required|integer',
        ]);

        $userId = Auth::id();

        $existingSavedArticle = SavedArticle::where('user_id', $userId)
            ->where('article_id', $request->article_id)
            ->first();

        $text = '';
        if ($existingSavedArticle) {
            $text = 'deleted';
            SavedArticle::where('user_id', $userId)
            ->where('article_id', $request->article_id)
            ->delete();
        } else {
            $text = 'saved';
            SavedArticle::create([
                'user_id' => $userId,
                'article_id' => $request->article_id,
            ]);
        }

        $savedArticles = SavedArticle::where('user_id', $userId)->get();
        Cache::put('saved_articles', $savedArticles);

        return response()->json(['message' => 'Article '.  $text . ' successfully'], 200);
    }

    public function getSavedArticles()
    {
        $userId = Auth::id();

        $savedArticles = SavedArticle::where('user_id', $userId)->paginate(6);

        return view('articles.saved', ['savedArticles' => $savedArticles]);
    }
}
