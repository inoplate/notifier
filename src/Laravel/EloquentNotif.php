<?php

namespace Inoplate\Notifier\Laravel;

use Ramsey\Uuid\Uuid;
use Inoplate\Notifier\NotifRepository;

class EloquentNotif implements NotifRepository
{
    /**
     * @var Notification
     */
    protected $model;

    /**
     * Create new EloquentNotif instance
     * @param Notification $model
     */
    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

    /**
     * Insert new notification
     * 
     * @param  string $message
     * @param  string $userId
     * @param  string $url
     * 
     * @return void
     */
    public function insert($message, $userId, $url = '')
    {
        $notification = $this->model->newInstance();
        $id = Uuid::uuid4();

        $notification->id = $id;
        $notification->message = $message;
        $notification->user_id = $userId;
        $notification->url = $url;

        $notification->save();
    }
}