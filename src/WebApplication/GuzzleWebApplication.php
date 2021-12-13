<?php
declare(strict_types=1);

namespace Tests\Acceptance\WebApplication;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

final class GuzzleWebApplication implements WebApplication
{
    /** @var ResponseInterface[] */
    private array $responses = [];

    public function __construct(
        private ClientInterface $guzzle,
    )
    {
    }

    public function visit(string $url): ResponseInterface
    {
        $this->responses[] = $response = $this->guzzle->request(
            'GET',
            $url
        );

        return $response;
    }

    public function submitForm(string $url, array $data): ResponseInterface
    {
        $this->responses[] = $response = $this->guzzle->request(
            'POST',
            $url,
            ['form_params' => $data]
        );

        return $response;
    }

    public function getLastResponse(): ResponseInterface
    {
        return $this->responses[count($this->responses) - 1];
    }
}
