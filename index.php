<?php declare(strict_types=1);

namespace SilerExamples;

use function Siler\Functional\identity;
use function Siler\GraphQL\debug;
use function Siler\GraphQL\schema;
use function Siler\GraphQL\subscriptions_manager;
use function Siler\Swoole\graphql_handler;
use function Siler\Swoole\graphql_subscriptions;
use function Siler\Swoole\http_server_port;

require_once __DIR__ . '/vendor/autoload.php';

debug();

$type_defs = file_get_contents(__DIR__ . '/schema.graphql');
$resolvers = [
    'Subscription' => [
        'echo' => identity(),
    ],
];

$schema = schema($type_defs, $resolvers);
$manager = subscriptions_manager($schema);
$server = graphql_subscriptions($manager, 3000);

http_server_port($server, graphql_handler($schema), 8000);

$server->start();