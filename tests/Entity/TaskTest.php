<?php

namespace App\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;

class TaskTest
{
    const FOOD_PRODUCT = 'Titre';
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }
    public function computeTask(): float | Exception
    {

        if (self::FOOD_PRODUCT == $this->title) {
            return 1;
        }
    }
}
