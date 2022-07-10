<?php

namespace App\Traits\Eloquent;

use Illuminate\Support\Str;

trait HasSearch
{
    public function scopeSearch($q)
    {
        if (empty(request()->search)) return;

        $q->where(function ($q) {
            foreach (request()->fields as $field) {
                if (method_exists($this, $field)) {

                } else {
                    $q->orWhere($field, 'like', '%' . request()->search . '%');
                }
            }
        });
    }

    public function scopeLists($q)
    {
        $q->search()
            ->latest();
    }
}
