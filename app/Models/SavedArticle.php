<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedArticle extends Model
{
    protected $table = 'saved_articles';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = ['user_id', 'article_id'];
    protected $fillable = ['user_id', 'article_id'];
    protected $casts = [
        'user_id' => 'integer',
        'article_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
