<?php

namespace App\Observers;
use App\Models\UsersLogs;
class UserActionsObserver
{

    public function saved($model)
    {
        if ($model->wasRecentlyCreated == true) {
            // Data was just created
            $action = 'created';
        } else {
            // Data was updated
            $action = 'updated';
        }
        if (\Auth::check()) {
            UsersLogs::create([
                'user_id'      => \Auth::id(),
                'action'       => $action,
                'action_model' => $model->getTable(),
                'action_id'    => $model->id
            ]);
        }
    }

    public function deleting($model)
    {
        if (\Auth::check()) {
            UsersLogs::create([
                'user_id'      => \Auth::id(),
                'action'       => 'deleted',
                'action_model' => $model->getTable(),
                'action_id'    => $model->id
            ]);
        }
    }
}