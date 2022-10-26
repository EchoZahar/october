<?php namespace Abs\Score;

use Abs\Score\Components\Index;
use Abs\Score\ReportWidgets\CountCategories;
use Backend;
use System\Classes\PluginBase;


class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'          => 'Score',
            'description'   => 'No description provided yet...',
            'author'        => 'Abs',
            'icon'          => 'icon-pencil'
        ];
    }

    public function register()
    {

    }

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
                'label'         => 'Магаз',
                'url'           => Backend::url('abs/score/categories'),
                'icon'          => 'icon-leaf',
                'permissions'   => ['abs.score.*'],
                'order'         => 500,

                'sideMenu' => [
                    'categories' => [
                        'label'         => 'Категории',
                        'icon'          => 'icon-copy',
                        'url'           => Backend::url('abs/score/categories'),
                        'permissions'   => ['abs.score.*'],
                    ],
                    'products' => [
                        'label'         => 'Товары',
                        'icon'          => 'icon-copy',
                        'url'           => Backend::url('abs/score/products'),
                        'permissions'   => ['abs.score.*'],
                    ],

                ],
            ]
        ];
    }

    public function registerReportWidgets()
    {
        return [
            CountCategories::class => [
                'label'     => 'кол-во категорий',
                'context'   => 'dashboard',
            ],
        ];
    }

    public function registerFilterWidgets()
    {

    }
}
