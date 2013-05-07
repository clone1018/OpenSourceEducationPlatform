<?php

class AccountController extends BaseController
{

    public function getIndex()
    {
        return Redirect::to('/');
    }

    public function getLogin()
    {
        return View::make('account.login');
    }

    public function postLogin()
    {
        $all = Input::all();

        $rules = array(
            'email' => 'required|exists:users',
            'password' => 'required',
        );

        $validator = Validator::make($all, $rules);

        if($validator->fails()) {
            return Redirect::action('AccountController@getLogin')->withErrors($validator->messages());
        }


        $credentials = array(
            'email' => Input::get('email'),
            'password' => Input::get('password'),
        );

        try {
            $user = Sentry::authenticate($credentials, false);

            return Redirect::to('/');

        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            echo 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            echo 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            echo 'User was not found.';
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            echo 'User is not activated.';
        }

// The following is only required if throttle is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            echo 'User is suspended.';
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            echo 'User is banned.';
        }

    }

    public function getRegister()
    {
        return View::make('account.register');
    }

    public function postRegister()
    {
        $all = Input::all();

        $rules = array(
            'username' => 'required|min:2|max:255|unique:users',
            'email' => 'required|min:6|max:255|email|unique:users',
            'password' => 'required|min:6',
        );

        $validator = Validator::make($all, $rules);

        if($validator->fails()) {
            return Redirect::action('AccountController@getLogin')->withErrors($validator->messages());
        }

        try
        {
            $user = Sentry::register(array(
                'email'    => Input::get('email'),
                'username' => Input::get('username'),
                'password' => Input::get('password'),
            ));

            // Let's get the activation code
            $activationCode = $user->getActivationCode();

            // Find the group using the group id
            $users = Sentry::getGroupProvider()->findByName('Users');

            // Assign the group to the user
            $user->addGroup($users);

            $user->attemptActivation($activationCode);

            return Redirect::to('/');
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            echo 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            echo 'User with this login already exists.';
        }
        catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            echo 'Group was not found.';
        }

    }

}