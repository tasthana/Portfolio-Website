<?php
$phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
$pathParts = pathinfo($phpSelf);
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> ePortfolio! </title>
        <meta name="author" content="Tushar Asthana">
        <meta name="description" content="An ePortfolio website to show off my resume.">
        <meta name ="viewport" content="width=device-width, initial-scale=1.0">        
        <link rel="stylesheet" href="css/custom.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media= "(max-width: 800px)" href="css/custom-tablet.css?version=<?php print time(); ?>"type="text/css">
        <link rel="stylesheet" media=" (max-width: 600px)" href="css/custom-phone.css?version=<?php print time(); ?>" type="text/ass">
    </head>

    <?php
    print '<body class="grid-layout positioning" id=" ' . $pathParts['filename'] . '">';
    print '<!-- ##################      Start of Body Element    ################ -->';
    include 'header.php';
    include 'nav.php'; 

?>