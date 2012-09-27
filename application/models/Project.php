<?php

class Project extends Eloquent
{
    public static $rules = array(
        'name' => 'required|min:2|max:128',
        'description' => 'required',
        'customer_id' => 'required|integer'
    );

    public static function validate($data){
        return Validator::make($data, static::$rules);
    }

    public function user()
    {
        return $this->belongs_to('User', 'user_id');
    }

    public function reports()
    {
        return $this->has_many('Report')->order_by('date','desc');
    }
}