<?php

namespace App\Actions\Files;

use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class ListFiles
{
    use AsAction;

    public function handle(): Enumerable
    {
        $exclusions = explode(',',config('app.site.file.exclusions'));
        $files = Storage::disk('static-cache')->allFiles();

        return collect($files)
            ->reject(fn (string $path) => in_array($path, $exclusions))
            ->groupBy(function($path){
                $dirname = pathinfo($path, PATHINFO_DIRNAME);
                [$id] = explode('-',pathinfo($path, PATHINFO_FILENAME));

                return $dirname.'/'.$id;
            })
            ->map(function($paths){
                $out = [];

                foreach($paths as $path) {
                    $dirname = pathinfo($path, PATHINFO_DIRNAME);
                    [$id, $type] = explode('-',pathinfo($path, PATHINFO_FILENAME));

                    $out['uri'] = $dirname.'/'.$id;
                    $out['index'] ??= $type === 'index' ? $path : null;
                    $out['amp'] ??= $type === 'amp' ? $path : null;
                }

                return $out;
            })
            ->values();
    }
}
