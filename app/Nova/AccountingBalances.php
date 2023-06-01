<?php

namespace App\Nova;

use App\Helpers\AdvancedNumber;
use App\Nova\Actions\RefreshBalance;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Sayedsoft\Dex\Accounting\Models\AccountingBalance as AccountingBalanceModel;
use Titasgailius\SearchRelations\SearchesRelations;

class AccountingBalances extends Resource
{   


    public static $group = 'Accouting';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = AccountingBalanceModel::class;

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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('User','user','App\Nova\User'),
            BelongsTo::make('Token','token','App\Nova\Token'),
            AdvancedNumber::make("Depts",'depts')->decimals(8)->rules('required'),
            AdvancedNumber::make("Incomes",'incomes')->decimals(8)->rules('required'),
            AdvancedNumber::make("Outgoings",'outgoings')->decimals(8)->rules('required'),
            AdvancedNumber::make("Invoices",'invoices')->decimals(8)->rules('required'),
            AdvancedNumber::make("Balance",'balance')->decimals(8)->rules('required'),
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
        return [
            
        ];
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
             (new RefreshBalance),
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

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }
}
