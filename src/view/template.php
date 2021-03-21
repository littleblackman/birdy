<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $app_session->getTitlePage(); ?></title>

    <meta name="description" content="<?= $app_session->getDescriptionPage(); ?>" />
    <meta name="generator" content="ETSIK FRAMEWORK" />
    <meta name="publisher" content="Sandy Razafitrimo - ETSIK" />
    <meta name="author" content="Sandy Razafitrimo, littleblackman, etsik" />
    <meta name="copyright" content="© ETSIK" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="robots" content="index,follow" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= HOST;?>app/core/css/framework.css">
    <link rel="stylesheet" href="<?= ASSETS;?>edugo/css/materialize.css">
    <link rel="stylesheet" href="<?= ASSETS;?>edugo/css/loader.css">
	<link rel="stylesheet" href="<?= ASSETS;?>edugo/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= ASSETS;?>edugo/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= ASSETS;?>edugo/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?= ASSETS;?>edugo/css/style.css">

    <link type="text/css" href="<?= CSS; ?>mystyle.css" type="text/css" rel="stylesheet" media="screen,projection"/>


    <!-- jQuery --->
    <script src="<?= ASSETS;?>edugo/js/jquery.min.js"></script>
	<script src="<?= ASSETS;?>edugo/js/materialize.min.js"></script>

</head>
<body>

    <?php include CORE.'template/sessionBarContent.php'; ?>
    <?php include CORE.'template/flashMessageBar.php'; ?>

    <div id="fullScreen">
        <i class="fa fa-times" aria-hidden="true" id="closeFullScreenButton"></i>
        <div id="fullScreenContent"></div>
    </div>
    
    <?php include('_navigation.php');?>

    <div id="mainContent">
        <?php echo $contentPage ;?>
    </div>

    <?php include('_footer.php');?>


    <input type="hidden" id="urlHost" value="<?= HOST;?>"/>

   
	<script src="<?= ASSETS;?>edugo/js/owl.carousel.min.js"></script>
    <script src="<?= ASSETS;?>edugo/js/main.js"></script>
    <script src="<?= ASSETS;?>js/mymain.js"></script>

    <?php if( $app_session->getRequest()->getController() == "Session"):?>
        <script src="https://cdn.tiny.cloud/1/rh94623y86575qrj04nyduzxsrhx2n6v9hi1pwz2c4idlt9i/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <?php endif;?>

    <?php if($scripts = $app_session->getRequest()->getScriptJS()):?>
        <?php foreach($scripts as $script):?>
            <?php if( strpos($script, 'http') !== false):?>
                <script src="<?= $script;?>"></script>
            <?php else :?>
                <script src="<?= ASSETS;?>js/<?= $script;?>"></script>
            <?php endif;?>
        <?php endforeach;?>
    <?php endif;?>
</body>
</html>