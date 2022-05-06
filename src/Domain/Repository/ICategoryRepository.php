<?php

namespace Domain\Repository;

use Domain\Entity\Category;

interface ICategoryRepository
{
    public function save(Category $category): Category;

    public function find(string $id): Category;

    public function all(?string $filter = '', ?string $order = 'DESC'): array;

    public function paginate(
        ?string $filter = '',
        ?string $order = 'DESC',
        ?int $page = 1,
        int $totalPage = 15
    ): array;

    public function update(Category $category): Category;

    public function delete(Category $category): bool;

    public function toCategory(object $data): Category;
}
