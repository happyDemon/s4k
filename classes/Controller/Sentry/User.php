<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Sentry_User extends Controller_Sentry_Base {

	public function action_register() {
		$content = '';
		$ignore_form = false;
		$form_values = array('email' => '', 'password' => '', 'first_name' => '', 'last_name' => '');

		if($this->request->post() != null) {
			$form_values = array_merge($form_values, $this->request->post());

			try
			{
				// Let's register a user.
				$user = Sentry::register($form_values);

				// Let's get the activation code
				$activationCode = $user->getActivationCode();

				$content .= 'Your activation code is: ' . $activationCode;
				//@todo Send activation code to the user so he can activate the account
				$ignore_form = true;
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('orm');

				foreach($errors as $error)
				{
					$content .= '<div class="alert alert-error">'.$error.'<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
				}
			}
		}

		if(!$ignore_form)
			$content .= View::factory('sentry/register', $form_values);

		$this->_tpl->content = $content;
		$this->response->body($this->_tpl->render());
	}

	public function action_activate() {
		$content = '';
		$ignore_form = false;

		if($this->request->post() != null) {
			try {
				$user = Sentry::getUserProvider()->findByCredentials(array('email' => $this->request->post('email')));

				// Attempt to activate the user
				if ($user->attemptActivation($this->request->post('activation_code')))
				{
					// User activation passed
					$ignore_form = true;
					$content .= '<div class="alert alert-success">Your account has been activated. <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
				}
				else
				{
					// User activation failed
					$content .= '<div class="alert alert-error">You seem to have entered the wrong activation code.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
				}
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				$content .= '<div class="alert alert-error">There\'s no record of the user you want to activate.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';

			}
			catch (Cartalyst\SEntry\Users\UserAlreadyActivatedException $e)
			{
				$content .= '<div class="alert alert-error">This user is already activated.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
			}
		}

		if(!$ignore_form)
			$content .= View::factory('sentry/activate');

		$this->_tpl->content = $content;
		$this->response->body($this->_tpl->render());
	}

	public function action_login() {
		$ignore_form = false;
		$content = '';
		$view = array('throttle' => '');

		if($this->request->post() != null) {
			try
			{
				$throttle_provider = Sentry::getThrottleProvider();

				if(Kohana::$config->load('sentry.throttle') == true) {
					$throttle_provider->enable();

					$throttle = $throttle_provider->findByUserLogin($this->request->post('email'));
					$throttle->setAttemptLimit(Kohana::$config->load('sentry.throttle_attempts'));
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

				if($throttle_provider->isEnabled())
					$throttle->clearLoginAttempts();

				$ignore_form = true;
				$content .= '<div class="alert alert-success">Welcome back! <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
			}
			catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
			{
				$content .= '<div class="alert alert-error">You seem to have have provided an incorrect password.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';

				if($throttle_provider->isEnabled()) {
					$throttle->addLoginAttempt();

					$view['throttle'] = $throttle->getLoginAttempts().'/'.$throttle->getAttemptLimit().' attempts left.';
				}
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				$content .= '<div class="alert alert-error">There\'s no user with that login.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
			}
			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
				$content .= '<div class="alert alert-error">We need to know who\'s logging in.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
				$content .= '<div class="alert alert-error">Your account hasn\'t been activated yet.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
			}
			catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
			{
				$time = $throttle->getSuspensionTime();

				$content .= '<div class="alert alert-error">You have tried logging in too much, wait '.$time.' minutes before trying again.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
			}
			catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
			{
				$content .= '<div class="alert alert-error">You are banned.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
			}
		}

		if(!$ignore_form)
			$content .= View::factory('sentry/login', $view);

		$this->_tpl->content = $content;
		$this->response->body($this->_tpl->render());
	}

	public function action_reset() {
		$ignore_form = false;
		$content = '';

		if($this->request->post() != null) {
			try
			{
				// Find the user using the user email address
				$user = Sentry::getUserProvider()->findByLogin($this->request->post('email'));

				// Get the password reset code
				$resetCode = $user->getResetPasswordCode();

				$content .= '<div class="alert alert-success">Your reset token is: "'.$resetCode.'" <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
				$ignore_form = true;

				// @todo Now you can send this code to your user via email for example.
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				$content .= '<div class="alert alert-error">There\'s no user with that login credential.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
			}
		}

		if(!$ignore_form)
			$content .= View::factory('sentry/reset');

		$this->_tpl->content = $content;
		$this->response->body($this->_tpl->render());
	}

	public function action_reset_valid() {
		$ignore_form = false;
		$content = '';

		if($this->request->post() != null) {
			try
			{
				// Find the user using the user id
				$user = Sentry::getUserProvider()->findByCredentials(array(
					'email' => $this->request->post('email')
				));

				if($this->request->post('password') == '')
					$content .= '<div class="alert alert-error">Please provide a password.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
				// Check if the reset password code is valid
				else if ($user->checkResetPasswordCode($this->request->post('code')))
				{
					// Attempt to reset the user password
					if ($user->attemptResetPassword($this->request->post('code'), $this->request->post('password')))
					{
						// Password reset passed
						$content .= '<div class="alert alert-success">You have successfully reset your password <a href="#" class="close" data-dismiss="alert">&times;</a></div>';
						$ignore_form = true;
					}
					else
					{
						$content .= '<div class="alert alert-error">Resetting your password has failed.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
					}
				}
				else
				{
					// The provided password reset code is Invalid
					$content .= '<div class="alert alert-error">The provided reset code is invalid.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';

				}
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				$content .= '<div class="alert alert-error">There\'s no user with that login credential.<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
			}
		}

		if(!$ignore_form)
			$content .= View::factory('sentry/reset_validate');

		$this->_tpl->content = $content;
		$this->response->body($this->_tpl->render());
	}

} // End Sentry_User
