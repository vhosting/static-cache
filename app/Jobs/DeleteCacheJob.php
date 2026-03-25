<?php

namespace App\Jobs;

use App\Enums\DeleteMethod;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DeleteCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $pattern, public DeleteMethod $method)
    {
    }

    public function handle(): void
    {
        if ($this->method === DeleteMethod::Exact) {
            Storage::disk('static-cache')->delete($this->pattern);
            return;
        }

        $files = Storage::disk('static-cache')->allFiles();

        $exclusions = explode(',', config('app.site.file.exclusions'));

        $toDelete = collect($files)
            ->reject(fn(string $file) => in_array($file, $exclusions))
            ->filter(fn(string $file) => match ($this->method) {
                DeleteMethod::StartsWith => str_starts_with($file, $this->pattern),
                DeleteMethod::EndsWith => str_ends_with($file, $this->pattern),
                DeleteMethod::Contains => str_contains($file, $this->pattern),
            })->values()->all();

        Storage::disk('static-cache')->delete($toDelete);
    }
}
