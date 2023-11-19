<?php
if (!function_exists('aFunctionName')) {
    function aFunctionName()
    {
        // Xử lý hàm aFunctionName()
    }
}

if (!function_exists('returnApi')) {
    function returnApi($success = false, $message = 'System error !', $data = [], $res_code = 200)
    {
        $array_result = [
            'success' => $success,
            'message' => $message,
        ];
        if (!empty($data))
        {
            $array_result['data'] = $data;
        }
        return response()->json($array_result, $res_code);
    }
}

?>
