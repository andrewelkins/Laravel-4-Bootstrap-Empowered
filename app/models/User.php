<?php

use Zizaco\Confide\ConfideUser;

class User extends ConfideUser {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    /**
     * Get the user full name.
     *
     * @access   public
     * @return   string
     */
    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}