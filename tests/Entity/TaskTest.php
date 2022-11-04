<?php

namespace App\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;

class TaskTest
{
    const TITLE = 'Titre';
    const CONTENT = 'Contenu';
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }
    public function computeTask(): float | Exception
    {

        if (self::TITLE == $this->title && self::CONTENT == $this->content) {
            return 1;
        }
    }
}
