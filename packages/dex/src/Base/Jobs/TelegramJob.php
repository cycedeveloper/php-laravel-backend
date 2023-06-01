<?php
namespace Sayedsoft\Dex\Base\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class TelegramJob implements ShouldQueue
{   
  
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message)
    {
      $this->message = $message;
    }

    public function sendMessage($chatID, $messaggio, $token) {
      $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
      $url = $url . "&text=" . urlencode($messaggio);
      $ch = curl_init();
      $optArray = array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true
      );
      curl_setopt_array($ch, $optArray);
      $result = curl_exec($ch);
      curl_close($ch);
      return $result;
    }


    public function handle()
    {
      $token = '5429214276:AAGJ0iesK60eIq_v6Oyl7Js-LILbxPlKPuk';
      $this->sendMessage('-702093883',$this->message,$token);
    }
}
