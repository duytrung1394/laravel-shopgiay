<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
// implements ShouldQueue
class checkoutNoti extends Notification implements ShouldQueue
{
    use Queueable;
    protected $bill;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($bill)
    {
        $this->bill = $bill;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'billCreatedTime' => Carbon::now(),
            'billDetail' => $this->bill
        ];
    }
   
}
