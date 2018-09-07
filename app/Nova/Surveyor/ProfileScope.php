<?php

namespace App\Nova\Surveyor;

use App\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Laraning\Boost\Rules\ClassExists;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProfileScope extends Resource
{
    public static function label()
    {
        return 'Profile Scopes';
    }

    public static function singularLabel()
    {
        return 'Profile Scope';
    }

    public static $model = 'Laraning\\Surveyor\\Models\\ProfileScope';

    public static $title = 'scope';

    public static $search = [
        'id'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable()->onlyOnForms(),

            BelongsTo::make('Profile', 'profile', \App\Nova\Surveyor\Profile::class)
                     ->rules('required'),

            Text::make('Model class namespace', 'model')
                ->help('Full qualified model class name')
                ->rules('required', new ClassExists),

            Text::make('Model class namespace', 'scope')
                ->help('Full qualified scope class name')
                ->rules('required', new ClassExists),
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
