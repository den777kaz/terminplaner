<?php

use website\Home;
$data = [
    'page_title' => "Homepage",
    'template' => 'home'
];
$layout = new Home($data);

