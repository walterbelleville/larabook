<?php namespace Larabook\Handlers;


use Larabook\Mailers\UserMailer;
use Larabook\Registration\Events\UserRegistered;
use Laracasts\Commander\Events\EventListener;

class EmailNotifier extends EventListener {

    /**
     * @var UserMailer
     */
    private $mailer;

    /**
     * @param UserMailer $mailer
     */
    public function __construct(UserMailer $mailer) {
        $this->mailer = $mailer;
    }

    /**
     * @param UserRegistered $event
     */
    public function whenUserRegistered(UserRegistered $event) {
        $this->mailer->sendWelcomeMessageTo($event->user);

    }
} 