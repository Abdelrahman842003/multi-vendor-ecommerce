<?php

namespace App\Http\Repository\Dashboard;

use App\Http\Interface\Dashboard\StoreInterface;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Store;
use Exception;
use Illuminate\Support\Str;

class  StoreRepository implements StoreInterface
{
    use AttachFilesTrait;

    public function index()
    {
        $requestFilter = request()->validate([
            'name' => 'nullable|string',
            'status' => 'nullable|string|in:active,archived',]);

        $stores = Store::leftJoin('stores as parentStore', 'stores.id', '=', 'parentStore.parent_id')
            ->select('stores.*', 'parentStore.name as parent_name')
            ->filter($requestFilter)->get();


        return view('dashboard.pages.store.index', compact('stores'));
    }

    public function create()
    {
        $stores = Store::all();
        return view('dashboard.pages.store.create', compact('stores'));
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
            $file_name_logo_image = $this->uploadFile($request, 'logo_image', 'logo_image_store');
            $file_name_cover_image = $this->uploadFile($request, 'cover_image', 'cover_image_store');

            $validated['logo_image'] = $file_name_logo_image;
            $validated['cover_image'] = $file_name_cover_image;
            Store::create($validated);
            toastr()->success('Store created successfully!');
            return redirect()->route('dashboard.store.index');
        } catch (Exception $e) {
            toastr()->error('An unexpected error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        $store_id = Store::findorFail($id);
        $stores = Store::all();
        return view('dashboard.pages.store.edit', compact('store_id', 'stores'));

    }

    public function update($request, $id)
    {
        $store_id = Store::findorFail($id);
        $validated = $request->validated();

        if ($request->hasFile('logo_image') || $request->hasFile('cover_image')) {
            if ($request->hasFile('logo_image')) {
                $validated['logo_image'] = $this->updateFile($request, 'logo_image', 'logo_image_store', $store_id->logo_image);
            }

            if ($request->hasFile('cover_image')) {
                $validated['cover_image'] = $this->updateFile($request, 'cover_image', 'cover_image_store', $store_id->cover_image);
            }

        }
        $validated['slug'] = Str::slug($request->name);


        $store_id->update($validated);
        toastr()->success('Store updated successfully!');
        return redirect()->route('dashboard.store.index');
    }

    public function destroy($id)
    {
        $store_id = Store::findorFail($id);
        $store_id->delete();
        toastr()->success('Store deleted successfully!');
        return redirect()->route('dashboard.store.index');

    }

    public function trash(){
        $requestFilter = request()->validate([
            'name' => 'nullable|string',
            'status' => 'nullable|string|in:active,archived',]);
        $storeTrash = Store::onlyTrashed()->filter($requestFilter)->get();
        return view('dashboard.pages.store.trash',compact('storeTrash'));
    }

    public function restore($id )
    {
        $store = Store::onlyTrashed()->findOrFail($id);
        $store->restore();
        toastr()->success('Store restored successfully!');
        return redirect()->route('dashboard.store.trash');
    }

    public function forceDelete($id)
    {
        $store = Store::onlyTrashed()->findOrFail($id);

        if ($store->logo_image) {
            $this->deleteFile($store->logo_image, 'logo_image_store');
        }
        if ($store->cover_image) {
            $this->deleteFile($store->cover_image, 'cover_image_store');
        }

        $store->forceDelete();
        toastr()->success('Store deleted permanently!');
        return redirect()->route('dashboard.store.trash');
    }
}
