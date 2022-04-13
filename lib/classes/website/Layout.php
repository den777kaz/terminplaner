<?php

namespace website;

class Layout
{
    public array $links = [
        'Home' => 'home',
        'Calendar' => 'calendar',
        'Events' => 'events'
    ];
    public array $scripts = ['index', 'main'];
    public string $title = '';


    public function setScripts(array $scripts = []): void
    {
        foreach ($scripts as $script) {
            $this->scripts[] = $script;
        }
    }

    public function getScripts(): array
    {
        return $this->scripts;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setLinks(array $links): void
    {
        foreach ($links as $link) {
            $this->links[] = $link;
        }
    }

    public function getLinks(): array
    {
        return $this->links;
    }


    public function getHeader():void
    {
         include "lib/views/header.php";
    }


    public function getFooter(): string
    {
        return include "lib/views/footer.php";
    }

    public function getContent(string $content = "")
    {
        if (str_starts_with($content, '#')) {
            echo substr($content, 1, strlen($content));

        } else if (trim($content) !== "") {
            include("lib/views/" . $content . ".php");

        }
    }

}


