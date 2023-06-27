<?php
namespace Sayedsoft\DexwithdrawalFiat\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Sayedsoft\Dex\Base\Jobs\TelegramJob;

class withdrawalFiatRequestRecived extends Notification
{
    use Queueable;

    

    /**
     * Create a new notification instance.
     *
     * @return void  
     */
    protected $withdraw;
    
    public function __construct($withdraw)
    {
        //
        $this->withdraw = $withdraw;
        
        $message = 'Yeni Çekim iseği Var: '.$withdraw->amount.' '.$withdraw->token->symbol.' '.$withdraw->user->email;
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
       
        return (new MailMessage)
                    ->subject('We have received your withdrawal Fiat request '.$this->withdraw->amount.' '.$this->withdraw->token->token_name)
                    ->line('We have received your withdrawal Fiat request')
                    ->line('Amount :' . $this->withdraw->amount.' '.$this->withdraw->token->token_name)
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
            'withdraw' => $this->withdraw
        ];
    }
}