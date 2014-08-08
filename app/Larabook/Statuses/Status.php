<?php namespace Larabook\Statuses;

use Laracasts\Commander\Events\EventGenerator;
use Larabook\Statuses\Events\StatusWasPublished;

class Status extends \Eloquent {

    use EventGenerator;

    /**
     * Fillable fields for a new status
     * @var array
     */
    protected $fillable = ['body'];

    public function user() {
        return $this->belongsTo('Larabook\Users\User');
    }

    /**
     * Publish a new status
     *
     * @param $body
     * @return static
     */
    public static function publish($body) {
        $status = new static(compact('body'));

        $status->raise(new StatusWasPublished($body));

        return $status;
    }

}