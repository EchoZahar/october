<?php namespace Abs\Score\Components;

use Abs\Score\Models\Category;
use Abs\Score\Models\Product;
use Cms\Classes\ComponentBase;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

/**
 * Index Component
 */
class Index extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Index Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        if ($this->page->id === 'index') {
            $this->page['slider'] = Category::where('is_published', 1)->whereNull('parent_id')->with('preview')->get();
        }
        elseif ($this->page->id === 'category') {
            $this->page['category'] = Category::with('products')->where('slug', $this->param('category'))->first();
            $this->page['products'] = $this->page['category']->products->where('is_published', 1)->paginate(10);

            if (!$this->page['category']) {
                return Response::make($this->controller->run('404'), 404);
            }
        }
        elseif ($this->page->id === 'product') {
            $this->page['product'] = Product::where('slug', $this->param('product'))->firstOrFail();
            $this->page['similarProducts'] = $this->findSimilarProducts($this->page['product']->name, $this->page['product']->id);
        }
    }

    public function findSimilarProducts($value, $current_product_id)
    {
        $string =  Str::words($value, 1, '');
        return Product::where('name', 'like', '%' . $string . '%')->whereNotIn('id', [$current_product_id]  )->limit(5)->get();
    }
}
