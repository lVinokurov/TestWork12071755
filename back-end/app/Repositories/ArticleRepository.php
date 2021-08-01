<?php


namespace App\Repositories;


use App\Models\Article;
use App\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleRepository extends Repository implements ArticleRepositoryInterface
{
    /**
     * Get the all articles | paginate
     *
     * @param string $columns
     * @param array $data
     * @return array
     */
    public function getAll($columns = '*', array $data = []): array
    {
        $result = Article::
            select($columns)
            ->when(isset($data['sortBy']), function ($q) use ($data) {
                $q->orderBy($data['sortBy'], ($data['sortDesc'] == 'true') ? 'desc' : 'asc');
            });

        if (isset($data['page']) && isset($data['perPage'])) {
            $result = $result->paginate($data['perPage']);
            $result = $this->doArrayForPagination($result);
        } else {
            $result = $result
                ->get()
                ->toArray();
        }

        return $result;
    }

    /**
     * Create a new article
     *
     * @param array $data
     * @return array
     */
    public function store(array $data): array
    {
        $item = Article::create($data);

        return $item->toArray();
    }

    /**
     * Get the one article by id
     *
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        $item = Article::where('id', $id)->first();

        return $item->toArray();
    }

    /**
     * Update the one article by id
     *
     * @param array $data
     * @return bool
     */
    public function updateById(array $data): bool
    {
        $item = Article::where('id', $data['id'])
            ->update($data);

        return $item;
    }

    /**
     * Delete the one article by id
     *
     * @param int $id
     * @return bool
     */
    public function destroyById(int $id): bool
    {
        $item = Article::where('id', $id)
            ->delete();

        return $item;
    }

}
