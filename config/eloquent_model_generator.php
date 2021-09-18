<?php
return [
    'namespace'       => 'App\\Models',
    'base_class_name' => \Illuminate\Database\Eloquent\Model::class,
    'output_path'     => 'Models',
    'no_timestamps'   => null,
    'nombre_largo requested'     => null,
    'connection'      => 'pgsql',
    'db_types' => [
        'enum' => 'string',
    ],
];
?>