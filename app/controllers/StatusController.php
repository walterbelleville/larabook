<?php

use Larabook\Core\CommandBus;
use Larabook\Forms\PublishStatusForm;
use Larabook\Statuses\PublishStatusCommand;
use Larabook\Statuses\StatusRepository;

class StatusController extends \BaseController {

    use CommandBus;

    protected $statusRepository;

    /*
     * @var PublishStatusForm
     */
    protected $publishStatusForm;

    /**
     * @param PublishStatusForm $publishStatusForm
     * @param StatusRepository $statusRepository
     */

    function __construct(PublishStatusForm $publishStatusForm, StatusRepository $statusRepository) {
        $this->publishStatusForm = $publishStatusForm;
        $this->statusRepository = $statusRepository;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index() {
        $statuses = $this->statusRepository->getAllForUser(Auth::user());

        return View::make('statuses.index', compact('statuses'));
    }

    /**
     * Save a new status
     *
     * @return Response
     */
    public function store() {

        $this->publishStatusForm->validate(Input::only('body'));

        $this->execute(
            new PublishStatusCommand(Input::get('body'), Auth::user()->id)
        );

        Flash::message('Your status has been updated!');

        return Redirect::refresh();
    }
}
