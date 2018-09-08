<?php

namespace App\Nova\Surveyor;

use App\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Profile extends Resource
{
    public static $indexDefaultOrder = ['name' => 'asc'];
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Laraning\\Surveyor\\Models\\Profile';

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
        'id', 'name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $fields = [
            ID::make()->sortable()->onlyOnForms(),

            Text::make('Name', 'name')
                ->sortable()
                ->rules('required', 'string'),

            BelongsToMany::make('Users', 'users', \App\Nova\User::class)
                         ->sortable()
                         ->rules('required'),

            HasMany::make('Policies', 'policies', \App\Nova\Surveyor\ProfilePolicy::class),
        ];

        if (me()->hasProfile('super-admin')) {
            $adminFields = [
                BelongsTo::make('Roles', 'role', \Vyuldashev\NovaPermission\Role::class),
                BelongsTo::make('Permissions', 'permission', \Vyuldashev\NovaPermission\Permission::class)
            ];

            $fields = array_merge($fields, $adminFields);
        }

        return $fields;
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
