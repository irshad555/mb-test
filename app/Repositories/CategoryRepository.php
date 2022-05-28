<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return DB::table('categories')
        ->join('category_types', 'categories.category_type_id', '=', 'category_types.id')
        ->select(
            'categories.id',
            'categories.slug',
            'categories.title as category',
            'category_types.title as category_type'
        )->get();
    }
    /**
     * save
     *
     * @param  mixed $request
     * @return void
     */
    public function save($request)
    {
        $categoryObj = new Category();
        $categoryObj->slug = Str::slug($request->Title, '-');
        return $this->setCategoryData($categoryObj, $request);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update($request)
    {
        $categoryObj =Category::FindOrFail($request->Id);
        return $this->setCategoryData($categoryObj, $request);
    }

    /**
     * setCategoryData
     *
     * @param  mixed $categoryObj
     * @param  mixed $request
     * @return void
     */
    public function setCategoryData($categoryObj, $request)
    {
        $categoryObj->title = $request->Title;
        $categoryObj->category_type_id = $request->categoryType;
        DB::transaction(function () use ($categoryObj) {
            $categoryObj->save();
        });

        return $categoryObj;
    }

    /**
     * get
     *
     * @param  mixed $id
     * @return void
     */
    public function get($id)
    {
        return Category::FindOrFail($id);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $categoryObj = Category::FindOrFail($id);
        DB::transaction(function () use ($categoryObj) {
            $categoryObj->delete();
        });

        return response()->json(['status' => 1, 'msg' => ' Category deleted successfull..!']);
    }
}
