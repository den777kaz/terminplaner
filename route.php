<?php
$script_name = explode("/", $_SERVER["SCRIPT_NAME"]);
unset($script_name[0]);
unset($script_name[count($script_name)]);
$script_name = implode("/", $script_name);

define("BASE_URL", $script_name);

$get_request = explode('?', $_SERVER["REQUEST_URI"]);
if (isset($get_request[1])) {
    $get_request = "?" . $get_request[1];
} else {
    $get_request = "";
}

$get_id = explode('/', $_SERVER["REQUEST_URI"]);
$id = "";
if ($get_id[count($get_id) - 2] === "events") {
    $id = $get_id[count($get_id) - 1];
    $_SESSION['current_event'] = $id;
}



match ($_SERVER["REQUEST_URI"]) {
    "/" . BASE_URL . "/" => header("Location:/" . BASE_URL . "/home"),
    "/" . BASE_URL . "/home" . @$get_request => include __DIR__ . "/public/pages/home_page.php",
    "/" . BASE_URL . "/calendar" . @$get_request => include __DIR__ . "/public/pages/calendar_page.php",
    "/" . BASE_URL . "/events" . @$get_request => include __DIR__ . "/public/pages/events_page.php",
    "/" . BASE_URL . "/events/" . $id . @$get_request => include __DIR__ . "/public/pages/eventDetails_page.php",
    default => include __DIR__ . "/public/pages/404_page.php",
};

