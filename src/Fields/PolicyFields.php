<?php

namespace Laraning\Surveyor\Fields;

use Laravel\Nova\Fields\Boolean;

class PolicyFields
{
    /**
     * Get the pivot fields for the relationship.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            Boolean::make('View Any', 'view_any'),
            Boolean::make('View', 'view'),
            Boolean::make('Create', 'create'),
            Boolean::make('Update', 'update'),
            Boolean::make('Delete', 'delete'),
            Boolean::make('Force Delete', 'force_delete'),
            Boolean::make('Restore', 'restore'),
        ];
    }
}
