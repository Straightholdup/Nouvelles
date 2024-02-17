<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $author = Author::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json(['message' => 'Author registered successfully']);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // If authentication succeeds, retrieve the authenticated author
            $author = Auth::user();

            // Create a plain text token for the authenticated author
            $token = $author->createToken('author-token', ["news:create"])->plainTextToken;

            // Return the token as a JSON response
            return response()->json(['token' => $token]);
        }

        // If authentication fails, return an unauthorized response
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
