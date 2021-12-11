<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function indexLab1()
    {
        return view('lab1.index');
    }

    public function lab1(Request $request)
    {
        $frd       = $request->all();
        $validator = Validator::make($frd, [
            'p' => 'required',
            'q' => 'required',
            'd' => 'required',
            'M' => 'required'
        ])->validate();

        $p = $frd['p'];
        $q = $frd['q'];
        $d = $frd['d'];
        $m = $frd['M'];

        $n = $p * $q;
        $z = ($p - 1) * ($q - 1);

        $collectOfPrime = collect([2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97, 101, 103, 107, 109, 113, 127, 131, 137, 139, 149, 151, 157, 163, 167, 173, 179, 181, 191, 193, 197, 199, 211, 223, 227, 229, 233, 239, 241, 251, 257, 263, 269, 271, 277, 281, 283, 293, 307, 311, 313, 317, 331, 337, 347, 349, 353, 359, 367, 373, 379, 383, 389, 397, 401, 409, 419, 421, 431, 433, 439, 443, 449, 457, 461, 463, 467, 479, 487, 491, 499]);

        // выбираем простые числа, меньше z
        $collectE = $collectOfPrime->filter(function ($value, $key) use ($z) {
            return $value < $z;
        });

        $e = $collectE->first(function ($value, $key) use ($d, $z) {
            return $value * $d % $z === 1;
        });

        if ($e !== null) {
            /**
             * задание 1
             */
            $c1      = ($m ** $e) % $n;
            $message = ($c1 ** $d) % $n;

            if ($message == $m) {
                $result[] = ['type'   => 'success', 'text' =>
                    'Начальные данные: p: ' . $p . '; q: ' . $q . '; d: ' . $d . '; M: ' . $m .
                    '. Рассчитанные значения: n: ' . $n . '; z: ' . $z . '; C: ' . $c1 .
                    '. Открытый ключ: ' . $e
                    . '. При шифровании и дешифровании начальное значение сообщения совпадает с полученным. Расшифровка сообщения: ' . $message,
                             'header' => 'Задание 1'];
            } else {
                $result[] = ['type'   => 'warning',
                             'header' => 'Задание 1',
                             'text'   =>
                                 'Начальные данные: p: ' . $p . '; q: ' . $q . '; d: ' . $d . '; M: ' . $m .
                                 '. Рассчитанные значения: n: ' . $n . '; z: ' . $z . '; C:' . $c1 .
                                 '. Открытый ключ: ' . $e
                                 . '. При шифровании и дешифровании начальное значение сообщения не совпадает с полученным. Расшифровка сообщения: ' . $message];
            }

            /**
             * Задание 2
             */
            $c2       = ($m ** $d) % $n;
            $message2 = ($c2 ** $e) % $n;

            if ($message2 == $m) {
                $result[] = ['type'   => 'success', 'text' => '. При шифровании и дешифровании начальное значение сообщения совпадает с полученным. Расшифровка сообщения: ' . $message,
                             'header' => 'Задание 2'];
            } else{
                $result[] = ['type'   => 'warning', 'text' => '. При шифровании и дешифровании начальное значение сообщения не совпадает с полученным. Расшифровка сообщения: ' . $message,
                             'header' => 'Задание 2'];
            }
        } else {
            $result[] = ['type' => 'danger', 'header' => 'Задание 1', 'text' => 'Не удалось подобрать ключ ключ e, который удовлетворял бы условиям:
             1. 1 < e < z;
             2. ed mod z = 1'];
        }
        return view('lab1.index')->with('result', $result);
    }

    public function indexLab13()
    {
        return view('lab1.index3');
    }

    public function lab13(Request $request)
    {
        $frd       = $request->all();
        $validator = Validator::make($frd, [
            'p' => 'required',
            'q' => 'required',
            'd' => 'required',
            'M' => 'required'
        ])->validate();

        $p = $frd['p'];
        $q = $frd['q'];
        $d = $frd['d'];
        $m = $frd['M'];

        $array = str_split($m, 1);
        $profile = 1;
        foreach ($array as $item)
        {
            $item = (int) $item;
            if ($item !== 0) {
                $value = (int)$profile * $item;
               if (count(str_split($value))> 1) {
                   $profile = substr($value, 1);
               }else {
                   $profile = $value;
               }
            }
        }

        $n = $p * $q;
        $z = ($p - 1) * ($q - 1);

        $signatureD = ((int)$profile ** $d) % $n;

        $collectOfPrime = collect([2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97, 101, 103, 107, 109, 113, 127, 131, 137, 139, 149, 151, 157, 163, 167, 173, 179, 181, 191, 193, 197, 199, 211, 223, 227, 229, 233, 239, 241, 251, 257, 263, 269, 271, 277, 281, 283, 293, 307, 311, 313, 317, 331, 337, 347, 349, 353, 359, 367, 373, 379, 383, 389, 397, 401, 409, 419, 421, 431, 433, 439, 443, 449, 457, 461, 463, 467, 479, 487, 491, 499]);
        $collectE = $collectOfPrime->filter(function ($value, $key) use ($z) {
            return $value < $z;
        });
        $e = $collectE->first(function ($value, $key) use ($d, $z) {
            return $value * $d % $z === 1;
        });
        if ($e !== null) {
            $profileE = ($signatureD ** $e) % $n;

            if ((int)$profile === $profileE) {
                $result[] = ['type'   => 'success',
                             'header' => 'Задание 3',
                             'text'   =>
                                 'Начальные данные: p: ' . $p . '; q: ' . $q . '; d: ' . $d . '; M: ' . $m .
                                 '. Рассчитанные значения: n: ' . $n . '; z: ' . $z .
                                 '. Открытый ключ: ' . $e . '. Подпись: ' . $signatureD
                                 . '. Хэши функций совпали: '. $profile . ' = ' . $profileE];
            }else{
                $result[] = ['type'   => 'warning',
                             'header' => 'Задание 3',
                             'text'   =>
                                 'Начальные данные: p: ' . $p . '; q: ' . $q . '; d: ' . $d . '; M: ' . $m .
                                 '. Рассчитанные значения: n: ' . $n . '; z: ' . $z .
                                 '. Открытый ключ: ' . $e . '. Подпись: ' . $signatureD
                                 . '. Хэши функций не совпали. Хэш M: ' . $profile .'; хэш получателя: ' . $profileE];
            }
        }else{
            $result[] = ['type'   => 'danger',
                         'header' => 'Задание 3',
                         'text'   =>
                             'Начальные данные: p: ' . $p . '; q: ' . $q . '; d: ' . $d . '; M: ' . $m .
                             '. Рассчитанные значения: n: ' . $n . '; z: ' . $z .
                             '. Не удалось подобрать открытый ключ. Хэш М: ' . $profile . '. Подпись: ' . $signatureD];
        }
        return view('lab1.index3')->with('result', $result);
    }

    public function indexLab2()
    {

    }

    public function lab2(Request $request)
    {

    }
}
