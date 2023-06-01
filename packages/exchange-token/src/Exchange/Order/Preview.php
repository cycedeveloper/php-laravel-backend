<?php
namespace Sayedsoft\ExchangeToken\Exchange\Order;

use Illuminate\Support\Facades\DB;
use Sayedsoft\ExchangeToken\Models\ExchangeOrders;
use stdClass;

trait Preview {

    public function preview() {

        if (!$this->inited || !$this->validated ) {
            return $this->returnError('Order not inited or validated');
        }

        try {

            $order = new stdClass();

            $order->price = $this->getPrice();

            $order->base_amount = $this->getBaseAmount();

            $order->quote_amount = $this->getQuoteAmount();

            $order->base_fee_amount = $this->getBaseFee()->fee;

            $order->quote_fee_amount = $this->getQuoteFee()->fee;

            $order->pair = $this->getPair();

            $order->type = $this->getType();

            return $order;

       } catch (\Throwable $th) {
            DB::rollBack();
            throw($th);
       }

    }


}