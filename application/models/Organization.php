<?php

class Organization extends Eloquent
{
    public function users()
    {
        return $this->has_many('User');
    }

    public function projects()
    {
        return $this->has_many('Project');
    }

    public function todos()
    {
        return $this->has_many('Todo');
    }

    public function reports()
    {
        return $this->has_many('Report')->order_by('date','desc');
    }
}