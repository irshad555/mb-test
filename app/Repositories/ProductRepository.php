<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select(
            'products.id',
            'products.slug',
            'products.image',
            'products.title as product',
            'categories.title as category'
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
        $productObj = new Product();
        $productObj->slug = Str::slug($request->Title, '-');
        return $this->setProductData($productObj, $request);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update($request)
    {
        $productObj = Product::FindOrFail($request->Id);
        return $this->setProductData($productObj, $request);
    }

    /**
     * setProductData
     *
     * @param  mixed $productObj
     * @param  mixed $request
     * @return void
     */
    public function setProductData($productObj, $request)
    {
        $productObj->title = $request->Title;
        $productObj->category_id = $request->category;
        $this->setProductImage($productObj, $request);
        DB::transaction(function () use ($productObj) {
            $productObj->save();
        });

        return $productObj;
    }

    public function setProductImage($productObj, $request)
    {
        if ($request->file('Image')) {
            $imagePath = $request->file('Image');
            $imageName = $imagePath->getClientOriginalName();
            $image_path = $request->file('Image')
                ->storeAs('uploads', $imageName, 'public');
            $productObj->image = $imageName;
        }
        return  $productObj;
    }

    /**
     * get
     *
     * @param  mixed $id
     * @return void
     */
    public function get($id)
    {
        return Product::FindOrFail($id);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $productObj = Product::FindOrFail($id);
        DB::transaction(function () use ($productObj) {
            $productObj->delete();
        });
        return response()->json(['status' => 1, 'msg' => ' Product deleted successfull..!']);
    }
}
