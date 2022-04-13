<?php

$events = '';
$event_list = $this->events;

foreach ($event_list as $event) {
    $events .= "<div class='event'>
        <a href='events/" . $event['event_pk'] . "'>
        <div>" . $event['event_title'] . "</div>
        </a>
        <div>" . $event['description'] . "</div>
        <div>" . $event['time_start'] . "</div>
        <div>" . $event['time_end'] . "</div>
        <form method='post'>
            <div><a href='events/" . $event['event_pk'] . "' class='btn'>to Event </a></div>
            <div><button name='delete' class='btn'>delete </button></div>
            <input type='hidden' name='event_pk' value='" . $event['event_pk'] . "'>
        </form>
        <hr>
    </div>";
}
?>


<div class="container">
    <h1>events list</h1>
    <div class="eventList">
        <?php $this->getContent('sidebar') ?>
        <div class="events">
            <?= $events ?>
        </div>
    </div>
</div>