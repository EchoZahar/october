<?php namespace Abs\Score;

use Abs\Score\Components\Index;
use Backend;
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
            'author'      => 'Abs',
            'icon'        => 'icon-leaf'
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
                    ]
                ],
            ]
        ];
    }
}
