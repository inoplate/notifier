<?php

namespace Inoplate\Notifier;

interface Notifier
{
    /**
     * Notify user
     * 
     * @param  string $message
     * @param  string $userId
     * @return void
     */
    public function notify($message, $userId);
}