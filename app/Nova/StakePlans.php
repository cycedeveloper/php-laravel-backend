<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Sayedsoft\StakeToken\Models\StakesPlan as StakesPlanModel;
use App\Helpers\AdvancedNumber;

class StakePlans extends Resource
{   

    public static $group = 'Stake';
    
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = StakesPlanModel::class;

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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Name','name')->rules('required','min:2','max:30'),
            BelongsTo::make('Token','token',\App\Nova\Token::class),
            Select::make('Period Type','period_type')->options([
                'day'=>'Day',
                'month'=>'Month',
                'year'=>'Year'
            ])->displayUsingLabels()->rules('required'),

            Number::make('Period Interval','period_interval')->rules('required')->step(1)->min('1'),
           
            Select::make('Profit Period Type','profit_period_type')->options([
                'day'=>'Day',
                'month'=>'Month',
                'year'=>'Year'
            ])->displayUsingLabels()->rules('required'),

            AdvancedNumber::make('Percentile Profit','percentile_profit')->rules('required')->decimals(2),
            AdvancedNumber::make('Min Amount','min_amount')->rules('required')->decimals(8),
            AdvancedNumber::make('Max Amount','max_amount')->rules('required')->decimals(8),
            Boolean::make('Active','active'),



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
