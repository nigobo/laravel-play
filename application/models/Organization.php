<?php

class Organization extends Eloquent
{
    public function user()
    {
        return $this->has_many('User');
    }

    public function reports()
    {
        return $this->has_many('Report')->order_by('date','desc');
    }
}