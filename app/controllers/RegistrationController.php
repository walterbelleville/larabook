<?php

use Larabook\Forms\RegistrationForm;
use Larabook\Registration\RegisterUserCommand;
use Larabook\Core\CommandBus;

class RegistrationController extends BaseController {

    use CommandBus;

    /*
     * @var RegistrationForm
     */
    private $registrationForm;

    /*
     * Constructor
     * @param CommandBus $commandBus
     * @param RegistrationForm $registrationForm
     */

    public function __construct(RegistrationForm $registrationForm)
        {
            $this->registrationForm = $registrationForm;

            $this->beforeFilter('guest');
        }

	/**
	 * Show the form to register the user
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('registration.create');
	}


    /*
     * Create a new Larabook user
     * @return string
     */
    public function store() {

        $this->registrationForm->validate( Input::all() );

        extract(Input::only('username', 'email', 'password'));

        $user = $this->execute(
            new RegisterUserCommand($username, $email, $password)
        );

        Auth::login($user);

        Flash::overlay('Glad to have you as a new Larabook member!');

        return Redirect::home();
    }
}
