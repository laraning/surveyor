<?php

namespace App\Nova\Surveyor;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laraning\Cheetah\Abstracts\CheetahResource;

class Profile extends CheetahResource
{
    public static $indexDefaultOrder = ['name' => 'asc'];
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Laraning\\Surveyor\\Models\\ProfilePolicy';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id'
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
            ID::make()->sortable()->onlyOnForms(),
            Boolean::make('Before', 'before'),
            Boolean::make('View Any', 'view_any'),
            Boolean::make('View', 'view'),
            Boolean::make('Create', 'create'),
            Boolean::make('Update', 'update'),
            Boolean::make('Delete', 'delete'),
            Boolean::make('Force Delete', 'force_delete'),
            BelongsTo::make(cheetah_trans('fields.profile'), 'profile', \App\Nova\Surveyor\Profile::class),
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
