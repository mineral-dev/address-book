<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    "database" => [
        'connection' => env("DB_ADRRESS_BOOK_DATABASE", config('database.default')),
        'table' => "address_books"
    ],
    'paginate' => 10
];