<?php
declare(strict_types=1);

namespace Tests\Acceptance\Context;

use Assert\Assert;
use Behat\Behat\Context\Context;
use Symfony\Component\DomCrawler\Crawler;
use Tests\Acceptance\Database\Database;
use Tests\Acceptance\WebApplication\WebApplication;

class ExampleContext implements Context
{
    public function __construct(
        private WebApplication $application,
        private Database $database,
    )
    {
    }

    /**
     * @When I visit :string
     */
    public function iVisit($page)
    {
        $this->application->visit($page);
    }

    /**
     * @Then I should see :string
     */
    public function iShouldSee(string $expectedText): void
    {
        $crawler = new Crawler(
            (string)$this->application
                ->getLastResponse()
                ->getBody()
        );
        Assert::that($crawler->text())
            ->contains($expectedText);
    }

    /**
     * @Given /^A discount of (\d+) percent on all products$/
     */
    public function aPercentDiscountOnAllProducts(int $percent)
    {
        $this->database->insert('discount', [
            'percent' => $percent,
            'type' => 'global',
        ]);
    }
}
