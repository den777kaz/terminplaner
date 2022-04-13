<?php

namespace website;
class Home extends Layout
{

    public function __construct(array $data = [])
    {


        $this->setTitle($data['page_title']);
        $this->getHeader();
        $this->getContent($data['template']);
        $this->getFooter();
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