<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreAuthorRequest;
use App\Http\Resources\V1\AuthorCollection;
use App\Http\Resources\V1\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new AuthorCollection(Author::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        $validated = $request->validated();

        $author = new Author();
        $author->name = $validated['name'];
        $author->email = $validated['email'];

        // Handle avatar image upload if provided
        if ($request->hasFile('avatar')) {
            $avatarPath = $validated->file('avatar')->store('avatars');
            $author->avatar = $avatarPath;
        }

        // Save the Author instance to the database
        $author->save();

        return new AuthorResource($author);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
