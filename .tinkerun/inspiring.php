<?php

$a = [
    [
        'href' => '/example',
        'label' => 'Example',
        'icon' => 'example',
        'caption' => 'examle for datatable',
        'active' => false
    ]
];

foreach ($a as $key => $item) {
    dump($key, $item);
}
