<?php

namespace App\Nova\Actions;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Sayedsoft\DexAuthReferral\Listeners\LogVerifiedUser;
use Sayedsoft\ReferralUnilevel\Helpers\NewChild;
use Sayedsoft\ReferralUnilevel\Jobs\NewChildJob;

class EmailVerify extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {   

        foreach ($models as $model) {

            if ($model->hasVerifiedEmail()) {
                return Action::danger('Email already verified.');
            }
            try {
                $model->markEmailAsVerified();
                NewChild::new($model);
            } catch (Exception $th) {
                 return Action::danger($th->getMessage());
            }
        }
        //


        //

    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
