<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'announcement', 'text', 'publication_date', 'author_id'];

    public function scopeByTitle($query, $title): void
    {
        if (is_null($title)) return;
        $query->where('title', 'like', '%' . $title . '%');
    }

    public function scopeByCategory($query, $categoryId, $includeSubcategories = false): void
    {
        if (is_null($categoryId)) return;
        $categoryIds = $this->getCategoryIds($categoryId, $includeSubcategories);
        $query->whereHas('categories', function ($cq) use ($categoryIds) {
            $cq->whereIn('category_id', $categoryIds);
        });
    }

    public function scopeByAuthor($query, $authorId): void
    {
        if (is_null($authorId)) return;
        $query->where('author_id', $authorId);
    }

    private function getCategoryIds(int $category_id, bool $include_subcategories = false): array
    {
        $categoryIds = [$category_id];

        if ($include_subcategories) {
            $categoryIds = $this->getSubcategoryIds($category_id, $categoryIds);
        }

        return $categoryIds;
    }

    private function getSubcategoryIds(int $categoryId, array &$categoryIds): array
    {
        $subcategories = Category::where('parent_id', $categoryId)->pluck('id')->toArray();

        foreach ($subcategories as $subcategory) {
            $categoryIds[] = $subcategory;
            $this->getSubcategoryIds($subcategory, $categoryIds);
        }

        return $categoryIds;
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
