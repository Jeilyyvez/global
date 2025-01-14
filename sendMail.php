<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title><?php


                            echo '<link rel="stylesheet" href="css\styles.css">';

                            ?>
</head>

<body>
    <div class="thank-you-wrapper">

        <?php

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'vendor/autoload.php'; // Подключите автозагрузчик Composer

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $city = $_POST['city'];
            $phone = $_POST['phone'];
            $agreement = isset($_POST['agreement']) ? 'Согласен' : 'Не согласен';

            $mail = new PHPMailer(true);

            try {
                // Настройки сервера
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'meta3700@gmail.com';
                $mail->Password = 'yrka eiga pwwz xvof'; // Используйте более безопасный способ хранения пароля
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->CharSet = 'UTF-8';

                // Получатели
                $mail->setFrom('meta3700@gmail.com', 'Mailer');
                $mail->addAddress('anzero3700@gmail.com');

                // Контент
                $mail->isHTML(false);
                $mail->Subject = "GlobUpak заявка";
                $mail->Body = "Имя: $name\nГород: $city\nТелефон: $phone\nСогласие на обработку данных: $agreement";

                // Отправка
                $mail->send();
                echo '<div class="thank-you"><img src="images/thanks-good.png" alt="Галочка"><p>Спасибо<br>Ваши данные отправлены</p>';
                echo '<button onclick="window.location.href=\'' . $_SERVER['HTTP_REFERER'] . '\'">Вернуться назад</button>';
                echo '</div>';
            } catch (Exception $e) {
                echo '<div class="thank-you"><img src="images/thanks-bad.png" alt="Галочка"><p>Ошибка<br>Попробуйте ещё раз</p>';
                echo '<button onclick="window.location.href=\'' . $_SERVER['HTTP_REFERER'] . '\'">Вернуться назад</button>';
                echo '</div>';
            }
        }
        ?>
    </div>
</body>

</html>