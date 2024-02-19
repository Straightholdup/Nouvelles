<?php

namespace App\Listeners;

use App\Events\NewsCreated;
use App\Mail\NewsCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewsCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewsCreated $event): void
    {
        $news = $event->news;
        Mail::to($event->news->author)->queue(new NewsCreatedMail($news));
    }
}
