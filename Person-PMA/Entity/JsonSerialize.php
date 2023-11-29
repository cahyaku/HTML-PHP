<?php

namespace App\Entity;

class JsonSerialize
{
    public function jsonSerialize(): object
    {
        return (object)get_object_vars($this);
    }
}
