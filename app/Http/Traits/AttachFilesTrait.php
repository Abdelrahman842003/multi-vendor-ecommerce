<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
    public function uploadFile($request, $name, $folder)
    {
        if ($request->hasFile($name)) {
            $fileName = $request->file($name)->getClientOriginalName(); // اسم الملف الأصلي
            $path = "$folder/$fileName"; // المسار الكامل للملف
            $request->file($name)->storeAs("public/attachments/$folder", $fileName); // تخزين الملف

            return $path; // إرجاع المسار
        }

        return null; // إذا لم يتم رفع ملف
    }


    public function updateFile($request, $name, $folder, $oldFileName = null)
    {
        if ($oldFileName) {
            $this->deleteFile($oldFileName, $folder); // حذف الملف
        }

        // رفع الملف الجديد
        return $this->uploadFile($request, $name, $folder);
    }

    public function deleteFile($name, $folder)
    {
        $pathToDelete = "public/attachments/$name"; // المسار الكامل للملف القديم

        if (Storage::exists($pathToDelete)) { // التأكد إذا الملف موجود
            return Storage::delete($pathToDelete); // حذف الملف
        }

        return false; // الملف غير موجود
    }

    public function getFileUrl($folder, $name)
    {
        return Storage::url($name); // إنشاء الرابط
    }
}
