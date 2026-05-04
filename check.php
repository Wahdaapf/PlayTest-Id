<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

foreach (\App\Models\MisiSub::all() as $s) {
    echo "ID:{$s->id} Misi:{$s->id_misi} User:{$s->id_user} Hari:{$s->hari_ke} Status:{$s->status}\n";
}
