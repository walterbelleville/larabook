<?php namespace Larabook\Statuses;

use Laracasts\Presenter\Presenter;

class StatusPresenter extends Presenter {
/**
 * Display how long it has been since the publish date.
 *
 */

    public function timeSincePublished() {
        return $this->created_at->diffForHumans();
    }
}