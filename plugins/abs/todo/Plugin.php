<?php namespace Abs\ToDo;

use Abs\ToDo\FormWidgets\QuickNoteWidget;
use Backend;
use Backend\Models\User;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'ToDo',
            'description' => 'Заметки на дашбоард...',
            'author'      => 'Abs',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        User::extend(function($model) {
            $model->hasMany['notes'] = ['Abs\ToDo\Models\Note'];
//            $model->hasMany('notes' => [Note::class]);
        });
    }

    public function registerPermissions()
    {
        return [
            'abs.todo.some_permission' => [
                'tab'   => 'ToDo',
                'label' => 'Some permission'
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'todo' => [
                'label'       => 'ToDo',
                'url'         => Backend::url('abs/todo/notes'),
                'icon'        => 'icon-pencil',
                'permissions' => ['abs.todo.*'],
                'order'       => 500,
            ],
        ];
    }

    public function registerReportWidgets()
    {
        return [
            QuickNoteWidget::class => [
                'label'     => 'Быстрые заметки',
                'context'   => 'dashboard'
            ],
        ];
    }

    public function registerComponents()
    {
        return [];
    }
}
