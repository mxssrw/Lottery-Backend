<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/lottery', function () {
    return response()->json(['message' => 'Hi Laravel']);
});

Route::get('/api/lottery', function () {
    $randomThreeDigit = fn() => str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    $threeDigit = $randomThreeDigit();
    $closeThreeDigitMinus = str_pad((string) max(0, intval($threeDigit) - 1), 3, '0', STR_PAD_LEFT);
    $closeThreeDigitPlus = str_pad((string) min(999, intval($threeDigit) + 1), 3, '0', STR_PAD_LEFT);
    $randomTwoDigit = fn() => str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);

    $data = [
        [ 'id' => '1', 'round' => 'รางวัลที่ 1', 'value1' => $threeDigit, 'value2' => '', 'value3' => '' ],
        [ 'id' => '2', 'round' => 'รางวัลใกล้เคียง รางวัลที่ 1', 'value1' => $closeThreeDigitMinus, 'value2' => $closeThreeDigitPlus, 'value3' => '', 'isSubRow' => true ],
        [ 'id' => '3', 'round' => 'รางวัลที่ 2', 'value1' => $randomThreeDigit(), 'value2' => $randomThreeDigit(), 'value3' => $randomThreeDigit() ],
        [ 'id' => '4', 'round' => 'รางวัลเลขท้าย 2 ตัว', 'value1' => $randomTwoDigit(), 'value2' => '', 'value3' => '', 'isSubRow' => true ],
    ];

    return response()->json($data);
});