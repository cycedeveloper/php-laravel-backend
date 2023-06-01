<?php

namespace App\Nova;

use App\Helpers\AdvancedNumber;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Sayedsoft\ExchangeToken\Models\ExchangeFeeFace as ModelsExchangeFeeFace;

class ExchangeFeeFace extends Resource
{   

    public static $group = 'Exchange';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ModelsExchangeFeeFace::class;

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
             Select::make('Base Type','base_type')->options([
                'none'=>'None',
                'fixed'=>'Fixed',
                'percent'=>'Percent',
            ])->displayUsingLabels()->rules('required'),

            AdvancedNumber::make('Base Fixed Amount','base_fixed_amount')->decimals(8)->thousandsSeparator('.')->rules('required'),
            AdvancedNumber::make('Base Percent Amount','base_percent_amount')->decimals(8)->thousandsSeparator('.')->rules('required'),
            Select::make('Quote Type','quote_type')->options([
                'none'=>'None',
                'fixed'=>'Fixed',
                'percent'=>'Percent',
            ])->displayUsingLabels()->rules('required'),    

            AdvancedNumber::make('Quote Base Fixed Amount','quote_base_fixed_amount')->decimals(8)->thousandsSeparator('.')->rules('required'),
            AdvancedNumber::make('Quote Base Percent Amount','quote_base_percent_amount')->decimals(8)->thousandsSeparator('.')->rules('required')
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
}
