<?php

namespace App\Http\Controllers;

use App\Enums\DeleteMethod;
use App\Http\Requests\DeleteCacheRequest;
use App\Jobs\DeleteCacheJob;
use Dedoc\Scramble\Attributes\Group;

#[Group("Pages")]
class FilesApiController extends Controller
{
    /**
     * Clear the cache
     * @param DeleteCacheRequest $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteCacheRequest $request)
    {
        $pattern = $request->input('pattern');
        $method = $request->enum('method', DeleteMethod::class);

        DeleteCacheJob::dispatch($pattern, $method);

        return response()->noContent();
    }
}
