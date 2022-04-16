<?php

namespace Ewvlnet\Dropzone\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Ewvlnet\Dropzone\Models\File;

class FileController extends Controller
{
    public function store($id, $model, $type)
    {
        $this->validate(request(), ['file' => 'required|file|max:2048']);
        File::create([
            $model . '_id' => $id,
            'type' => $type,
            'url' => request()->file('file')->store($model . 's', 'public'),
        ]);
    }

    public function destroy(File $file)
    {
        $file->delete();
        return back()->withSuccess(__('File deleted successfully'));
    }

}