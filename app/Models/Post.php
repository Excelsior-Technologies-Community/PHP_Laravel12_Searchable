<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Post extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->title,
            route('posts.show', $this->id)
        );
    }

    public function scopeFullTextSearch(Builder $query, string $searchTerm): Builder
    {
        if ($searchTerm) {
            return $query->whereRaw(
                'MATCH(title, content) AGAINST(? IN NATURAL LANGUAGE MODE)',
                [$searchTerm]
            )->orderByRaw(
                'MATCH(title, content) AGAINST(? IN NATURAL LANGUAGE MODE)',
                [$searchTerm]
            );
        }

        return $query;
    }
}
