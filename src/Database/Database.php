<?php
declare(strict_types=1);

namespace Tests\Acceptance\Database;

interface Database
{
    public function update(string $table, array $data, array $criteria): void;

    public function insert(string $table, array $data): void;

    public function reset(): void;
}
