<?php

namespace App\Policies\V1;

use App\Models\Author;
use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?Author $author): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?Author $author, Category $category): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Author $author): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Author $author, Category $category): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Author $author, Category $category): bool
    {
        return false;
    }
}
