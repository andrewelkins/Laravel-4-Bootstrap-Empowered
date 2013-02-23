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

    /**
     * Check is user is confirmed.
     * @param $credentials
     * @return bool
     */
    public static function isConfirmed( $credentials )
    {
        $user = (new User())
            ->where('email','=',$credentials['email'])
            ->orWhere('username','=',$credentials['email'])
            ->first();

        // If confirmed return true.
        if( $user->confirmed )
        {
            return true;
        }
        else
        {
            // Fail
            return false;
        }

    }

    /**
     * Redirect after auth.
     * If ifValid is set to true it will redirect a logged in user.
     * @param $redirect
     * @param bool $ifValid
     * @return mixed
     */
    public static function checkAuthAndRedirect($redirect, $ifValid=false)
    {
        // Get the user information
        $user = Auth::user();
        $redirectTo = false;

        if(empty($user->id) && ! $ifValid) // Not logged in redirect, set session.
        {
            Session::put('loginRedirect', $redirect);
            $redirectTo = Redirect::to('user/login')
                ->with( 'notice', Lang::get('user/user.login_first') );
        }
        elseif(!empty($user->id) && $ifValid) // Valid user, we want to redirect.
        {
            $redirectTo = Redirect::to($redirect);
        }

        return array($user, $redirectTo);
    }

}