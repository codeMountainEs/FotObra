<?php

namespace App\Models\Traits;

trait Multitenantable
{
    protected static function bootMultitenantable(): void
    {
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
//        dd(auth()->user()->role_id);

        if (auth()->user()->role_id ===3 ) {
            static::addGlobalScope('created_by_user_id', function (\Illuminate\Database\Eloquent\Builder $builder) {
                $builder->where('user_id', auth()->id());

            });
        }
    }


}
