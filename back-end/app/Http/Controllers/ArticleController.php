<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\IndexArticleRequest;
use App\Http\Requests\Article\ShowArticleRequest;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Requests\Article\DestroyArticleRequest;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends ApiController
{
    protected $articleService;

    /**
     * ArticleController constructor.
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the resource.
     * @param IndexArticleRequest $request
     * @return Response
     */
    public function index(IndexArticleRequest $request)
    {
        $data = $request->validated();

        try {
            $items = $this->articleService->getAll(['*'], $data);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . ' - ' . $e->getMessage());
            return $this->errorResponse(null, __('errors.server'), 500);
        }

        return $this->dataResponse($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreArticleRequest  $request
     * @return Response
     */
    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        try {
            $item = $this->articleService->store($data);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . ' - ' . $e->getMessage());
            return $this->errorResponse(null, __('errors.server'), 500);
        }

        return $this->dataResponse($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  ShowArticleRequest  $request
     * @return Response
     */
    public function show(ShowArticleRequest $request)
    {
        $data = $request->validated();

        try {
            $item = $this->articleService->getById($data['id']);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . ' - ' . $e->getMessage());
            return $this->errorResponse(null, __('errors.server'), 500);
        }

        return $this->dataResponse($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateArticleRequest  $request
     * @return Response
     */
    public function update(UpdateArticleRequest $request)
    {
        $data = $request->validated();

        try {
            $this->articleService->updateById($data);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . ' - ' . $e->getMessage());
            return $this->errorResponse(null, __('errors.server'), 500);
        }

        return $this->dataResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyArticleRequest $request
     * @return Response
     */
    public function destroy(DestroyArticleRequest $request)
    {
        $data = $request->validated();

        try {
            $this->articleService->destroyById($data['id']);
        } catch (\Exception $e) {
            Log::error(__METHOD__ . ' - ' . $e->getMessage());
            return $this->errorResponse(null, __('errors.server'), 500);
        }

        return $this->dataResponse();
    }
}
