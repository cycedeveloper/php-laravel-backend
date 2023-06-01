<?php
namespace Sayedsoft\ExchangeToken\Controller;

use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Sayedsoft\Dex\Base\API\DexReponse;
use Sayedsoft\ExchangeToken\ExchangeToken;
use Sayedsoft\ExchangeToken\Models\ExchangeOrders;
use Sayedsoft\ExchangeToken\Requests\ExchangeValidateRequest;

class  ExchangeController {

    private function initOrder ($request) {


        $order = ExchangeToken::Order();
        $order->setType($request->type);
        $order->setPair($request->pair_id);
        $order->setUser(Auth::user()->id);
        if ($request->type == 'SELL') {
            $order->setQuoteAmount($request->qoute_amount);
        } else {
            $order->setBaseAmount($request->base_amount);
        }
        
        return $order;

    }

    public function validate (ExchangeValidateRequest $request) {
        
        $order = $this->initOrder($request);
        
        try {
            $order->validate();
        } catch (\Throwable $th) {
            return DexReponse::json($request,true,$th->getMessage());
        }


        return DexReponse::json($request,true,'order is validated',$order->preview());
    }

    public function save (ExchangeValidateRequest $request) {
        
        $order = $this->initOrder($request);
        
        try {
            $order->save();
        } catch (\Throwable $th) {
            return DexReponse::json($request,true,$th->getMessage(),[],422);
        }
        
        return DexReponse::json($request,true,'order is saved');
    }

    public function orderHistory (HttpRequest $request) {

        $orders = ExchangeOrders::where('user_id',Auth::user()->id)->orderBy('id','desc')->limit(10)->with('pair')->get();

         return DexReponse::json($request,true,'orders',$orders);
    }

}