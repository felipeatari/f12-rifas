<?php

use App\Models\Category;

if (!function_exists('httpStatusCodeError')) {
    function httpStatusCodeError(int $statusCode = 0)
    {
        $statusCodeErrors = [
            400, 401, 403, 404, 405, 406, 407, 408, 409,
            410, 415, 422, 424, 429,
            500, 501, 502, 503, 504, 505
        ];

        return in_array($statusCode, $statusCodeErrors) ? $statusCode : 500;
    }
}

if (!function_exists('slug')) {
    function slug(string $title = '')
    {
        return Illuminate\Support\Str::slug($title);
    }
}

if (!function_exists('onlyNumbers')) {
    function onlyNumbers($value)
    {
        return preg_replace('/[^0-9]+?/im', '', $value);
    }
}

if (!function_exists('formatCPF')) {
    function formatCPF($value)
    {
        return preg_replace('/(\d+)(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', preg_replace("/[^0-9]+?/","",$value));
    }
}

if (!function_exists('validateCPF')) {
    function validateCPF($cpf) {
        $cpf = preg_replace('/\D/', '', $cpf);

        if (strlen($cpf) != 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $sum = 0;

            for ($i = 0; $i < $t; $i++) {
                $sum += $cpf[$i] * (($t + 1) - $i);
            }

            $rest = $sum % 11;

            if ($cpf[$t] != ($rest < 2 ? 0 : 11 - $rest)) {
                return false;
            }
        }

        return true;
    }
}
