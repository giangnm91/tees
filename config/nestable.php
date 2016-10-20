<?php

return [
    'parent'=> 'ParentID',
    'primary_key' => 'CategoryID',
    'generate_url'   => true,
    'childNode' => 'children',
    'body' => [
        'CategoryID',
        'CategoryName',
        'Slug',
        'Icon',
    ],
    'html' => [
        'label' => 'name',
        'href'  => 'slug'
    ],
    'dropdown' => [
        'prefix' => '',
        'label' => 'CategoryName',
        'value' => 'CategoryID'
    ]
];
