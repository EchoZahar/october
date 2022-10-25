<?php namespace Abs\Score;

use Abs\Score\Components\Index;
use Abs\Score\Models\AdminNote;
use Abs\Score\ReportWidgets\CountCategories;
use Abs\Score\ReportWidgets\NotesDashboard;
use Backend;
use Backend\Models\User as BackUser;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Score',
            'description' => 'No description provided yet...',
            'author'      => 'Ovechkin Zakhar',
            'icon'        => 'icon-pencil'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {
        // Проверить расширяемость Eloquent, идея получать notes при каздом запросе.
        BackUser::extend(function ($model) {
            $model->hasMany['notes'] = [AdminNote::class];
        });
    }

    public function registerComponents()
    {
        return [
            Index::class => 'score',
        ];
    }

    public function registerPermissions()
    {
        return [
            'abs.score.some_permission' => [
                'tab'   => 'Score',
                'label' => 'Some permission'
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'score' => [
                'label'       => 'Магаз',
                'url'         => Backend::url('abs/score/categories'),
                'icon'        => 'icon-leaf',
                'permissions' => ['abs.score.*'],
                'order'       => 500,

                'sideMenu' => [
                    'categories' => [
                        'label' => 'Категории',
                        'icon' => 'icon-copy',
                        'url' => Backend::url('abs/score/categories'),
                        'permissions' => ['abs.score.*'],
                    ],
                    'products' => [
                        'label' => 'Товары',
                        'icon' => 'icon-copy',
                        'url' => Backend::url('abs/score/products'),
                        'permissions' => ['abs.score.*'],
                    ],
                ],
            ]
        ];
    }

    public function registerReportWidgets()
    {
        return [
            CountCategories::class => [
                'label' => 'кол-во категорий',
                'context' => 'dashboard',
            ],
        ];
    }
}
