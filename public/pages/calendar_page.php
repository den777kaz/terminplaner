<?php
use website\Calendar;

$data = [
    'page_title' => "Calendar 123213",
    'template' => 'calendar/index',
    'scripts' => ['calendar'],
];

$calendar = new Calendar($data);


