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

if (!function_exists('read_number')) {

    function read_number($num)
    {
        if (mb_strlen($num) >= 12) {
            return 'số quá lớn';
        }
        if ($num == 0) {
            return "không";
        }
        $parts = [];
        if ($num >= 1e9) {
            $parts[] = convertHundreds(floor($num / 1e9)) . " tỷ";
            $num %= 1e9;
        }
        if ($num >= 1e6) {
            $parts[] = convertHundreds(floor($num / 1e6)) . " triệu";
            $num %= 1e6;
        }
        if ($num >= 1e3) {
            $parts[] = convertHundreds(floor($num / 1e3)) . " nghìn";
            $num %= 1e3;
        }
        if ($num > 0) {
            $parts[] = convertHundreds($num);
        }
        return implode(" ", $parts);
    }

    function convertHundreds($n)
    {
        $units = ["", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín"];
        $tens = ["", "mười", "hai mươi", "ba mươi", "bốn mươi", "năm mươi", "sáu mươi", "bảy mươi", "tám mươi", "chín mươi"];
        $hundreds = ["", "một trăm", "hai trăm", "ba trăm", "bốn trăm", "năm trăm", "sáu trăm", "bảy trăm", "tám trăm", "chín trăm"];

        $result = "";

        $hundred = floor($n / 100);
        $ten = floor(($n % 100) / 10);
        $unit = $n % 10;
        if ($hundred > 0) {
            $result .= $hundreds[$hundred] . " ";
        }
        if ($ten > 1) {
            $result .= $tens[$ten] . " ";
            if ($unit > 0) {
                $result .= $units[$unit] . " ";
            }
        } elseif ($ten == 1) {
            $result .= "mười ";
            if ($unit > 0) {
                $result .= ($unit == 5) ? "lăm " : $units[$unit] . " ";
            }
        } else {
            if ($unit > 0) {
                if ($hundred > 0) {
                    $result .= "lẻ ";
                }
                $result .= $units[$unit] . " ";
            }
        }
        return trim($result);
    }
}

if (!function_exists('short_number')) {
    function short_number($number)
    {
        $number = str_replace(',', '', $number); // Xóa dấu phẩy nếu có
        if (!is_numeric($number)) {
            return "Không hợp lệ";
        }

        $suffixes = [' nghìn', ' triệu', ' tỷ', ' nghìn tỷ']; // Đơn vị: nghìn, triệu, tỷ, nghìn tỷ
        $divisors = [1000, 1000000, 1000000000, 1000000000000];

        for ($i = count($divisors) - 1; $i >= 0; $i--) {
            if ($number >= $divisors[$i]) {
                return round($number / $divisors[$i], 1) . $suffixes[$i];
            }
        }

        return $number; // Trả về số gốc nếu nhỏ hơn 1000
    }
}
