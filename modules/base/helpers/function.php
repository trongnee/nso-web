<?php

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;

if (!function_exists('include_file')) {
    function include_file($path)
    {
        if (!file_exists($path)) {
            return;
        }
        include_once($path);
    }
}

if (!function_exists('get_all_file')) {
    function get_all_file($directory, callable $callback = null, callable $filter = null)
    {
        if (!is_dir($directory)) {
            return [];
        }

        $files = collect(File::allFiles($directory));

        if ($filter) {
            $files = $files->filter($filter);
        }

        if ($callback) {
            $files->each($callback);
        }
        return $files->all();
    }
}

if (!function_exists('apiJson')) {
    /**
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     * */
    function apiJson($data, $code = 200, $headers = [])
    {
        return response()->json($data, $code, $headers);
    }
}
if (!function_exists('api_datatable')) {
    /**
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     * */
    function api_datatable(LengthAwarePaginator $pagination, $code = 200, $headers = [])
    {
        return response()->json(
            [
                'draw' => request()->get('draw'),
                'recordsTotal' => $pagination->total(),
                'recordsFiltered' => $pagination->total(),
                'data' => $pagination->items()
            ],
            $code,
            $headers
        );
    }
}

if (!function_exists('filled')) {
    /**
     * @param mixed $value
     * @return bool
     * */
    function filled($value)
    {
        $is_empty_string = !is_bool($value) && !is_array($value) && trim((string) $value) === '';
        return !$is_empty_string;
    }
}
