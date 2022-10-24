<?php namespace Abs\Score\Models;

use Model;
use October\Rain\Database\Builder;
use October\Rain\Database\Traits\Sluggable;
use October\Rain\Database\Traits\Validation;
use System\Models\File;

/**
 * Product Model
 */
class Product extends Model
{
    use Validation, Sluggable;

    /**
     * @var string table associated with the model
     */
    public $table = 'abs_score_products';

    public $slugs = ['slug' => 'name'];

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = [];

    /**
     * @var array rules for validation
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array jsonable attribute names that are json encoded and decoded from the database
     */
    protected $jsonable = [];

    /**
     * @var array appends attributes to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array hidden attributes removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array dates attributes that should be mutated to dates
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $belongsToMany = [
        'categories' => [Category::class, 'table' => 'abs_score_category_product'],
    ];

    public $attachMany = [
        'product_images' => [File::class],
    ];

    public function scopeFilterCategories(Builder $query, $value)
    {
        return $query->whereHas('categories', function ($q) use ($value) {
            $q->whereIn('category_id', $value);
        });
    }

    public function scopeFilterByDate(Builder $query, $between)
    {

    }

//    public function beforeSave()
//    {
//        $length = strlen($this->price);
//        trace_log($length, strstr('.', $this->price));
//        if ( !strstr('.', $this->price) )
//        {
//            switch($length)
//            {
//                case 1:
//                case 2:
//                    $this->price = $this->price . '00';
//                    break;
//                case 3:
//                case 4:
//                    break;
//
//                default:
//                    $this->price = '0';
//                    break;
//            }
//        }
//        elseif ( strstr('.', $this->price))// && (strrpos($this->price , '.', -3)) )
//        {
//            switch($length)
//            {
//                case 1:
//                case 2:
//                    $this->price = '0';
//                    break;
//                default:
//                    $this->price = str_replace('.', '', $this->price);
//                    break;
//            }
//        }
//        else {
//            $this->price = '0';
//        }
//    }
}
