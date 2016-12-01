<?php

namespace EONConsulting\PHPStencil\src\Events;

/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/12/01
 * Time: 11:09 AM
 */
class Event implements \SplSubject {

    // Storage object to store the observer
    protected $storage;
    /**
     * Event constructor.
     */
    public function __construct() {
        $this->storage = new \SplObjectStorage();
    }
    /**
     * Attach an observer to the event.
     * @param \SplObserver $observer
     */
    public function attach(\SplObserver $observer) {
        // attach observer
        $this->storage->attach($observer);
    }
    /**
     * Detach the observer from the event.
     * @param \SplObserver $observer
     */
    public function detach(\SplObserver $observer) {
        // make sure the observer exists. If not, return.
        if(!$this->storage->contains($observer))
            return;
        // observer exists, go ahead and detach
        $this->storage->detach($observer);
    }
    /**
     *  Notify all observers for this method.
     */
    public function notify() {
        // if there are no observers, don't do anything. Just return.
        if(!count($this->storage)) {
            return;
        }
        // loop through storage and get each observer
        foreach($this->storage as $observer) {
            // update each observer
            $observer->update($this);
        }
    }

}