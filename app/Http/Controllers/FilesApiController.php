<?php

namespace App\Http\Controllers;

use App\Enums\DeleteMethod;
use App\Jobs\DeleteCacheJob;
use Illuminate\Http\Request;

class FilesApiController extends Controller
{
    public function delete(Request $request)
    {
        $pattern = $request->input('pattern');
        $method = $request->enum('method', DeleteMethod::class);

        DeleteCacheJob::dispatch($pattern, $method);

        return response()->noContent();
    }
}
