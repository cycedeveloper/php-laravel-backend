<?php

namespace App\Nova;

use App\Helpers\AdvancedNumber;
use App\Nova\Actions\Stake\Confirm;
use App\Nova\Actions\Stake\Deny;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Sayedsoft\StakeToken\Models\Stake as ModelsStake;

class Stake extends Resource
{
    public static $group = 'Stake';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ModelsStake::class;

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
        //    BelongsTo::make('Plan','plan','App\Nova\StakesPlans'),
            BelongsTo::make(__('User'), 'user','App\Nova\User')->sortable(),

            AdvancedNumber::make('Amount','amount')->decimals(8)->thousandsSeparator('.')->rules('required'),
            Boolean::make('Has Referral','has_referral'),
            Text::make('Start date','start_date')->onlyOnIndex(), 
            Text::make('End Date','end_date')->onlyOnIndex(),
            Text::make('Status','status_title')->onlyOnIndex(),
            DateTime::make('Created At','created_at')->onlyOnIndex(),
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
        return [
            (new Confirm),
            (new Deny),
        ];
    }


    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }
}
