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
     * @param  string $url
     *
     * @return void
     */
    public function notify($message, $userId, $url = '')
    {
        $this->notifRepository->insert($message, $userId, $url);
    }
}
