<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Sayedsoft\Dex\Token\Models\Token as ModelsToken;
use App\Helpers\AdvancedNumber;
use App\Nova\Actions\Stake\Approve;
use App\Nova\Actions\Stake\Cancle;
use App\Nova\Actions\Stake\Confirm;
use App\Nova\Actions\Stake\Deny;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;

class Token extends Resource
{   

    public static $group = 'Exchange';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model =  ModelsToken::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'token_name';

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
            Text::make('Blockcian','blockchain'),
            Text::make('Token name','token_name'),
            Text::make('Token name','token_code'),
            Boolean::make('Has Deposit','payable'),
            Boolean::make('Has Withdraw','withdrawable'),
            Boolean::make('Disabled','disabled'),
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
