<?php

namespace App\Http\Controllers;

use App\Actions\Files\ListFiles;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return inertia('Dashboard', [
            'stats' => Inertia::defer(function () {
                $total = 0;
                $index = 0;
                $amp = 0;

                ListFiles::run()->each(function ($file) use (&$amp, &$index, &$total) {
                    $total++;
                    if ($file['index']) {
                        $index++;
                    }
                    if ($file['amp']) {
                        $amp++;
                    }
                });

                return [
                    'total_pages' => $total,
                    'index_pages' => $index,
                    'amp_pages' => $amp,
                ];
            }),
        ]);
    }
}
