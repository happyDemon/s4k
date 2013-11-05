<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Controller_S4K_User extends Controller_S4K_Base {

	// Show the registration form
	public function action_register($form_values = array('email' => '', 'password' => '', 'first_name' => '', 'last_name' => '')) {
		$this->_tpl->content = View::factory('s4k/user/register', $form_values);
	}
	
	// Try to register the user
	public function action_register_complete() {
		$form_values = array('email' => '', 'password' => '', 'first_name' => '', 'last_name' => '');

		if($this->request->post() != null) {
			try
			{
				// Let's register a user.
				$user = Sentry::register(array_merge($form_values, $this->request->post()));

				// Let's get the activation code
				$activationCode = $user->getActivationCode();

				Hint::set(Hint::SUCCESS, 'Your activation code is: ' . $activationCode);

				//everything went successful, send the user somewhere else
				$this->redirect(Route::url('S4K.users.register', null, true));
				//@todo normally you wouldn't redirect back to the register
				//@todo Send activation code to the user so he can activate the account

			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('orm');

				//make hints out of the errors
				foreach($errors as $error)
				{
					Hint::set(Hint::ERROR, $error);
				}

				//redisplay the register form
				$this->_tpl->hints = Hint::render(null, true, 's4k/hint');
				$this->action_register($this->request->post());
			}
		}
		else // no post request made, send back
			$this->redirect(Route::url('S4K.users.register', null, true));
	}

	// Show the user activation form
	public function action_activate() {
		$this->_tpl->content = View::factory('s4k/user/activate');
	}

	// Try to activate the user
	public function action_activate_complete() {
		if($this->request->post() != null) {
			try {
				$user = Sentry::getUserProvider()->findByCredentials(array('email' => $this->request->post('email')));

				// Attempt to activate the user
				if ($user->attemptActivation($this->request->post('activation_code')))
				{
					// User activation passed
					Hint::set(Hint::SUCCESS, 'Your account has been activated.');

					//everything went successful, send the user somewhere else
					$this->redirect(Route::url('S4K.users.activate', null, true));
					//@todo you'd preferably send the user to a welcome page instead of the activate page again
				}
				else
				{
					// User activation failed
					Hint::set(Hint::ERROR, 'You seem to have entered the wrong activation code.');
				}
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				Hint::set(Hint::ERROR, 'There\'s no record of the user you want to activate.');

			}
			catch (Cartalyst\SEntry\Users\UserAlreadyActivatedException $e)
			{
				Hint::set(Hint::ERROR, 'This user is already activated.');
			}

			//No success activating this user, show the form again with the errors
			$this->_tpl->hints = Hint::render(null, true, 's4k/hint');
			$this->action_activate();
		}
		else // no post request made, send back
			$this->redirect(Route::url('S4K.users.register', null, true));
	}

	// Show the login form
	public function action_login($view = array('throttle' => '')) {
		$this->_tpl->content = View::factory('s4k/user/login', $view);
	}

	// Try to log a user in
	public function action_login_complete($view = array('throttle' => '')) {
		if($this->request->post() != null) {
			$view = array('throttle' => '');

			try
			{
				$throttle_provider = Sentry::getThrottleProvider();

				//if the login throttler is enabled set it up
				if(Kohana::$config->load('sentry.throttle') == true) {
					$throttle_provider->enable();

					$throttle = $throttle_provider->findByUserLogin($this->request->post('email'));

					//set the limit of consecutive failed login attempts
					$throttle->setAttemptLimit(Kohana::$config->load('sentry.throttle_attempts'));

					//set the suspension time in minutes
					$throttle->setSuspensionTime(Kohana::$config->load('sentry.throttle_suspension_time'));
				}
				else
					$throttle_provider->disable();

				$user = Sentry::getUserProvider()->findByCredentials(array(
					'email'      => $this->request->post('email'),
					'password'   => $this->request->post('password')
				));

				// Log the user in
				if($this->request->post('remember', false)) {
					Sentry::loginAndRemember($user);
				}
				else {
					Sentry::login($user, false);
				}

				//if the login throttler is enabled clear failed login attempts
				if($throttle_provider->isEnabled())
					$throttle->clearLoginAttempts();

				Hint::set(Hint::SUCCESS, 'Welcome back!');
				//everything went successful, send the user somewhere else
				$this->redirect(Route::url('S4K.users.login', null, true));
				//@todo you'll probably rather send your user to a welcome page than back to the login
			}
			catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
			{
				Hint::set(Hint::ERROR, 'You seem to have have provided an incorrect password.');

				//if throttles are enabled add an attempt and show how many attempts are left
				if($throttle_provider->isEnabled()) {
					$throttle->addLoginAttempt();

					$view['throttle'] = $throttle->getLoginAttempts().'/'.$throttle->getAttemptLimit().' attempts left.';
				}
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				Hint::set(Hint::ERROR, 'There\'s no user with that login.');
			}
			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
				Hint::set(Hint::ERROR, 'We need to know who\'s logging in.');
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
				Hint::set(Hint::ERROR, 'Your account hasn\'t been activated yet.');
			}
			catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
			{
				$time = $throttle->getSuspensionTime();

				Hint::set(Hint::ERROR, 'You have tried logging in too much, wait '.$time.' minutes before trying again.');
			}
			catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
			{
				Hint::set(Hint::ERROR, 'You are banned.');
			}

			//No success signing in, show the form again with the errors
			$this->_tpl->hints = Hint::render(null, true, 's4k/hint');
			$this->action_login($view);
		}
		else // no post request made, send back
			$this->redirect(Route::url('S4K.users.login', null, true));
	}

	// Show the reset password form
	public function action_reset() {
		$this->_tpl->content = View::factory('s4k/user/reset');
	}

	// Generate a reset token
	public function action_reset_complete() {
		if($this->request->post() != null) {
			try
			{
				// Find the user using the user email address
				$user = Sentry::getUserProvider()->findByLogin($this->request->post('email'));

				// Get the password reset code
				$resetCode = $user->getResetPasswordCode();

				Hint::set(Hint::SUCCESS, 'Your reset token is: "'.$resetCode);

				//everything went successful, send the user somewhere else
				$this->redirect(Route::url('S4K.users.reset', null, true));
				// @todo normally you wouldn't redirect here, but rather show a page conforming the code was sent
				// @todo Now you can send this code to your user via email for example.
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				Hint::set(Hint::ERROR, 'There\'s no user with that login credential.');
			}

			//No success trying to request a reset password token, show the form again with the errors
			$this->_tpl->hints = Hint::render(null, true, 's4k/hint');
			$this->action_reset();
		}
		else // no post request made, send back
			$this->redirect(Route::url('S4K.users.reset', null, true));
	}

	// Show the reset code validation form
	public function action_reset_valid() {
		$this->_tpl->content = View::factory('s4k/user/reset_validate');
	}

	// Try to reset a user's password
	public function action_reset_valid_complete() {
		if($this->request->post() != null) {
			try
			{
				// Find the user using the user id
				$user = Sentry::getUserProvider()->findByCredentials(array(
					'email' => $this->request->post('email')
				));

				if($this->request->post('password') == '')
					Hint::set(Hint::ERROR, 'Please provide a password.');
				// Check if the reset password code is valid
				else if ($user->checkResetPasswordCode($this->request->post('code')))
				{
					// Attempt to reset the user password
					if ($user->attemptResetPassword($this->request->post('code'), $this->request->post('password')))
					{
						// Password reset passed
						Hint::set(Hint::SUCCESS, 'You have successfully reset your password');

						//everything went successful, send the user somewhere else
						$this->redirect(Route::url('S4K.users.reset_valid', null, true));
					}
					else
					{
						Hint::set(Hint::ERROR, 'Resetting your password has failed.');
					}
				}
				else
				{
					// The provided password reset code is Invalid
					Hint::set(Hint::ERROR, 'The provided reset code is invalid.');
				}
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				Hint::set(Hint::ERROR, 'There\'s no user with that login credential.');
			}

			// Resetting the password failed, show the form with the errors
			$this->redirect(Route::url('S4K.users.reset_valid', null, true));
			$this->action_reset_valid();
		}
		else // no post request made, send back
			$this->redirect(Route::url('S4K.users.reset_valid', null, true));
	}

} // End Sentry_User
