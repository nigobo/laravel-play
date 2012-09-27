<?php

class Customer extends Eloquent
{
    public static $rules = array(
        'name' => 'required|min:2|max:128',
        'description' => 'required'
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }

    public function organization()
    {
        return $this->belongs_to('Organization');
    }

    public function projects(){
        return $this->has_many('Project');
    }
}