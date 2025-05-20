<?php

class WeekService{
    protected $WeekRepository;

    public function __construct(WeekRepository $weekRepository){
        $this -> WeekRepository = $weekRepository;
    }
}