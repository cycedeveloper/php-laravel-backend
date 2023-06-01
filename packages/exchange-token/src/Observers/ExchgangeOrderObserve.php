<?php
namespace Sayedsoft\ExchangeToken\Observers;

use Sayedsoft\ExchangeToken\Models\ExchangeOrders;

class ExchgangeOrderObserve
{

    public function created(ExchangeOrders $order)
    {   
         $order->refreshTotal();
        // Send notification
         
    }

    public function updated(ExchangeOrders $order)
    {
        //
        $order->refreshTotal();
    }


    public function deleted(ExchangeOrders $order)
    {
        //
        $order->refreshTotal();
    }

    public function restored(ExchangeOrders $order)
    {
        //
        $order->refreshTotal();
    }
    

    public function forceDeleted(ExchangeOrders $order)
    {
        //
        $order->refreshTotal();
    }
}
