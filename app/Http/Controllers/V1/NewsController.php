<?php

namespace App\Http\Controllers\V1;

use App\Events\NewsCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\IndexNewsRequest;
use App\Http\Requests\V1\StoreNewsRequest;
use App\Http\Requests\V1\UpdateNewsRequest;
use App\Http\Resources\V1\NewsCollection;
use App\Http\Resources\V1\NewsResource;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexNewsRequest $request)
    {
        $this->authorize('viewAny', News::class);

        $news = News::byAuthor($request->input('author_id'))
            ->byCategory($request->input('category_id'), $request->input('include_subcategories', false))
            ->byTitle($request->input('title'));

        return new NewsCollection($news->paginate());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $request->user()->can('create', News::class);

        $news = News::create([
            'title' => $request->title,
            'announcement' => $request->announcement,
            'text' => $request->text,
            'publication_date' => $request->publication_date,
            'author_id' => $request->user()->id,
        ]);
        NewsCreated::dispatch($news);
        return new NewsResource($news);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return new NewsResource($news);
    }


//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(UpdateNewsRequest $request, News $news)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(News $news)
//    {
//        //
//    }
}
