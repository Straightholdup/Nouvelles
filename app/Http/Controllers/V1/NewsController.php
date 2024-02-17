<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreNewsRequest;
use App\Http\Requests\V1\UpdateNewsRequest;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return News::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return $news;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }
}
