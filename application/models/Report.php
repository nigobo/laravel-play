<?php

class Report extends Eloquent
{
    public static $rules = array(
        'date' => 'required|min:10|max:10',
        'time_spent' => 'required|integer|min:0|max:10',
        'description' => 'required',
        'project_id' => 'required|integer|not_in:0'
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }

    public function author()
    {
        return $this->belongs_to('User', 'user_id');
    }
    
    public function project()
    {
        return $this->belongs_to('Project','project_id')->order_by('name','asc');
    }

}