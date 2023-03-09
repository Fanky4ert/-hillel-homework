<?php
/**
 * Перевіряє передану дату на відповідність формату 'ГГГГ-ММ-ДД'
 *
 * Приклади використання:
 * isDateValid('2019-01-01'); // true
 * isDateValid('2016-02-29'); // true
 * isDateValid('2019-04-31'); // false
 * isDateValid('10.10.2010'); // false
 * isDateValid('10/10/2010'); // false
 *
 * @param string $date Дата у вигляді рядка
 *
 * @return bool true у разі збігу з форматом 'ГГГГ-ММ-ДД', інакше false
 */
function isDateValid(string $date) : bool {
    $format_to_check = 'Y-m-d';
    $dateTimeObj = date_create_from_format($format_to_check, $date);

    return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
}

/**
 * Створює підготовлений вираз на основі готового SQL запиту і переданих даних
 *
 * @param $link mysqli Ресурс з'єднання
 * @param $sql string SQL запит із плейсхолдерами замість значень
 * @param array $data Дані для вставки на місце плейсхолдерів
 *
 * @return mysqli_stmt Підготовлений вираз
 */
function dbGetPrepareStmt($link, $sql, $data = [])
{
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не вдалося ініціалізувати підготовлений вираз: ' . mysqli_error($link);
        throw new ErrorException($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg = 'Не вдалося пов\'язати підготовлений вираз із параметрами: ' . mysqli_error($link);
            throw new ErrorException($errorMsg);
        }
    }

    return $stmt;
}

/**
 * Повертає коректну форму множини
 * Обмеження: тільки для цілих чисел
 *
 * Приклад використання:
 * $remainingMinutes = 5;
 * echo "Я поставив таймер на {$remainingMinutes} " .
 *     getNounPluralForm(
 *         $remainingMinutes,
 *         'хвилина',
 *         'хвилини',
 *         'хвилин'
 *     );
 * Результат: "Я поставив таймер на 5 хвилин"
 *
 * @param int $number Число, за яким обчислюємо форму множини
 * @param string $one Форма однини: яблуко, година, хвилина
 * @param string $two Форма множини для 2, 3, 4: яблука, години, хвилини
 * @param string $many Форма множини для решти чисел
 *
 * @return string Розрахована форма множини
 */
function getNounPluralForm(int $number, string $one, string $two, string $many): string
{
    $number = (int) $number;
    $mod10 = $number % 10;
    $mod100 = $number % 100;

    switch (true) {
        case ($mod100 >= 11 && $mod100 <= 20):
            return $many;

        case ($mod10 > 5):
            return $many;

        case ($mod10 === 1):
            return $one;

        case ($mod10 >= 2 && $mod10 <= 4):
            return $two;

        default:
            return $many;
    }
}

/**
 * Підключає шаблон, передає туди дані і повертає підсумковий HTML контент
 *
 * @param string $name Шлях до файлу шаблону відносно папки templates
 * @param array $data Асоціативний масив із даними для шаблону
 * @return string Підсумковий HTML
 */
function renderTemplate($name, array $data = [])
{
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

function dayTime($taskDate): bool
{
    $diffTime = obsolutTime($taskDate);

    if ($diffTime >= 24) {
         return true;
    }
    return false;
}


function hourCard($taskDate)
{
     $diffTime = obsolutTime($taskDate);
    if ($diffTime < 0) {
        $diffTime = 0;
    }
     return $diffTime;
}

function obsolutTime($taskDate)
{
    $nowTime = strtotime($taskDate);
    $worldTime = time();
    $diffTime = floor(($nowTime - $worldTime) / 3600);

    return $diffTime;
}


function connect()
{
    mysqli_report(MYSQLI_REPORT_ERROR);
    $con = mysqli_connect("localhost", "root", "", "hillel_homework");
    if ($con === false) {
        die('Не могу подключится к БД');
    }
        mysqli_set_charset($con, 'UTF8');

        return $con;
}

function getProjects($con)
{
    $sql = "SELECT * FROM projects";
    $result = mysqli_query($con, $sql);
    if ($result === false) {
        die('Ошибка при выполнении запроса: ' . mysqli_error($con));
    }
    $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $projects;
}

function getTasks($con, $idProject)
{
    $sql = "SELECT * FROM tasks where project_id= " . (int)$idProject;
    $result = mysqli_query($con, $sql);
    if ($result === false) {
        die('Ошибка при выполнении запроса: ' . mysqli_error($con));
    }
       $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
       return $tasks;
}

function insertTaskToDatabase($con, $created_at, $header, $description, $end_time, $user_id, $project_id)
{
    $created_at = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tasks (created_at, header, description, end_time, user_id, project_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt === false) {
        die('Не могу подготовить выражение к вполнению');
    }
    $bindParam = mysqli_stmt_bind_param(
        $stmt,
        'ssssii',
        $created_at,
        $header,
        $description,
        $end_time,
        $user_id,
        $project_id,
    );
    if ($bindParam === false) {
        die('Ошибка привязки');
    }
    $result = mysqli_stmt_execute($stmt);
    if ($result === false) {
        die('Не могу подготовить запрос');
    }
}

function createusertoDB ($con, $created_at, $email, $username, $password)
{
    $createdAt = date("Y-m-d H:i:s");
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (created_at, email, username, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt === false) {
        die('Не могу подготовить выражение к вполнению');
    }
    $bindParam = mysqli_stmt_bind_param(
        $stmt,
        'ssss',
        $createdAt,
        $email,
        $username,
        $password
    );
    if ($bindParam === false) {
        die('Ошибка привязки');
    }
}


