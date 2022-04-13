<?php

namespace website;

use database\Mysqli;

class Calendar extends Layout
{
    public string $today;
    public string $today_ym;
    public string $ym;
    public string $timestamp;
    public string $day_count;


    public string $titleMonth;
    public string $titleYear;


    public function setToday(): void
    {
        $this->today = date('Y-m-j');
        $this->today_ym = date('Y-m');
    }

    public function __construct(array $data)
    {

        $this->setToday();
        $this->get_current_date();

        $this->check_type();
        $this->setTitle($data['page_title']);
        $this->getHeader();
        $this->getContent($data['template']);
        $this->getFooter();
        $this->setScripts($data['scripts']);
    }



//    +++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++


    public function check_type()
    {
        if (!isset($_GET['type'])) {
            header("Location:/" . BASE_URL . "/calendar?type=month");
        }
    }

    public function switch_type()
    {
        match ($_GET["type"]) {
            "year" => $this->getContent('calendar/year'),
            "month" => $this->getContent('calendar/month'),
            "week" => $this->getContent('calendar/week'),
            "day" => $this->getContent('calendar/day'),
            default => $this->getContent("#Sorry! We have a Problem."),
        };

    }


    public function setPrevDate(): string
    {
        $this->ym = date('Y-m', strtotime('-1 month', $this->timestamp));
        return $this->ym;
    }

    public function setNextDate(): string
    {
        $this->ym = date('Y-m', strtotime('+1 month', $this->timestamp));
        return $this->ym;
    }


    function setDayCount()
    {
        $this->day_count = date('t', $this->timestamp);
    }

    public function get_current_date()
    {
        if (isset($_GET['ym'])) {
            $this->ym = $_GET['ym'];
        } else {
            $this->ym = $this->today_ym;
        }


        $this->timestamp = strtotime($this->ym . '-01');

        $this->setDayCount();

        $this->titleYear = date('Y', $this->timestamp);
        $this->titleMonth = date('F', $this->timestamp);
    }


    public function render_quick_events(string $current_date, string $class = ''): string
    {
        $db = new Mysqli();
        $sql = "SELECT * FROM events";
        $events = $db->select($sql);

        $output = "";
        foreach ($events as $event) {
            if ($current_date == $event["event_date"]) {
                // print_p($event["event_date"]);
                $past = date('Y-m-j') > $event["event_date"] ? 'past' : '';

                $output .= "<div class='quick-event $past $class'>
                             <span class='quick-event_title'>" . $event['event_title'] . "</span>
                             <span class='quick-event_time'>" . $event['time_start'] . "</span>
                        </div>";
            }
        }

        return $output;
    }


}