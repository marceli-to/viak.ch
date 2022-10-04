<?php
namespace App\Http\Controllers\Api\Dashboard\Settings;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  /**
   * Get categories
   * 
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection(Category::get());
  }

  /**
   * Get a single category
   * 
   * @param Category $category
   * @return \Illuminate\Http\Response
   */
  public function find(Category $category)
  {
    $category = Category::find($category->id);
    return response()->json($category);
  }

  /**
   * Store a newly created category
   *
   * @param  \Illuminate\Http\CategoryStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(CategoryStoreRequest $request)
  {
    $category = Category::create($request->all());
    return response()->json(['categoryId' => $category->id]);
  }

  /**
   * Update a category for a given category
   *
   * @param Category $category
   * @param  \Illuminate\Http\CategoryStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(Category $category, CategoryStoreRequest $request)
  {
    $category = Category::findOrFail($category->id);
    $category->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Remove a category
   *
   * @param  Category $category
   * @return \Illuminate\Http\Response
   */
  public function destroy(Category $category)
  {
    $category->delete();
    return response()->json('successfully deleted');
  }

}
