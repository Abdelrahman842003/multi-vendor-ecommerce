<?php

namespace App\Http\Repository\Dashboard;

use App\Http\Interface\Dashboard\CategoryInterface;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Category;
use App\Models\Store;
use Exception;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryInterface
{
    use AttachFilesTrait;

    public function index()
    {
        $requestFilter = request()->validate([
            'name' => 'nullable|string',
            'status' => 'nullable|string|in:active,archived',]);

        $categories = Category::with(['store', 'parent', 'product'])

//            ->select('categories.*')
//            ->selectRaw('(SELECT COUNT(*) FROM products WHERE products.category_id = categories.id) as products_count')

//        leftJoin('categories as parentCategories', 'parentCategories.id', '=', 'categories.parent_id')
//            ->leftJoin('stores', 'categories.store_id', '=', 'stores.id')
//            ->where('categories.store_id', '=', auth()->user()->store_id)
//            ->select(
//                'categories.*',
//                'parentCategories.name as parent_category_name',
//                'stores.name as parent_store_name'
//            )

            ->withCount('product')->filter($requestFilter) // لو فيه فلتر موجود
            ->latest()->get();

        return view('dashboard.pages.category.index', compact('categories'));
    }

    public function create()
    {
        $stores = Store::where('id', '=', auth()->user()->store_id)->get();
        $categories = Category::where('categories.store_id', '=', auth()->user()->store_id);
        return view('dashboard.pages.category.create', compact('stores', 'categories'));
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store($request)
    {
        try {
            $validated = $request->validated();
            if ($request->hasFile('image')) {
                $validated['image'] = $this->uploadFile($request, 'image', 'image_category');
            }

            $validated['slug'] = Str::slug($request->name);
            Category::create([
                'name' => $request->name,
                'slug' => $validated['slug'],
                'parent_id' => $request->parent_id,
                'store_id' => $request->store_id,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $validated['image'],

            ]);
            toastr()->success('Store created successfully!');
            return redirect()->route('dashboard.category.index');
        } catch (Exception $e) {
            toastr()->error('An unexpected error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $stores = Store::all();
        $category = Category::findorFail($id);
        $category_id = Category::where('id', '!=', $id)->get();
        return view('dashboard.pages.category.edit', compact('category_id', 'stores', 'category'));

    }

    public function update($request, $id)
    {
        $category = Category::findOrFail($id);

        // تحقق من البيانات
        $validated = $request->validated();
        // تحديث الصورة
        if ($request->hasFile('image')) {
            $validated['image'] = $this->updateFile($request, 'image', 'image_category', $category->image);
        }

        // تحديث البيانات
        $category->update($validated);

        toastr()->success('Store updated successfully!');
        return redirect()->route('dashboard.category.index');
    }


    public function destroy($id)
    {
        $category_id = Category::findorFail($id);

//        if ($category_id->image) {
//            $this->deleteFile($category_id->image, 'image_category');
//        }
        $category_id->delete();
        toastr()->success('Store trashed successfully!');
        return redirect()->route('dashboard.category.index');

    }

    public function trash()
    {
        $requestFilter = request()->validate([
            'name' => 'nullable|string',
            'status' => 'nullable|string|in:active,archived',]);
        $categoriesTrash = Category::onlyTrashed()->filter($requestFilter)->get();
        return view('dashboard.pages.category.trash', compact('categoriesTrash'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        toastr()->success('Store restored successfully!');
        return redirect()->route('dashboard.category.trash');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);

        if ($category->image) {
            $this->deleteFile($category->image, 'image_category');
        }
        $category->forceDelete();
        toastr()->success('Store deleted permanently!');
        return redirect()->route('dashboard.category.trash');
    }
}
