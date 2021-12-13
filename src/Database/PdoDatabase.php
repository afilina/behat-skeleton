<?php
declare(strict_types=1);

namespace Tests\Acceptance\Database;

// Aura.SqlQuery simplifies the creation of SQL statements
use Aura\SqlQuery\QueryFactory;
use PDO;

class PdoDatabase implements Database
{
    public function __construct(
        private PDO $pdo,
        private QueryFactory $queryFactory
    )
    {
    }

    public function update(string $table, array $data, array $criteria): void
    {
        $query = $this->queryFactory->newUpdate();
        $query
            ->table($table)
            ->cols($data);

        foreach ($criteria as $col => $value) {
            $query->where("$col = :$col");
            $query->bindValue($col, $value);
        }

        $statement = $this->pdo->prepare($query->getStatement());
        $statement->execute($query->getBindValues());
    }

    public function insert(string $table, array $data): void
    {
        $query = $this->queryFactory->newInsert();
        $query
            ->into($table)
            ->cols($data);

        $statement = $this->pdo->prepare($query->getStatement());
        $statement->execute($query->getBindValues());
    }

    public function reset(): void
    {
        $sql = file_get_contents('config/reset.sql');
        $this->pdo->exec($sql);
    }
}
