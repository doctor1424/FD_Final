<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php
    function array_combine_($keys, $values)
    {
        $result = array();
        foreach ($keys as $i => $k) {
            $result[$k][] = $values[$i];
        }
        array_walk($result, create_function('&$v', '$v = (count($v) == 1)? array_pop($v): $v;'));
        return    $result;
    }

    //Connecting to sever
    $server = "localhost";
    $user = "root";
    $pw = "";
    $db = "sakila";

    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("ERROR: Cannot connect to database $db on server $server
    	using user name $user (".mysqli_connect_errno().
        ", ".mysqli_connect_error().")");
    }
  //Gets fname, lname, and all titles
  $mySQL_2 = "SELECT
	CONCAT(first_name,
	' ',
	last_name)AS Actor,
	title AS Film
FROM
	film_actor AS t1
INNER JOIN actor AS t2 ON
	t1.actor_id = t2.actor_id
INNER JOIN film AS t3 ON
	t1.film_id = t3.film_id
ORDER BY
	first_name,
	last_name ASC;";

  $result2 = mysqli_query($connect, $mySQL_2);
  if (!$result2) {
      die("Could not successfully run query ($mySQL_2) from $db: " .
          mysqli_error($connect));
  }
  if (mysqli_num_rows($result2) == 0) {
      print("No records found with query $mySQL_2");
  }
  while ($row = mysqli_fetch_assoc($result2)) {
      foreach ($row as $key => $value) {
          $r2[$key][] = $row[$key];
      }
  }
    $r3 = $r2['Actor'];
    $r4 = $r2['Film'];
    $c = array_combine_($r3, $r4);
    $filmCount = array_count_values($r2['Actor']);
    echo "<pre>";
    print_r($c);
    echo "</pre>";
    $outputFile = fopen("writeActors.txt", "w");









     ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
