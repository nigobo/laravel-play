<?php

class Project extends Eloquent
{
    public function user()
    {
        return $this->belongs_to('User', 'user_id');
    }

    public function reports()
    {
        return $this->has_many('Report')->order_by('date','desc');
    }
}