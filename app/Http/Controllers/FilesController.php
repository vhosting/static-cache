<?php

namespace App\Http\Controllers;

use App\Actions\Files\ListFiles;
use App\Enums\DeleteMethod;
use App\Http\Requests\DeleteCacheRequest;
use App\Jobs\DeleteCacheJob;

class FilesController extends Controller
{
    public function index()
    {
        return inertia('files/Index');
    }

    public function list()
    {
        return response()->json(ListFiles::run());
    }

    public function delete(DeleteCacheRequest $request)
    {
        $pattern = $request->input('pattern');
        $method = $request->enum('method', DeleteMethod::class);

        DeleteCacheJob::dispatchSync($pattern, $method);

        return back();
    }
}
