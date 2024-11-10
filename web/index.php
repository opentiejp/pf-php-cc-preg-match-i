<?php

$email = NULL;
$password = NULL;
$msg = NULL;

$regexp_email = '/^[a-zA-Z0-9_+-]+(.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/';
$regexp_password = '/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[.?\/-])[a-zA-Z0-9.?\/-]{6,18}$/';

if ((isset($_POST['email']) === TRUE) && (isset($_POST['password']) === TRUE)) {
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    if(($_POST['email'] == "") && ($_POST['password'] == "")) {
        $msg = 'メールアドレスとパスワードを入力してください';
    } else if ((($_POST['email'] !== "") && ($_POST['password'] == "")) || (($_POST['email'] == "") && ($_POST['password'] !== ""))) {
        $msg = 'メールアドレスとパスワードをどちらも入力してください';
    } else if ((preg_match($regexp_email, $email) !== 1) && (preg_match($regexp_password, $password) !== 1)) {
        $msg = 'メールアドレスの形式が正しくありません' . "<br>" . 'パスワードは、次の条件で設定してください：'. "<br>". '・半角英数字記号で6文字以上18文字以下' . "<br>" . '・半角英字、半角数字、半角記号をそれぞれ1文字以上含む' . "<br>" . '・使用可能な記号は . ? / - の4つ';
    } else if (preg_match($regexp_email, $email) !== 1) {
        $msg = 'メールアドレスの形式が正しくありません';
    } else if (preg_match($regexp_password, $password) !== 1) {
      $msg = 'パスワードは、次の条件で設定してください：'. "<br>". '・半角英数字記号で6文字以上18文字以下' . "<br>" . '・半角英字、半角数字、半角記号をそれぞれ1文字以上含む' . "<br>" . '・使用可能な記号は . ? / - の4つ';
    } else if ((preg_match($regexp_email, $email) === 1) && (preg_match($regexp_password, $password) === 1)) {
      $msg = '登録完了';
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>17-5｜課題(中級)</title>
    <style type="text/css">
      html {
        background-color: #ffffff;
      }
      html * {
        box-sizing: border-box;
        font-family: sans-serif;
      }
      p {        
        font-size: 16px;
        color: #000000;
        margin: 15px 0;
        line-height: 1.2;
      }
      #form {
        float: left;
        text-align: left;
        width: 20em;
        margin: 0 auto 30px auto;
      }
      label, input {
        width: 100%;
      }
      input {
        margin-top: 3px;
      }
      #msg {
        line-height: 1.6;
      }
    </style>
  </head>
  <body>
    <form method="post">
      <div id="form">
        <p>
          <label for="email">
            メールアドレス：<br><input type="email" id="email" name="email" placeholder="example@email.com" value="<?php print $email;?>">
          </label>
        </p>
        <p>
          <label for="password">
            パスワード：<br><small>（半角英数字記号6文字以上18文字以下｜半角英字・半角数字・半角記号をそれぞれ1文字以上含む｜使用可能な記号は . ? / - の4つです）</small><br><input type="password" id="password" name="password" minlength="6" maxlength="18" value="<?php print $password;?>">
          </label><br>
        </p>
        <p id="msg"><?php print $msg; ?></p>
        <input type="submit" name="submit" value="登録">
      </div>
    </form>
  </body>
</html>