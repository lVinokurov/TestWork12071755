<?php


namespace App\Repositories\Interfaces;


interface ArticleRepositoryInterface
{
    /**
     * Get the all articles | paginate
     *
     * @param array $columns
     * @param array $data
     * @return array
     */
    public function getAll(array $columns, array $data): array;

    /**
     * Create a new article
     *
     * @param array $data
     * @return array
     */
    public function store(array $data): array;

    /**
     * Get the one article by id
     *
     * @param int $id
     * @return array
     */
    public function getById(int $id): array;

    /**
     * Update the one article by id
     *
     * @param array $data
     * @return bool
     */
    public function updateById(array $data): bool;

    /**
     * Delete the one article by id
     *
     * @param int $id
     * @return bool
     */
    public function destroyById(int $id): bool;
}
