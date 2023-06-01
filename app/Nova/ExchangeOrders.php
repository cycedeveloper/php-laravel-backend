<?php

namespace App\Nova;

use App\Helpers\AdvancedNumber;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Sayedsoft\ExchangeToken\Models\ExchangeOrders as ModelsExchangeOrders;

class ExchangeOrders extends Resource
{   

    public static $group = 'Exchange';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ModelsExchangeOrders::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

     public static $searchRelations = [
        'user' => ['first_name', 'last_name','email'],
        'token' => ['token_code','token_name'],
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Side','type'),
            BelongsTo::make('User','user','App\Nova\User'),
            BelongsTo::make('Pair','pair','App\Nova\ExchangePairs'),
            AdvancedNumber::make("Price",'price')->decimals(8)->rules('required'),
            AdvancedNumber::make("Base amount",'base_amount')->decimals(8)->rules('required'),
            AdvancedNumber::make("Quote amount",'quote_amount')->decimals(8)->rules('required'),
            AdvancedNumber::make("Base fee",'base_fee_amount')->decimals(8)->rules('required'),
            AdvancedNumber::make("Quote fee",'quote_fee_amount')->decimals(8)->rules('required'),
            
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }
}
