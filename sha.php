<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

  <body>
    <?php
    $shaX = false;
    $shaY = false;
    $shaZ = false;
    $sha = $_POST["sha"];
    $sha_file_list = array("Text_Files/sha1_list.txt","Text_Files/sha224_list.txt","Text_Files/sha256_list.txt");
    $sha1_list = fopen($sha_file_list[0], 'r') or die("Unable to open file!");
    $sha224_list = fopen($sha_file_list[1], 'r') or die("Unable to open file!");
    $sha256_list = fopen($sha_file_list[2], 'r') or die("Unable to open file!");
    //sha1 start
    $handle = fread($sha1_list, filesize($sha_file_list[0]));
    $handle_Explode= explode("\n", $handle);
    foreach ($handle_Explode as $key => $value) {
        $sha3[]= explode(":", $value);
    }
    array_pop($sha3);
    foreach ($sha3 as $key => $value) {
        $sha2[] = array($value[1] => $value[0]);
    }
    foreach ($sha2 as $key => $value) {
        foreach ($value as $k => $v) {
            if ($sha == $k) {
                $sha1HashValue = $v;
                $shaX = true;
            }
        }
    }
    fclose($sha1_list);
    //sha224 Start
    $handle224 = fread($sha224_list, filesize($sha_file_list[1]));
    $handle_Explode224= explode("\n", $handle224);
    foreach ($handle_Explode224 as $key => $value) {
        $shaA[]= explode(":", $value);
    }
    array_pop($shaA);
    foreach ($shaA as $key => $value) {
        $sha224[] = array($value[1] => $value[0]);
    }
    foreach ($sha224 as $key => $value) {
        foreach ($value as $k => $v) {
            if ($sha == $k) {
                $sha224HashValue = $v;
                $shaY = true;
            }
        }
    }
    fclose($sha224_list);
    //sha256 Start
    $handle256 = fread($sha256_list, filesize($sha_file_list[2]));
    $handle_Explode256= explode("\n", $handle256);
    foreach ($handle_Explode256 as $key => $value) {
        $shaB[]= explode(":", $value);
    }
    array_pop($shaB);
    foreach ($shaB as $key => $value) {
        $sha256[] = array($value[1] => $value[0]);
    }
    foreach ($sha256 as $key => $value) {
        foreach ($value as $k => $v) {
            if ($sha == $k) {
                $sha256HashValue = $v;
                $shaZ = true;
            }
        }
    }
    fclose($sha256_list);
    //Test

    $falseTest = ($shaX or $shaY or $shaZ);
    require_once 'vendor/autoload.php';
    $loader = new Twig_Loader_Filesystem('views/');
    if (!($falseTest)) {
        throw new \Exception("Error Processing Request. Value Entered was not in a sha1, sha224, or 256 format.", 1);
    } elseif ($shaX) {
        $twig = new Twig_Environment($loader);
        echo $twig->render('template.html.twig', $sh = array(
        'hash' => $sha,
        'sha1' => $sha1HashValue
      ));
    } elseif ($shaY) {
        $twig = new Twig_Environment($loader, ['$sha224' => $sha224HashValue]);
        echo $twig->render('template.html.twig', $sh = array(
        'hash' => $sha,
        'sha1' => $sha224HashValue
      ));
    } else {
        $twig = new Twig_Environment($loader, ['$sha256' => $sha256HashValue]);
        echo $twig->render('template.html.twig', $sh = array(
        'hash' => $sha,
        'sha1' => $sha256HashValue
      ));
    }

     ?>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
  </body>
</html>
