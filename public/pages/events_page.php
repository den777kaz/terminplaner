<?php

use website\EventHandler;
use website\EventList;

if (isset($_POST['delete'])) {
    $event = new EventHandler($_POST['event_pk']);
    $event->delete();

    header('Location:' . $_SERVER['REDIRECT_URL'] );
    exit;

}


if(isset($_POST['create'])) {
    $data = [
        'event_title' => $_POST['title'],
        'type_fk' => 3,
        'user_fk' => 61,
        'event_date' => $_POST['date'],
        'time_start' => $_POST['start'],
        'time_end' => $_POST['end'],
        'description' => $_POST['description'],
    ];

    $event= new EventHandler();
    $event->create($data);

    header('Location:' . $_SERVER['REDIRECT_URL'] );
    exit;
}




$data = [
    'page_title' => "events title",
    'template' => 'events/eventList',
    'scripts' => ['events'],
];

$list = new EventList($data);