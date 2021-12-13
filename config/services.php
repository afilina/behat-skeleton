<?php
declare(strict_types=1);

namespace Tests\Acceptance\Configuration;

use Aura\SqlQuery\QueryFactory;
use DI;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use PDO;
use Psr\Container\ContainerInterface;
use Tests\Acceptance\Database\Database;
use Tests\Acceptance\Database\PdoDatabase;
use Tests\Acceptance\WebApplication\GuzzleWebApplication;
use Tests\Acceptance\WebApplication\WebApplication;

$container[WebApplication::class] = DI\autowire(GuzzleWebApplication::class);
$container[ClientInterface::class] = DI\factory(static function (ContainerInterface $container): ClientInterface {
    return new Client([
        'base_uri' => 'http://example.com',
        'allow_redirects' => true,
        'http_errors' => false,
        'cookies' => true,
    ]);
});

$container[Database::class] = DI\factory(static function (ContainerInterface $container): Database {
    return new PdoDatabase(
        new PDO(
            'sqlite:database.sq3',
            null,
            null,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ),
        new QueryFactory('Sqlite')
    );
});

return (new DI\ContainerBuilder())
    ->addDefinitions($container)
    ->build();
