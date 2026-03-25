<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Throwable;

class StaticCacheController extends Controller
{
    public function getPage(string $endpoint)
    {
        $segments = collect(explode('/', $endpoint));
        $amp = false;
        $id = null;

        if ($segments->last() === 'amp') {
            $amp = true;
            $segments->pop();
        }

        $id = $segments->pop();

        $path = sprintf('%s/%s-%s.html', $segments->implode('/'), $id, $amp ? 'amp' : 'index');

        //--------------------------------------------------------------------------------------

        try{
            $response = $this->sendRequest($endpoint);

            if ($response->ok()) {
                // create file
                Storage::disk('static-cache')->put($path, $response);

                // update last modified
                if($response->hasHeader('Last-Modified')){
                    $fullPath = Storage::disk('static-cache')->path($path);
                    touch($fullPath, strtotime($response->header('Last-Modified')));
                }

                return response($response)
                    ->header('X-Static-Cache', 'MISS');
            }

            if($response->redirect()) {
                return response($response, $response->status())
                    ->header('X-Static-Cache', 'BYPASS')
                    ->header('location', $response->header('location'));
            }

            return response($response, $response->status())
                ->header('X-Static-Cache', 'BYPASS');
        } catch (Throwable $e){
            report($e);

            $response = $this->sendRequest($endpoint);

            return response($response, $response->status())
                ->header('X-Static-Cache', 'PASSTHROUGH');
        }
    }

    protected function sendRequest(string $endpoint)
    {
        return Http::withoutVerifying()
            ->withoutRedirecting()
            ->replaceHeaders([
                'Host' => config('app.site.hostname'),
                'User-Agent' => config('app.site.useragent'),
            ])
            ->get(sprintf('https://%s/%s/', config('app.site.ip'), $endpoint));
    }
}
