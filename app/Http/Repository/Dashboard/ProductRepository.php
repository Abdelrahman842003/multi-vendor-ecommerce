<?php

namespace App\Http\Repository\Dashboard;

use App\Http\Interface\Dashboard\ProductInterface;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Str;

class ProductRepository implements ProductInterface
{
    use AttachFilesTrait;

    public function index()
    {
        $requestFilter = request()->validate([
            'name' => 'nullable|string',
            'status' => 'nullable|string|in:active,archived',]);

        $products = Product::productsReturn()->filter($requestFilter)->with(['store', 'category'])->get();

        return view('dashboard.pages.product.index', compact('products'));
    }

    public function create()
    {
        $category = Category::all();
        $tags = Tag::all();
        return view('dashboard.pages.product.create', compact('category', 'tags'));
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store($request)
    {
        try {
            $validated = $request->validated();
            $validated['slug'] = Str::slug($request->name);
            $validated['store_id'] = auth()->user()->store_id;

            if ($request->hasFile('image')) {
                $validated['image'] = $this->uploadFile($request, 'image', 'image_product');
            }

            // Initialize an empty array to store tag IDs
            $tags = json_decode($request->tags);
            $tag_ids = [];
            $tags_all = Tag::all();

            // Loop through the tags and create new ones if they don't exist
            if ($request->hasFile('tags')) {
                foreach ($tags as $item) {
                    $slug = Str::slug($item->value);
                    $tag = $tags_all->where('slug', $slug)->first();

                    if (!$tag) {
                        // Create new tag if it doesn't exist
                        $tag = Tag::create([
                            'name' => $item->value,
                            'slug' => $slug
                        ]);
                    }

                    // Add the tag ID to the array (do not overwrite)
                    $tag_ids[] = $tag->id;
                }
            }

            // Sync the tags relationship with the array of tag IDs
            // This will update the product's tags with the new array of tag IDs
            $validated->tags()->sync($tag_ids);

            toastr()->success('Product created successfully!');
            return redirect()->route('dashboard.product.index');
        } catch (Exception $e) {
            toastr()->error('An unexpected error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function edit($id)
    {

        $product_id = Product::findorFail($id);
        $categories = Category::all(); // Get all categories

        $tags = implode(',', $product_id->tags()->pluck('name')->toArray());

        return view('dashboard.pages.product.edit', compact('product_id','tags','categories'));

    }

    public function update($request, $id)
    {
        $store_id = Product::findorFail($id);
        $validated = $request->validated();

        $validated['slug'] = Str::slug($request->name);
        $validated['store_id'] = auth()->user()->store_id;


        // Initialize an empty array to store tag IDs
        $tags = json_decode($request->tags);
        $tag_ids = [];
        $tags_all = Tag::all();

        // Loop through the tags and create new ones if they don't exist
        if ($request->hasFile('tags')) {
            foreach ($tags as $item) {
                $slug = Str::slug($item->value);
                $tag = $tags_all->where('slug', $slug)->first();

                if (!$tag) {
                    // Create new tag if it doesn't exist
                    $tag = Tag::create([
                        'name' => $item->value,
                        'slug' => $slug
                    ]);
                }

                // Add the tag ID to the array (do not overwrite)
                $tag_ids[] = $tag->id;
            }
        }

        // Sync the tags relationship with the array of tag IDs
        // This will update the product's tags with the new array of tag IDs
        $store_id->tags()->sync($tag_ids);

        $store_id->update($validated);
        toastr()->success('Product updated successfully!');
        return redirect()->route('dashboard.product.index');
    }

    public function destroy($id)
    {
        $store_id = Product::findorFail($id);
        $store_id->delete();
        toastr()->success('Store deleted successfully!');
        return redirect()->route('dashboard.product.index');

    }

    public function trash()
    {
        $requestFilter = request()->validate([
            'name' => 'nullable|string',
            'status' => 'nullable|string|in:active,archived',]);
        $productTrash = Product::onlyTrashed()->filter($requestFilter)->with('category')->get();
        return view('dashboard.pages.product.trash', compact('productTrash'));
    }

    public function restore($id)
    {
        $store = Product::onlyTrashed()->findOrFail($id);
        $store->restore();
        toastr()->success('Store restored successfully!');
        return redirect()->route('dashboard.store.trash');
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);


        if ($product->image) {
            $this->deleteFile($product, 'image', 'image_product');
        }

        $product->forceDelete();
        toastr()->success('Product deleted permanently!');
        return redirect()->route('dashboard.product.trash');
    }
}
