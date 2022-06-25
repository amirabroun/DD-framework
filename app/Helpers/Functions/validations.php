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

function translate($words, $is_rule = false)
{
    if ($is_rule) {
        $attributes = attributesTranslate('rule');
        return @$attributes[$words];
    }

    $attributes = attributesTranslate('input');
    return @$attributes[$words];
}

function attributesTranslate($ruleOrInput)
{
    if ($ruleOrInput === 'rule') {
        return [
            'password' => 'کلمه عبور نباید کمتر از 8 کاراکتر باشد!<br>',
            'mobile' => 'شماره تلفن وارد شده نامعتبر است<br>',
            'number' => 'مقدار فیلد باید فقط عدد باشد<br>',
            'required' => 'فیلد نباید خالی باشد!<br>',
            'persianChar' => 'لطفا مقدار فیلد را فارسی بنویسید<br>'
        ];
    }

    if ($ruleOrInput === 'input') {
        return [
            'title' => 'عنوان',
            'id' => 'آیدی',
            'brand_id' => 'برند',
            'username' => 'نام کاربری',
            'cellphone' => 'شماره تلفن همراه',
            'password' => 'کلمه عبور',
            'password_rule' => 'کلمه عبور',
            'description' => 'توضیحات',
            'first_name' => 'نام',
            'last_name' => 'نام خانوادگی',
        ];
    }
}

function initErrors()
{
    $html_last = null;
    $errors = @$_SESSION['error'][pageName()]['errors'];
    $title_error = @$_SESSION['error'][pageName()]['title'];
    if ($errors) {
        foreach ($errors as $key => $error) {
            $input_label = translate($key);
            $html_first = null;
            foreach ($error as $value) {
                $rule_label = translate($value['rule'], true);
                $html_first .= "<li style='margin: 5px 10px;list-style: decimal;' class='alert-text'>{$rule_label}</li>";
            }
            $html_last .= "<li style='margin: 5px 10px;list-style: decimal;' class='alert-text'>
            <span class='bold fof-15'>{$input_label}:</span>
            <ul style='padding: 0 10px;display: unset;font-size: 13px;'>
                $html_first
            </ul>
        </li>";
        }
        $title_error = (empty($title_error)) ? 'لطفا خطا های زیر را برطرف کنید!' : $title_error;
        unset($_SESSION['error'][pageName()]);
        return "<ul style='padding: 0 10px;display: block;text-align: right;' class='alert alert-danger alert-bold'>
                    <p class='bold fof-17 mt-3'>" . $title_error . ":</p>
                    <hr>
                    $html_last
                </ul>";
    }
    return null;
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
