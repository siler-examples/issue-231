<?php declare(strict_types=1);

namespace SilerExamples;

use function Siler\GraphQL\publish;
use function Siler\GraphQL\subscriptions_at;

require_once __DIR__ . '/../vendor/autoload.php';

subscriptions_at('ws://localhost:3000');

publish('echo', $argv[1]);