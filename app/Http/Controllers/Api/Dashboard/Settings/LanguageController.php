<?php
namespace App\Http\Controllers\Api\Dashboard\Settings;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Language;
use App\Http\Requests\LanguageStoreRequest;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
  /**
   * Get categories
   * 
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection(Language::get());
  }

  /**
   * Get a single language
   * 
   * @param Language $language
   * @return \Illuminate\Http\Response
   */
  public function find(Language $language)
  {
    $language = Language::find($language->id);
    return response()->json($language);
  }

  /**
   * Store a newly created language
   *
   * @param  \Illuminate\Http\LanguageStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(LanguageStoreRequest $request)
  {
    $language = Language::create($request->all());
    $language->save();
    return response()->json(['languageId' => $language->id]);
  }

  /**
   * Update a language for a given language
   *
   * @param Language $language
   * @param  \Illuminate\Http\LanguageStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(Language $language, LanguageStoreRequest $request)
  {
    $language = Language::findOrFail($language->id);
    $language->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Remove a language
   *
   * @param  Language $language
   * @return \Illuminate\Http\Response
   */
  public function destroy(Language $language)
  {
    $language->delete();
    return response()->json('successfully deleted');
  }

}
