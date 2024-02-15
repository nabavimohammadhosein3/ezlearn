<?php

namespace App\Http\Controllers;

trait Custom_file_name
{
    public function custom_name(array $names, string $format)
    {
        $name = implode('_', $names);
        return $name . '.' . $format;
    }
}
