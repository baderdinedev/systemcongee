<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $leave;

    public function __construct($leave)
    {
        $this->leave = $leave;
    }

    public function toDatabase($notifiable)
    {
        return [
            'leave_id' => $this->leave->id,
            'start_date' => $this->leave->start_date,
            'end_date' => $this->leave->end_date,
            'reason' => $this->leave->reason,
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('A new leave request has been submitted.')
            ->action('View Leave Request', url('/leave-requests'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'A new leave request has been submitted.',
            'action_url' => url('/leave-requests'),
        ];
    }
}
