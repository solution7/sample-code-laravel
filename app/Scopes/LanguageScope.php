<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Language;
use App\Models\CountrySetting;

class LanguageScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $lang = app('Illuminate\Http\Request')->header('Language');

        if (!$lang) {
            $lang_id = CountrySetting::getOne('DEFAULT_LANGUAGE_ID');
        } else {
            $lang_id = Language::getLangIDByCode($lang);
        }

        $builder->where('language_id', '=', $lang_id);
    }
}
