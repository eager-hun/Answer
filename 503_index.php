<?php
/**
 * @file
 * index.php for maintenance events.
 */

$protocol = htmlspecialchars($_SERVER["SERVER_PROTOCOL"], ENT_QUOTES, "utf-8");
header($protocol . ' 503 Service Unavailable');

$title = 'Maintenance / Karbantartás';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php print $title; ?></title>
    <style>
      .messages-container{color:#333}.messages{padding:0.5em}.messages+.messages{margin-top:0.5em}.messages-container ul{margin:0;padding:0 0 0 2em}.messages-container pre{overflow:visible}.messages code{display:block}.messages pre{margin-bottom:2em}.messages li:last-child pre{margin-bottom:1em}.messages-container .info{background:#afa;border:1px solid green}.messages-container .info a,.messages-container .info a:hover{color:#090}.messages-container .warning{background:#ffa;border:1px solid orange}.messages-container .warning a,.messages-container .warning a:hover{color:#c80}.messages-container .alert{background:pink;border:1px solid red}.messages-container .alert a,.messages-container .alert a:hover{color:#b00}.messages-container .debug{background:#E7F1F5;border:1px solid cornflowerblue}.messages-container .debug a,.messages-container .debug a:hover{color:dodgerblue}body{color:#333;font-family:sans-serif;line-height:1.5;margin:2em auto;max-width:800px;padding:0.5em}h1{font-weight:normal}.field__label{font-weight:bold;margin:1em 0}@media (min-width: 43.75em){.page-content{border:1px solid silver;padding:1em}}
    </style>
  </head>
<body>
  <div class="page-content">

    <h1><?php print $title; ?></h1>

    <h3>Dear Visitor!</h3>
    <p>
      Maintenance work is taking place on the site right now.<br>
      I'm making efforts to get the site back online soon.
    </p>

    <h3>Tisztelt Látogató!</h3>
    <p>
      Jelenleg karbantartás zajlik a webhelyen.<br>
      Igyekeszek mihamarabb helyreállítani a webhely üzemét.
    </p>

  </div>
</body>
</html>
