<?php
namespace App\Http\Views\Composer;

use App\Models\Category;
use Illuminate\View\View;

class CategoriesViewComposer
{
    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function compose(View $view)
    {
        return $view->with('categories', $this->category->all(['name', 'slug']));
    }
}