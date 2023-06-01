<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use App\Helpers\AdvancedNumber;
use Sayedsoft\Dex\Fees\Models\FeeFace;

class FeeFaces extends Resource
{   
    public static $group = 'Other';


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = FeeFace::class;

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
            Text::make('Name','name')->rules('required','min:2','max:10'),

             Select::make('Type','type')->options([
                'none'=>'None',
                'fixed'=>'Fixed',
                'percent'=>'Percent',
            ])->displayUsingLabels()->rules('required'),

            AdvancedNumber::make('Fixed Amount','fixed_amount')->decimals(8)->thousandsSeparator('.')->rules('required'),
            AdvancedNumber::make('Percent Amount','percent_amount')->decimals(8)->thousandsSeparator('.')->rules('required'),

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
