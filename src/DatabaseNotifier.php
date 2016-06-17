<?php

namespace Inoplate\Notifier;

class DatabaseNotifier implements Notifier
{
    /**
     * @var NotifRepository
     */
    protected $notifRepository;

    /**
     * Create new DatabaseNotifier instance
     * 
     * @param NotifRepository $notifRepository
     */
    public function __construct(NotifRepository $notifRepository)
    {
        $this->notifRepository = $notifRepository;
    }

    /**
     * Notify user
     * 
     * @param  string $message
     * @param  string $userId
     * @return void
     */
    public function notify($message, $userId)
    {
        $this->notifRepository->insert($message, $userId);
    }
}