<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo as FieldsBelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Sayedsoft\ExchangeToken\Models\ExchangePairs as ModelsExchangePairs;
use App\Helpers\AdvancedNumber;

class ExchangePairs extends Resource
{   

    public static $group = 'Exchange';
    
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ModelsExchangePairs::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Name','name')->rules('required','min:3','max:12'),
            FieldsBelongsTo::make('Base Token','BaseAsset','App\Nova\Token'),
            FieldsBelongsTo::make('Quote Token','quoteAsset','App\Nova\Token'),
            AdvancedNumber::make('Price','price')->decimals(8)->thousandsSeparator('.')->rules('required'),
            AdvancedNumber::make('Min Tradable','min_tradable')->decimals(8)->thousandsSeparator('.')->rules('required'),
            AdvancedNumber::make('Max Tradable','max_tradable')->decimals(8)->thousandsSeparator('.')->rules('required'),
            FieldsBelongsTo::make('Fee Face','feeFace','App\Nova\FeeFaces'),

            

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
