<?php


namespace App\Services;


use App\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleService extends Services
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Get articles
     *
     * @param array|string[] $column
     * @param array $request
     * @return array
     */
    public function getAll(array $column = ['*'], array $request = []): array
    {
        return $this->articleRepository->getAll($column, $request);
    }

    /**
     * Save a new article
     *
     * @param array $data
     * @return array
     */
    public function store(array $data): array
    {
        return $this->articleRepository->store($data);
    }

    /**
     * Get the article by Id
     *
     * @param int $id
     * @return array
     */
    public function getById(int $id) : array
    {
        return $this->articleRepository->getById($id);
    }

    /**
     * Update the article by Id
     *
     * @param array $data
     * @return bool
     */
    public function updateById(array $data) : bool
    {
        return $this->articleRepository->updateById($data);
    }

    /**
     * Delete the article by Id
     *
     * @param int $id
     * @return bool
     */
    public function destroyById(int $id) : bool
    {
        return $this->articleRepository->destroyById($id);
    }

}
