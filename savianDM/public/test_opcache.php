<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

try {
    $x = \App\Models\Empresa::withCount('movils')->count();
    file_put_contents('output.txt', "Success: $x");
} catch (\Throwable $e) {
    file_put_contents('output.txt', "Error: " . $e->getMessage() . "\n" . $e->getTraceAsString());
}
echo "Done";
