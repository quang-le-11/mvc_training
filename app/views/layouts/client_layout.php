<html>
<head>
    <title>Website</title>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="<?=_WEB_ROOT?>/public/assets/clients/css/style.css">
</head>
<body>
<?php
$this->render('blocks/header');
$this->render($content, $sub_content);
$this->render('blocks/footer');
?>

<script type="text/css" src="<?=_WEB_ROOT?>public/assets/clients/js/script.js"></script>
</body>
</html>