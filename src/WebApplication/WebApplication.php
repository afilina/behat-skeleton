<?php
declare(strict_types=1);

namespace Tests\Acceptance\WebApplication;

use Psr\Http\Message\ResponseInterface;

interface WebApplication
{
    public function visit(string $url): ResponseInterface;

    public function submitForm(string $url, array $data): ResponseInterface;

    public function getLastResponse(): ResponseInterface;
}
