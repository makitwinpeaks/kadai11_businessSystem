<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<!-- <link rel="stylesheet" href="css/main.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Noto Sans Japanese"> -->
<!-- <link href="./css/style.css" rel="stylesheet"> -->

<!-- <style>div{padding: 10px;font-size:16px;}</style> -->
<title>管理者ログイン</title>


<style>
body {
    font-family: 'Noto Sans Japanese', serif;
    font-size: 20px;
    background-color: #e0f2f1;
    color: #333;
    padding: 20px;
    width: 600px;
    text-align: center;
  }

</style>



</head>

<body>

<header>
  <!-- <nav class="navbar navbar-default">管理者ログイン</nav> -->
管理者ログイン
</header>

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act.php" method="post">
ID:<input type="text" name="lid">
PW:<input type="password" name="lpw">
<input type="submit" value="ログイン">
</form>


</body>
</html>