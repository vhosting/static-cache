<?php

use Inertia\Inertia;

/**
 * Send a toast to inertia frontend
 *
 * @param 'success'|'error'|'warning' $type Must be one of "success", "error" and "warning"
 * @param string $message Message content
 */
function toast(string $type, string $message): void
{
    Inertia::flash("toast.$type", $message);
}
