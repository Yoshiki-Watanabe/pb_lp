<?php

include "../settings/settings.php";

mb_language("Japanese");
mb_internal_encoding("UTF-8");

$name_safe = htmlspecialchars($_POST["form_name"], ENT_QUOTES);
$phone_safe = htmlspecialchars($_POST["form_tel"], ENT_QUOTES);
$mail_safe = htmlspecialchars($_POST["form_mail"], ENT_QUOTES);
$date_safe = htmlspecialchars($_POST["form_date_robot"], ENT_QUOTES);


$max_length = 2000;
// サーバサイドの入力文字数チェック
if (mb_strlen($name_safe, 'UTF-8') > $max_length ||
	mb_strlen($phone_safe, 'UTF-8') > $max_length ||
	mb_strlen($mail_safe, 'UTF-8') > $max_length ||
	mb_strlen($date_safe, 'UTF-8') > $max_length
	){
	exit($error_message_length);
}



$message = "メールアドレス：".$mail_safe."\r\n名前：" . $name_safe . "\r\n電話番号：" . $phone_safe. "\r\n日程：" . $date_for_robot[$date_safe];
$subject = $own_subject_robot;
$message_template = $own_message_robot;





if (!mb_send_mail($mail_01, $subject, $message_template.$message, "From: " . $mail_safe)) {
  exit($error_message_time);
}
if (!mb_send_mail($mail_02, $subject, $message_template.$message, "From: " . $mail_safe)) {
  exit($error_message_time);
}
if (!mb_send_mail($mail_03, $subject, $message_template.$message, "From: " . $mail_safe)) {
  exit($error_message_time);
}



$subject_reply = $reply_subject_robot;
$message_reply = $reply_message_robot . $reply_message_robot_2 .$reply_message_robot_3 . $date_for_robot[$date_safe] . $reply_message_robot_4;

if (!mb_send_mail($mail_safe, $subject_reply, $message_reply, "From: " . $mail_03)) {
  exit($error_message_mail);
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<link type="text/css" href="assets/css/style.css" rel="stylesheet" media="all">
<style>
p{
	font-size: 16px;
}
</style>
<title>sample</title>
</head>
<body>
<p>お申込みありがとうございます。</p>
<p>入力されたメールアドレスに自動返信メールが送信されます。<br>メールが届かない場合は、メールアドレスをご確認の上、再度送信をお願いいたします。</p>
<p>10秒後に元のページに戻ります。</p>
<script type="text/javascript">
setTimeout("location.replace(<?php echo $jump_url_school; ?>)",10000);
</script>
</body>
</html>