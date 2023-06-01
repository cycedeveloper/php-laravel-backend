<?php

namespace Sayedsoft\StakeToken\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Sayedsoft\Dex\Base\Jobs\TelegramJob;

class StakeCreatedNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void 
     */
    protected $stake;
    
    public function __construct($stake)
    {
        //
        $this->stake = $stake;

        $message = 'Yeni Stake isteği var: '.$stake->amount.' '.$stake->user->email;

        // Send To Telegram
        TelegramJob::dispatch($message); 

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {   
       
        $text = 'We have received your stake request '.$this->stake->amount.''.$this->stake->plan->token->token_name.'.';
        return (new MailMessage)
                    ->subject($text)
                    ->line($text)
                    ->line("What's next?")
                    ->line("- Wait confirmtion by admin in 24 hours.")
                    ->line("- Or cancel request from dashboard.")
                    ->line('Thank you for choosing us.');
    }
    
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'stake' => $this->stake
        ];
    }
}
