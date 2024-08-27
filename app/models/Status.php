<?php

class Status
{
    public int $id;
    public string $name;

    public function __construct(
        int $id = 0,
        string $name = '',

    ) {
        $this->id = $id;
        $this->name = $name;
    }
}