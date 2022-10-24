<?php namespace Abs\Score\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Model;
use October\Rain\Database\Traits\NestedTree;
use October\Rain\Database\Traits\Sluggable;
use October\Rain\Database\Traits\Validation;
use System\Models\File;

/**
 * Category Model
 */
class Category extends Model
{
    use Validation, NestedTree, Sluggable, HasFactory;

    /**
     * @var string table associated with the model
     */
    public $table = 'abs_score_categories';

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

    /**
     * @var array hasOne and other relations
     */
    public $belongsTo = [
        'parent' => [Category ::class, 'key' => 'parent_id'],
    ];

    public $hasMany = [
        'children' => [Category ::class, 'key' => 'parent_id'],

    ];

    public $belongsToMany = [
        'products' => [Product::class, 'table' => 'abs_score_category_product'],
    ];

    public $attachOne = [
        'preview' => [File::class],
    ];

//    public function products()
//    {
//        return $this->belongsToMany(Product::class, 'abs_score_category_product')->where('is_published', '=', 1);
//    }
}
