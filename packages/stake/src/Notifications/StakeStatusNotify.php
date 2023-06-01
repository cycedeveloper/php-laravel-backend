<?php

namespace Sayedsoft\StakeToken\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Sayedsoft\StakeToken\Models\Stake;

class StakeStatusNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void 
     */
    protected $stake,$status;
    
    public function __construct(Stake $stake,$status)
    {
        //
        $this->stake = $stake;
        $this->status = $status;
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

     private function amountLabel() {
        return $this->stake->amount.''.$this->stake->plan->token->token_name.'.';
     }



    public function toMail($notifiable)
    {   
        $lable = $this->amountLabel();
        $text = '';
        switch ($this->status) {
            case 'confirmed':
                $text = 'We have accepted your stake request for: '.$lable;
                break;
            case 'canceled':
                $text = 'We have canceled your stake for. '.$lable;
                break;
            case 'denied':
                $text = 'We have denied your stake request for. '.$lable;
                break;
            case 'ended':
                $text = 'Your stake for. '.$lable.' has been done! your stake amount added to your balance.';
                break;
            default:
                # code...
                break;
        }

        return (new MailMessage)
                    ->subject($text)
                    ->line($text)
                    ->line("Stake details? ")
                    ->line("- Amount ".$this->amountLabel())
                    ->line("- Started date: ".$this->stake->stakeDetails->start_date)
                    ->line("- End date: ".$this->stake->stakeDetails->end_date);
       
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
            'stake' => $this->stake,
            'status' => $this->status,
        ];
    }
}
