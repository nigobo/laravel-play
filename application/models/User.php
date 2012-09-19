<?php
class User extends Eloquent
{
    public function posts()
    {
        return $this->has_many('Post');
    }

    public function reports()
    {
        return $this->has_many('Report');
    }

    public function projects()
    {
        return $this->has_many('Project');
    }

}
