<?php
namespace Sayedsoft\Dex\WalletDeposit\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Sayedsoft\Dex\Base\Jobs\TelegramJob;

class WalletDepositRecived extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void  
     */
    protected $deposit;
    
    public function __construct($deposit)
    {
        //
        $this->deposit = $deposit;
        
        $message = 'Yeni Ödeme Var: '.$deposit->amount.' '.$deposit->token->symbol.' '.$deposit->user->email;
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
                    ->subject('We have received your payment '.$this->deposit->amount.' '.$this->deposit->token->token_name)
                    ->line('We have received your deposit.')
                    ->line($this->deposit->wallet->address)
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
            'deposit' => $this->deposit
        ];
    }
}
