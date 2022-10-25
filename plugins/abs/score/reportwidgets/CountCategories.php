<?php namespace Abs\Score\ReportWidgets;

use Abs\Score\Models\Category;
use Abs\Score\Models\Product;
use Backend\Classes\ReportWidgetBase;
use Exception;

/**
 * CountCategories Report Widget
 */
class CountCategories extends ReportWidgetBase
{
    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'CountCategoriesReportWidget';

    /**
     * defineProperties for the widget
     */
    public function defineProperties()
    {
        return [
            'title' => [
                'title' => 'backend::lang.dashboard.widget_title_label',
                'default' => 'Count Categories Report Widget',
                'type' => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error',
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $catCount   = Category::where('is_published', 1)->count();
        $prodCount  = Product::where('is_published', 1)->count();

        return $this->makePartial('countcategories', ['catCount' => $catCount, 'prodCount' => $prodCount]);
    }

    /**
     * Prepares the report widget view data
     */
    public function prepareVars()
    {
    }

    /**
     * @inheritDoc
     */
    protected function loadAssets()
    {
    }
}
