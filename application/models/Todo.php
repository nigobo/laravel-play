<?php

class Todo extends Eloquent
{
    public static $rules = array(
        'title' => 'required|min:2|max:128',
        'project_id' => 'required|integer'
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }

    public function reports()
    {
        return $this->has_many('Report')->order_by('date','desc');
    }

    public function project()
    {
        return $this->belongs_to('Project');
    }

    public function organization()
    {
        return $this->belongs_to('Organization');
    }
}