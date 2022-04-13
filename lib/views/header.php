<?php
namespace website\Layout;

$links = $this->getLinks();
$title = $this->getTitle();

$links_output = "";
foreach ($links as $link => $path) {
    $active = str_contains($_SERVER["REQUEST_URI"],"/" . $path) ? "active" : "";
    $links_output .= "<li class='$active'><a href='/" . BASE_URL . "/$path'>$link</a></li>\n";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/<?= BASE_URL ?>/public/css/main.css">
    <title><?=$title?></title>
</head>
<body>
<header class="header">
    <div class="container">
        <nav class="navbar">
            <div class="navbar__logo">
                LOGO
            </div>
            <div class="navbar__menu">
                <ul>

                    <?=$links_output?>
                </ul>
            </div>
            <div class="navbar__options">
                <ul>
                    <li><a href="$">sign in</a></li>
                    <li><a href="$">sign up</a></li>
                </ul>
            </div>
        </nav>
    </div>







</header>
<main>
