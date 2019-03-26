<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class WhoDidIt
{
    private $user;

    public function __construct()
    {
        if (auth()->user()) {
            $this->user = auth()->user();
        }
    }

    public function creating(Model $model)
    {
        $model->created_by = $this->user->id;
    }

    public function updating(Model $model)
    {
        $model->updated_by = $this->user->id;
    }

    public function deleting(Model $model)
    {
        $model->deleted_by = $this->user->id;
        $model->save();
    }
}
