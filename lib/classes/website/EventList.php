<?php

namespace website;

use database\Mysqli;

class EventList extends Layout
{

    public array $events = [];

    public string $current_date;
    public string $current_time;
    public string $time_plus_one_hour;


    public function setCurrentDate(): void
    {
        $this->current_date = date("Y-m-d");
    }

    public function setCurrentTime(): void
    {
        $this->current_time = date('H:i');
    }

    public function setCurrentTimePlusOneHour(): void
    {
        $timestamp = strtotime($this->current_time) + 60 * 60;
        $this->time_plus_one_hour = date('H:i', $timestamp);
    }



    public function __construct(array $data = [], bool $layout = true)
    {
        if($layout) {
            $this->setCurrentDate();
            $this->setCurrentTime();
            $this->setCurrentTimePlusOneHour();

            $this->getEvents();
            $this->setScripts($data['scripts']);
            $this->setTitle($data['page_title']);

            $this->getHeader();
            $this->getContent($data['template']);
            $this->getFooter();
        }

    }


    public function getEvents(): void
    {
        $db = new Mysqli();

        $sql = "SELECT * FROM events
                ORDER by created_at DESC";
        $this->events = $db->select($sql);

    }



}