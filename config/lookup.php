<?php

use Illuminate\Support\Env;


return [
    'db_json_support' => Env::get('LOOKUP_DB_JSON_SUPPORT', true),
];
