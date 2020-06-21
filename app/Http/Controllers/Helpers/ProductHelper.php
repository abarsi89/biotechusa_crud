<?php

namespace App\Http\Controllers\Helpers;

use App\Product;
use App\Tag;
use Illuminate\Http\Request;
use Faker\Provider\Uuid;
use Image;

class ProductHelper
{
    /**
     * Product properties
     *
     * @var array
     */
    private $fields = [
        'name',
        'description',
        'start_of_publication',
        'end_of_publication',
        'price',
    ];

    /**
     * Set Product properties
     *
     * @param Product $product
     * @param Request $request
     * @return Product
     */
    public function setProperties(Product $product, Request $request): Product
    {
        $product->id = Uuid::uuid();

        foreach ($this->fields as $field) {
            $product->$field = $request->$field;
        }

        $this->setImage($product, $request);

        return $product;
    }

    /**
     * Set Pruduct image
     *
     * @param Product $product
     * @param Request $request
     * @return Product
     */
    public function setImage(Product $product, Request $request): Product
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save(public_path('/storage/images/' . $filename));

            $product->image = $filename;
        }

        return $product;
    }

    /**
     * Get actual tags in a string which are in relation with the Product
     *
     * @param Product $product
     * @return string
     */
    public function getProductTagsInString(Product $product): string
    {
        $productTagNames = [];
        foreach ($product->tags as $productTag) {
            $productTagNames[] = $productTag->name;
        }

        return implode(",", $productTagNames);
    }

    /**
     * Get all the Tag names
     *
     * @return array
     */
    public function getAllTagNamesInArray(): array
    {
        $tags = Tag::all()->toArray();

        $tagNames = [];
        foreach ($tags as $tag) {
            $tagNames[] = $tag['name'];
        }

        return $tagNames;
    }

    /**
     * Save new tags from request and put these in relation with the Product
     *
     * @param array $requestTags
     * @param array $allTagNames
     * @param Product $product
     * @return Product
     */
    public function saveNewTags(array $requestTags, array $allTagNames, Product $product): Product
    {
        foreach ($requestTags as $requestTag) {
            if (!in_array($requestTag, $allTagNames)) {
                $newTag = new Tag();
                $newTag->id = Uuid::uuid();
                $newTag->name = $requestTag;
                $newTag->save();

                $product->tags()->attach($newTag->id);
            }
        }

        return $product;
    }

    /**
     * Get actual tag names in an array which are in relation with the Product
     *
     * @param Product $product
     * @return array
     */
    public function getProductTagNamesInArray(Product $product): array
    {
        $productTagNames = [];
        foreach ($product->tags as $productTag) {
            $productTagNames[] = $productTag->name;
        }

        return $productTagNames;
    }

    /**
     * Remove unused Tags from relation with the Product
     *
     * @param array $productTagNames
     * @param array $requestTags
     * @param Product $product
     * @return Product
     */
    public function removeUnusedTags(array $productTagNames, array $requestTags, Product $product): Product
    {
        $results = array_diff($productTagNames, $requestTags);

        if (!empty($results)) {
            foreach ($results as $result) {
                $unusedTag = Tag::where('name', '=', $result)->first();
                $product->tags()->detach($unusedTag->id);
            }
        }

        return $product;
    }
}
