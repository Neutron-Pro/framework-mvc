<?php
namespace NeutronStars\Api\Model;

use NeutronStars\Core\Kernel;
use NeutronStars\Core\Database\QueryExecutor;

abstract class Model
{
    private string $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function all(): array
    {
        return $this->createQuery()
            ->select('*')
            ->getResults();
    }

    public function findById($id, string $column = 'id'): ?Object
    {
        return $this->createQuery()
               ->select('*')
               ->where($column.'=:id')
               ->setParameters([
                   ':id' => $id
               ])->getResult();
    }

    public function deleteById($id, string $column = 'id')
    {
        $this->createQuery()
            ->delete()
            ->where($column.'=:id')
            ->setParameters([
                ':id' => $id
            ])->execute();
    }

    public function count(): int
    {
        return $this->createQuery()->select('COUNT(*) as count')
            ->getResults()[0]->count;
    }

    protected function createQuery(): QueryExecutor
    {
        return Kernel::get()->getDatabase()->query($this->table);
    }
}
