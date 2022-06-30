<?php

function validator(array $fields)
{
    $errors = [];
    foreach ($fields as $key => $field) {
        $rules = explode('|', $field);
        $validatorByRules = validatorByRules($rules, $key);

        if (!empty($validatorByRules)) {
            $errors[$key] = $validatorByRules;
        }
    }

    if (!isEmpty($errors)) {
        $cleanErrors = [];
        foreach ($errors as $key => $value) {
            $variable = $errors[$key];
            foreach ($variable as $value) {
                array_push($cleanErrors, [$key => $value]);
            }
        }

        return $cleanErrors;
    }

    return [];
}

function validatorByRules($rules, $input)
{
    $errors = [];
    foreach ($rules as $rule) {
        if ($rule === 'required') {
            if (isEmpty($_REQUEST[$input])) {
                $errors[] = $rule;
            }
            continue;
        }
        if ($rule === 'number') {
            if (isset($_REQUEST[$input]) && !validateNumber($_REQUEST[$input])) {
                $errors[] = $rule;
            }
        }
        if ($rule === 'mobile') {
            if (isset($_REQUEST[$input]) && !validateMobile($_REQUEST[$input])) {
                $errors[] = $rule;
            }
        }
        if ($rule === 'password') {
            if (isset($_REQUEST[$input]) && !validateLenPass($input)) {
                $errors[] = $rule;
            }
        }
        if ($rule === 'persianChar') {
            if (isset($_REQUEST[$input]) && !validatePersianChars($_REQUEST[$input])) {
                $errors[] = $rule;
            }
        }
    }
    return $errors;
}

function ruleAttributes()
{
    return [
        'password' => 'Password must not be less than 8 characters',
        'mobile' => 'Invalid phone number entered',
        'number' => 'The value of the field should be just a number',
        'required' => 'The field should not be empty',
        'persianChar' => 'Please write the field value in Persian'
    ];
}

function isEmpty($data): bool
{
    return ($data === '' || $data === null || (is_array($data) && !$data));
}

function isNotEmpty($data): bool
{
    return !isEmpty($data);
}

function convertNumberToEnglish($data)
{
    if (isEmpty($data)) {
        return null;
    }
    return str_replace(['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'], [
        '0',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
    ], $data);
}

function convertNumberToPersian($data)
{
    return str_replace(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9',], [
        '۰',
        '۱',
        '۲',
        '۳',
        '۴',
        '۵',
        '۶',
        '۷',
        '۸',
        '۹',
    ], $data);
}

function validatePersianChars($data)
{
    if (trim($data) === "" || empty(trim($data))) {
        return false;
    }
    if (!preg_match("/^([\-\_ پچجحخهعغفقثصضشسیبلاتنمکگوئدذرزطظژ])+$/u", $data)) {
        return false;
    }
    return $data;
}

function validateEnglishChars($data)
{
    if (trim($data) === "" || empty(trim($data))) {
        return false;
    }
    if (preg_match("/[^A-Za-z0-9\-\_\/ ]/", $data)) {
        return false;
    }
    return $data;
}

function validateNumber($data)
{
    if (trim($data) === "") {
        return false;
    }
    if (!preg_match("/[^\D]/", $data)) {
        return false;
    }
    return $data;
}

function validateAddress($data)
{
    if (trim($data) === "" || empty(trim($data))) {
        return false;
    }
    if (!preg_match('/^([, 0-9۱-۹-_،پچجحخهعغفقثصضشسیبلاتنمکگوئدذرزطظژ])+$/u', $data)) {
        return false;
    }
    return $data;
}

function validateEmail($data)
{
    if (trim($data) === "" || empty(trim($data))) {
        return false;
    }
    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,5}$/ix", $data)) {
        return false;
    }
    return $data;
}

function validatePostalCode($data)
{
    if (trim($data) === "" || empty(trim($data))) {
        return false;
    }
    $validate_number = sanitiseNumber($data);
    if (strlen($validate_number) !== 10) {
        return false;
    }
    return $validate_number;
}

function validateNationalCode($data): bool
{
    if (trim($data) === "" || empty(trim($data))) {
        return false;
    }
    if (!preg_match('/^[\d]{10}$/', $data)) {
        return false;
    }
    for ($i = 0; $i < 10; $i++) {
        if (preg_match('/^' . $i . '{10}$/', $data)) {
            return false;
        }
    }
    for ($i = 0, $sum = 0; $i < 9; $i++) {
        $sum += ((10 - $i) * (int)substr($data, $i, 1));
    }
    $ret = $sum % 11;
    $parity = (int)substr($data, 9, 1);
    return ($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11 - $parity);
}

function validateBirthdate($data)
{
    if (trim($data) == "") {
        return false;
    }
    if (!preg_match('/^[1-4]\d{3}\/((0[1-6]\/((3[0-1])|([1-2][\d])|(0[1-9])))|((1[0-2]|(0[7-9]))\/(30|31|([1-2][\d])|(0[1-9]))))$/', $data)) {
        return false;
    }
    return $data;
}

function validateMobile($data)
{
    if (empty(trim($data))) {
        return false;
    }
    $data = convertNumberToEnglish($data);
    if (!preg_match("/^09\d{9}$/", $data)) {
        return false;
    }
    return $data;
}

function validatePhone(string $data)
{
    if (trim($data) === "" || empty(trim($data))) {
        return false;
    }
    $data = convertNumberToEnglish($data);
    if (!preg_match("/(041|044|045|031|026|084|077|021|056|051|058|061|024|023|054|071|028|025|066|011|086|076|081|038|087|034|083|074|017|013|035{3}+)([2-9][\d]{7})$/", $data)) {
        return false;
    }
    return $data;
}

function validatePersianDate($data)
{
    if (trim($data) === "" || empty(trim($data))) {
        return false;
    }
    $data = convertNumberToEnglish($data);
    if (!preg_match('/^[1-4]\d{3}\/((0[1-6]\/((3[0-1])|([1-2]\d)|(0[1-9])))|((1[0-2]|(0[7-9]))\/(30|31|([1-2]\d)|(0[1-9]))))$/', $data)) {
        return false;
    }
    return $data;
}

function validateCardNumber($card, bool $irCard = true): bool
{
    if (trim($card) === "" || empty(trim($card))) {
        return false;
    }
    $card = (string)preg_replace('/\D/', '', $card);
    $strlen = strlen($card);
    if ($irCard == true && $strlen != 16) {
        return false;
    }
    if ($irCard != true && ($strlen < 13 || $strlen > 19)) {
        return false;
    }
    if (!in_array($card[0], [2, 4, 5, 6, 9])) {
        return false;
    }

    for ($i = 0; $i < $strlen; $i++) {
        $res[$i] = $card[$i];
        if (($strlen % 2) == ($i % 2)) {
            $res[$i] *= 2;
            if ($res[$i] > 9) {
                $res[$i] -= 9;
            }
        }
    }
    return array_sum($res) % 10 === 0;
}

function validateLenPass($data)
{
    if (strlen($_REQUEST[$data]) < 8) {
        return false;
    }
    return $data;
}

function validateProductCode(string $data)
{
    if (trim($data) === "" || empty(trim($data))) {
        return false;
    }
    if (!preg_match("/^([A-Z]{3}+)-(\d{8})$/", $data)) {
        return false;
    }
    return $data;
}
