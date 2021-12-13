<?php
declare(strict_types=1);

namespace Tests\Acceptance\Context;

use Behat\Behat\Context\Context;
use Tests\Acceptance\Database\Database;

class ResetDatabaseContext implements Context
{
    public function __construct(
        private Database $database,
    )
    {
    }

    /**
     * @BeforeScenario
     */
    public function beforeScenario(): void
    {
        $this->database->reset();
    }
}
