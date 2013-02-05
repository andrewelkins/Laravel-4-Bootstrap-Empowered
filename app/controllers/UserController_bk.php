<?php
/*
|--------------------------------------------------------------------------
| Confide Controller Template
|--------------------------------------------------------------------------
|
| This is the default Confide controller template for controlling user
| authentication. Feel free to change to your needs.
|
*/

class UserController extends AuthorizedController {

    /**
     * Let's whitelist all the methods we want to allow guests to visit!
     *
     * @access   protected
     * @var      array
     */
    protected $whitelist = array(
        'getLogin',
        'postLogin',
        'getRegister',
        'postRegister',
        'getForgotPassword',
        'postResetPassword'
    );

    /**
     * Check that the user is logged in, show profile page
     */
    public function getIndex()
    {
        // Todo actually get the user and error
        return View::make('user/index')->with('user', array());
    }

    /**
     * Displays the login form
     *
     */
    public function getLogin()
    {
        return View::make('user/login');
    }

    /**
     * Attempt to do login
     *
     */
    public function postLogin()
    {
        $input = array(
            'email' => Input::get( 'email' ),
            'password' => Input::get( 'password' ),
            'remamber' => Input::get( 'remember' ),
        );

        if ( Confide::logAttempt( $input ) ) 
        {
            return Redirect::to('/');
        }
        else
        {
            $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            return Redirect::action('UserController@login')
                ->withInput(Input::except('password'))
                ->with( 'error', $err_msg );
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function getLogout()
    {
        Confide::logout();

        return Redirect::to('/');
    }

    /**
     * Displays the form for account creation
     *
     */
    public function getRegister()
    {
        return View::make('user/register');
    }

    /**
     * Stores new account
     *
     */
    public function postRegister()
    {
        $user = new User;

        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );
        $user->password = Input::get( 'password' );

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.
        $user->password_confirmation = Input::get( 'password_confirmation' );

        // Save if valid. Password field will be hashed before save
        $user->save();

        if ( $user->id )
        {
            return Redirect::action('UserController@login');
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $user->getErrors()->all();

            return Redirect::action('UserController@create')
                ->withInput(Input::except('password'))
                ->with( 'error', $error );
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string  $code
     */
    public function getConfirm( $code )
    {
        if ( Confide::confirm( $code ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UserController@login')
                ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UserController@login')
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function getForgotPassword()
    {
        return Confide::makeForgetPasswordForm();
    }

    /**
     * Attempt to reset password with given email
     *
     */
    public function postResetPassword()
    {
        if( Confide::resetPassword( Input::get( 'email' ) ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::action('UserController@login')
                ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::action('UserController@forgot_password')
                ->withInput()
                ->with( 'error', $error_msg );
        }
    }

}