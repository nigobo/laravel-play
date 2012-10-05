<?php
class User extends Eloquent
{

    /**
     * A user can have many reports
     */
    public function reports()
    {
        return $this->has_many('Report');
    }

    /**
     * A user can ha
     * FIXME: is this used?
     */
    public function projects()
    {
        return $this->has_many('Project');
    }

    /**
     * A user only belongs to one organization
     */
    public function organization()
    {
        return $this->belongs_to('Organization');
    }

}
