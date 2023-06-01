<?php
namespace Sayedsoft\ExchangeToken\Exchange\Order;

use Illuminate\Support\Facades\DB;
use Sayedsoft\ExchangeToken\Models\ExchangeOrders;

trait Save {

    private function saveDB() {

        if (!$this->inited || !$this->validated ) {
            return $this->returnError('Order not inited or validated');
        }

        try {
            DB::beginTransaction();

            $order = new ExchangeOrders();

            $order->user_id = $this->getUser()->id;

            $order->pair_id = $this->getPair()->id;

            $order->price = $this->getPrice();

            $order->base_amount = $this->getBaseAmount();

            $order->quote_amount = $this->getQuoteAmount();

            $order->base_fee_amount = $this->getBaseFee()->fee;

            $order->quote_fee_amount = $this->getQuoteFee()->fee;

            $order->type = $this->getType();

            $order->save();


            DB::commit();

       } catch (\Throwable $th) {
            DB::rollBack();
            throw($th);
       }

    }


}