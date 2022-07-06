<?php

require 'Functions/requests.php';
require 'Functions/validations.php';
require 'Functions/app.php';

ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

function sluggable($data)
{
    return str_replace(' ', '-', $data);
}

function sanitise($data)
{
    return trim(strip_tags($data));
}

function sanitiseNumber($data)
{
    return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
}

function url($path = '')
{
    return originBaseUrl() . '/' . $_SERVER['HTTP_HOST'] . '/' . ltrim($path, '/');
}

function assets($path = '')
{
    return originBaseUrl() . '/' . $_SERVER['HTTP_HOST'] . '/public/Assets/' . ltrim($path, '/');
}

function css($path = '')
{
    return originBaseUrl() . '/' . $_SERVER['HTTP_HOST'] . '/public/Assets/css' . ltrim($path, '/');
}

function plugins($path = '')
{
    return originBaseUrl() . '/' . $_SERVER['HTTP_HOST'] . '/public/Assets/plugins/' . ltrim($path, '/');
}

function jsFiles($path = '')
{
    return originBaseUrl() . '/' . $_SERVER['HTTP_HOST'] . '/public/Assets/js/' . ltrim($path, '/');
}

function partials($path = ''): string
{
    return originBaseUrl() . '/' . $_SERVER['HTTP_HOST'] . '/resources/partials/' . ltrim($path, '/');
}

function categoryLink($id): string
{
    return "/product.php?category=$id";
}

function productLink($id)
{
    return url("/products/$id");
}

function dd(...$data)
{
    die(var_dump((object)$data));
}

function logger()
{
    throw new Exception();
}

function ddd(...$data)
{
    die(json_encode([$data]));
}

function bcrypt($password, $hash = null)
{
    if (!is_null($hash)) {
        return password_verify($password, $hash);
    }

    return password_hash($password, PASSWORD_BCRYPT);
}

function responseJson($data)
{
    die(json_encode($data));
}

function recaptchaVerify($secret_key, $token): bool
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['secret' => $secret_key, 'response' => $token]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $captcha_validation = json_decode($response, true);
    return $captcha_validation["success"] === true;
}

function generateDigit(int $length)
{
    try {
        if ($length >= 1) {
            $start = str_repeat("0", $length - 1);
            $end = str_repeat("9", $length - 1);
            return random_int("1$start", "9$end");
        }
        return false;
    } catch (Throwable $exception) {
        return false;
    }
}

function sortingArray(array $input_array, string $sort_key, string $sort_type): array
{
    $column_sort = array_column($input_array, $sort_key);
    if (!$column_sort) {
        return $input_array;
    }
    $sort = ($sort_type === 'ASC') ? SORT_ASC : SORT_DESC;
    array_multisort($column_sort, $sort, $input_array);
    return $input_array;
}

function price($price, $text = true): string
{
    return number_format($price) . ($text === true ? ' تومان' : null);
}

function isAjaxRequest(): bool
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * @param string $routeSection
 * 
 * @return bool
 */
function isParamRouteSection($routeSection)
{
    return strstr($routeSection, '{') && strstr($routeSection, '}');
}

function pluralize($word)
{
    $plural = array(
        '/(quiz)$/i'               => "$1zes",
        '/^(ox)$/i'                => "$1en",
        '/([m|l])ouse$/i'          => "$1ice",
        '/(matr|vert|ind)ix|ex$/i' => "$1ices",
        '/(x|ch|ss|sh)$/i'         => "$1es",
        '/([^aeiouy]|qu)y$/i'      => "$1ies",
        '/(hive)$/i'               => "$1s",
        '/(?:([^f])fe|([lr])f)$/i' => "$1$2ves",
        '/(shea|lea|loa|thie)f$/i' => "$1ves",
        '/sis$/i'                  => "ses",
        '/([ti])um$/i'             => "$1a",
        '/(tomat|potat|ech|her|vet)o$/i' => "$1oes",
        '/(bu)s$/i'                => "$1ses",
        '/(alias)$/i'              => "$1es",
        '/(octop)us$/i'            => "$1i",
        '/(ax|test)is$/i'          => "$1es",
        '/(us)$/i'                 => "$1es",
        '/s$/i'                    => "s",
        '/$/'                      => "s"
    );

    $irregular = array(
        'move'   => 'moves',
        'foot'   => 'feet',
        'goose'  => 'geese',
        'sex'    => 'sexes',
        'child'  => 'children',
        'man'    => 'men',
        'tooth'  => 'teeth',
        'person' => 'people',
        'valve'  => 'valves'
    );

    $uncountable = array(
        'sheep',
        'fish',
        'deer',
        'series',
        'species',
        'money',
        'rice',
        'information',
        'equipment'
    );

    if (in_array(strtolower($word), $uncountable)) {
        return $word;
    }

    foreach ($irregular as $pattern => $result) {
        $pattern = '/' . $pattern . '$/i';

        if (preg_match($pattern, $word)) {
            return preg_replace($pattern, $result, $word);
        }
    }

    foreach ($plural as $pattern => $result) {
        if (preg_match($pattern, $word)) {
            return preg_replace($pattern, $result, $word);
        }
    }

    return $word;
}

if (isset($_SESSION['message'])) { ?>
    <script>
        Swal.fire({
            title: "<?php echo $_SESSION['message']['title'] ?>",
            html: "<?php echo $_SESSION['message']['text'] ?>",
            icon: "<?php echo $_SESSION['message']['type'] ?>",
            buttonsStyling: false,
            confirmButtonText: "متوجه شدم!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    </script>
<?php unset($_SESSION['message']);
}
