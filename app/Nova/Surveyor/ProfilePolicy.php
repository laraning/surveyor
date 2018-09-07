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

class ProfilePolicy extends Resource
{
    public static function label()
    {
        return 'Profile Policies';
    }

    public static function singularLabel()
    {
        return 'Profile Policy';
    }

    public static $model = 'Laraning\\Surveyor\\Models\\ProfilePolicy';

    public static $title = 'name';

    public static $search = [
        'id', 'name'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable()->onlyOnForms(),

            Text::make('Policy class namespace', 'policy')
                ->help('Full qualified class name')
                ->rules('required', new ClassExists),

            BelongsTo::make('Profile', 'profile', \App\Nova\Surveyor\Profile::class)
                     ->rules('required'),

            Boolean::make('Before', 'before'),
            Boolean::make('View Any', 'view_any'),
            Boolean::make('View', 'view'),
            Boolean::make('Create', 'create'),
            Boolean::make('Update', 'update'),
            Boolean::make('Delete', 'delete'),
            Boolean::make('Force Delete', 'force_delete'),
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
