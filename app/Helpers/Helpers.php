<?php

use Illuminate\Support\Str;

if (! function_exists('generateSlug')) {
    function generateSlug(
        $model,
        string $text,
        int $id = 0,
    ): string {
        $slug = Str::slug($text);
        $originalSlug = $slug;

        $counter = 1;

        while ($model::query()
            ->when($id != 0, function ($query) use ($id) {
                return $query->where('id', '<>', $id);
            })
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = $originalSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
