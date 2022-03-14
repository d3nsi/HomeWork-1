<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="header/header.css">
  <link rel="stylesheet" href="styleComment.css">

  <title>Обратная связь</title>
</head>
<body>
  <?php
    require_once('header/header.php');
    require_once('function.php');
    require_once('sql/commentQuery.php');
  ?>
  <div class="layout">
    <?php
      if ($isGet or !$isAllHaveValues) {
    ?>
      <div class="form">
        <form action="#" method="POST">
        <?php
          $style = isRed($name, $isGet);
          $value = haveValue($name, $isPost);
          if ($isGet and $_COOKIE['name'])
            $value = $_COOKIE['name'];
          echo "<div class='form__input' style='$style'>";
            echo "<label class='form__label'>Имя:</label>";
            if ($style)
              echo "<label class='form__labe' style='color: red; font-size: 12px'>Введите имя</label>";
            echo "<input class='form__input-text' type='input' name='name' value='$value'>";
        ?>
          </div>
        <?php
          $style = isRed($email, $isGet);
          $value = haveValue($email, $isPost);
          if ($isGet and $_COOKIE['email'])
            $value = $_COOKIE['email'];
          echo "<div class='form__input' style='$style'>";
            echo "<label class='form__label'>e-mail:</label>";
            if ($style)
              echo "<label class='form__labe' style='color: red; font-size: 12px'>Введите e-mail</label>";
            echo "<input class='form__input-text' type='email' name='email' value='$value'>";
        ?>
          </div>
        <?php
          $style = isRed($date, $isGet);
          $value = haveValue($date, $isPost);
          if ($isGet and $_COOKIE['date'])
            $value = $_COOKIE['date'];
          echo "<div class='form__input' style='$style'>";
            echo "<label class='form__label'>Год рождения:</label>";
            if ($style)
              echo "<label class='form__labe' style='color: red; font-size: 12px'>Введите год рождения</label>";
            echo "<input class='form__input-text' type='date' name='date' value='$value'>";
        ?>
          </div>
        <?php
          $style = isRed($gender, $isGet);
          if ($gender == 'man' and $isPost)
            $styleMan = ' checked';
          if ($gender == 'woman' and $isPost)
            $styleWoman = ' checked';
          if ($isGet)
            $styleMan = ' checked';
          if ($isGet and $_COOKIE['gender'] == 'man')
            $styleMan = ' checked';
          if ($isGet and $_COOKIE['gender'] == 'woman')
            $styleWoman = ' checked';

          echo "<div class='form__input' style='$style'>";
            echo "<label class='form__label'>Пол:</label>";
              echo "<div class='form__radio'>";
                echo "<input type='radio' name='gender' value='man'$styleMan>";
                echo "<label class='form__label'>М</label>";
                echo "<input type='radio' name='gender' value='woman'$styleWoman>";
                echo "<label class='form__label'>Ж</label>";
        ?>
              </div>
          </div>
        <?php
          $style = isRed($topic, $isGet);
          $value = haveValue($topic, $isPost);
          echo "<div class='form__input' style='$style'>";
            echo "<label class='form__label'>Тема обращения:</label>";
            if ($style)
              echo "<label class='form__labe' style='color: red; font-size: 12px'>Введите тему обращения</label>";
            echo "<input class='form__input-text' type='input' name='topic' value='$value'>";
        ?>
          </div>

        <?php
          $style = isRed($msg, $isGet);
          $value = haveValue($msg, $isPost);
          echo "<div class='form__input' style='$style'>";
            echo "<label class='form__label'>Суть вопроса:</label>";
            if ($style)
              echo "<label class='form__labe' style='color: red; font-size: 12px'>Введите суть вопроса</label>";
            echo "<textarea class='form__textarea' name='msg'>$value</textarea>";
        ?>
          </div>

        <?php
          if ($check and $isPost)
            $style = '';
          else
            $style = 'border-bottom: none';
          if ($isGet)
            $style = '';
          echo "<div class='form__input' style='$style'>";
          if ($style)
            echo "<label class='form__labe' style='color: red; font-size: 12px'>Поставьте галочку</label>";
        ?>
            <div class='form__checkbox'>
              <input type='checkbox' value='check' name='checkbox'>
              <label class='form__label'>С контактом ознакомлен</label>
            </div>
          </div>

          <div class="form__button-box">
            <input class="form__button" type="submit" value="Отправить">
          </div>
        </form>
      </div>
    </div>
    <?php
      } else {
        $name = trim($name);
        $email = trim($email);
        $date = trim($date);
        $topic = trim($topic);

        if (preg_match('/[^\sa-zA-Z0-9]/', $name, $res)) {
            echo "<br>";
            echo "<h2>В имени недопустимый символ: $res[0]</h2>";
            $nameChar = $res[0];
        }

        if (preg_match('/[^a-zA-Z0-9]/', $topic, $res)) {
            echo "<br>";
            echo "<h2>В название темы недопустимый символ: $res[0]</h2>";
            $topicChar = $res[0];
        }

        if ($nameChar or $topicChar) { ?>
          <div class="layout">
            <div class="form">
              <form action="#" method="POST">
                <?php
                  if ($nameChar) {
                    $style = 'border-bottom: 1px solid red';
                  } else {
                    $style = '';
                  }
                  $value = $name;
                  echo "<div class='form__input' style='$style'>";
                    echo "<label class='form__label'>Имя:</label>";
                    #echo "<label class='form__labe' style='color: red; font-size: 12px'>Введите имя</label>";
                    echo "<input class='form__input-text' type='input' name='name' value='$value'>";
                  echo "</div>";
                  
                  $style = '';
                  echo "<div class='form__input' style='$style'>";
                    echo "<label class='form__label'>e-mail:</label>";
                    echo "<input class='form__input-text' type='email' name='email' value='$email'>";
                  echo "</div>";
  
                  echo "<div class='form__input' style='$style'>";
                    echo "<label class='form__label'>Год рождения:</label>";
                    echo "<input class='form__input-text' type='date' name='date' value='$date'>";
                  echo "</div>";

                  echo "<div class='form__input' style='$style'>";
                  echo "<label class='form__label'>Пол:</label>";
                  echo "<div class='form__radio'>";
                  echo "<input type='radio' name='gender' value='man'$styleMan>";
                  echo "<label class='form__label'>М</label>";
                  echo "<input type='radio' name='gender' value='woman'$styleWoman>";
                  echo "<label class='form__label'>Ж</label>";
  
                  echo "</div>";
                  echo "</div>";
  
                  if ($topicChar) {
                    $style = 'border-bottom: 1px solid red';
                  } else {
                    $style = '';
                  }
                  
                  $value = $topic;
                  echo "<div class='form__input' style='$style'>";
                  echo "<label class='form__label'>Тема обращения:</label>";
                  echo "<input class='form__input-text' type='input' name='topic' value='$value'>";
                  echo "</div>";
                  $style = "";
                  echo "<div class='form__input' style='$style'>";
                  echo "<label class='form__label'>Суть вопроса:</label>";
                  echo "<textarea class='form__textarea' name='msg'>$msg</textarea>";
                  echo "</div>";
                  echo "<div class='form__input' style='$style'>";
  ?>
                  <div class='form__checkbox'>
                      <input type='checkbox' value='check' name='checkbox'>
                      <label class='form__label'>С контактом ознакомлен</label>
                  </div>
                  </div>

                  <div class="form__button-box">
                      <input class="form__button" type="submit" value="Отправить">
                  </div>
                  </form>
            </div>
        <?php } else {
                setcookie('name', $name);
                setcookie('email', $email);
                setcookie('date', $date);
                setcookie('gender', $gender);

                $stmt = $link->prepare("INSERT INTO feedback (feedback_name, feedback_mail, feedback_birthday, feedback_gender, feedback_topic, feedback_msg) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $name, $email, $date, $gender, $topic, $msg);
                $stmt->execute();
                echo "<h1>Форма отправлена</h1>";
              }
            }
           
    ?> 
  </div>
</body>
</html>