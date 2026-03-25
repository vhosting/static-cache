<?php

namespace App\Http\Controllers;

use App\Enums\DeleteMethod;
use App\Jobs\DeleteCacheJob;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function index()
    {
        $exclusions = explode(',',config('app.site.file.exclusions'));

        $files = collect(Storage::disk('static-cache')->allFiles())
            ->reject(fn (string $path) => in_array($path, $exclusions))
            ->map(function($path){
                $dirname = pathinfo($path, PATHINFO_DIRNAME);
                [$filename, $type] = explode('-',pathinfo($path, PATHINFO_FILENAME));

                return [
                    'path' => $path,
                    'uri' => $dirname.'/'.$filename,
                    'index' => $type === 'index',
                    'amp' => $type === 'amp',
                ];
            })
            ->groupBy('uri')
            ->map(function(Collection $files){
                $item = [];

                foreach ($files as $file){
                    $item['path'] = $file['path'];
                    $item['uri'] = $file['uri'];
                    $item['index'] ??= false;
                    $item['amp'] ??= false;

                    $item['index'] = $item['index'] ?: $file['index'];
                    $item['amp'] = $item['amp'] ?: $file['amp'];
                }

                return $item;
            })
            ->values();

        return inertia('files/Index', [
            'files' => $files->all(),
        ]);
    }

    public function delete(Request $request)
    {
        $pattern = $request->input('pattern');
        $method = $request->enum('method', DeleteMethod::class);

        DeleteCacheJob::dispatchSync($pattern, $method);

        return back();
    }
}
