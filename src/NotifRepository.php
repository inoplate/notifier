<?php

namespace Inoplate\Notifier;

interface NotifRepository
{
    /**
     * Insert new notification
     * 
     * @param  string $message
     * @param  string $userId
     * @param  string $url
     * 
     * @return void
     */
    public function insert($message, $userId, $url = '');
}