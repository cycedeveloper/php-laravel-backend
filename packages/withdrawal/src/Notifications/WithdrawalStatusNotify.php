<?php
namespace Sayedsoft\DexWithdrawal\Notifications;



use App\Helpers\Stakes\StakeDateHelper;
use App\Jobs\TelegramJob;
use App\Models\Stake\Stake;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Sayedsoft\DexWithdrawal\Models\Withdrawal;

class WithdrawalStatusNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void 
     */
    protected $withdraw,$status;
    
    public function __construct(Withdrawal $withdraw,$status)
    {
        //
        $this->withdraw = $withdraw;
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
        return $this->withdraw->amount.''.$this->withdraw->token->token_name.'.';
     }



    public function toMail($notifiable)
    {   
        $lable = $this->amountLabel();
        $text = '';
        switch ($this->status) {
            case 'confirmed':
                $text = 'We have accepted your withdraw request for: '.$lable;
                break;
            case 'denied':
                $text = 'We have denied your withdraw request for. '.$lable;
                break;
            case 'canceled':
                $text = 'You have canceled your withdraw request for. '.$lable;
                break;
            default:
                # code...
                break;
        }
        

        $msg = (new MailMessage)
                    ->subject($text)
                    ->line($text)
                    ->line("withdraw details? ")
                    ->line("- Amount ".$this->amountLabel());

        if ($this->withdraw->admin_not) {
            $msg->line('Admin not: ');
            $msg->line($this->withdraw->admin_not);
        }
        
        return $msg;

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
            'withdraw' => $this->withdraw,
            'status' => $this->status,
        ];
    }
}
