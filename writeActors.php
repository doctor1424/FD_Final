<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Actors</title>
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
  $mySQL = "SELECT
	CONCAT(last_name,
	' ',
	first_name)AS Actor,
	title AS Film
FROM
	film_actor AS t1
INNER JOIN actor AS t2 ON
	t1.actor_id = t2.actor_id
INNER JOIN film AS t3 ON
	t1.film_id = t3.film_id
ORDER BY
	last_name, first_name ASC;";

  $result = mysqli_query($connect, $mySQL);
  if (!$result) {
      die("Could not successfully run query ($mySQL) from $db: " .
          mysqli_error($connect));
  }
  if (mysqli_num_rows($result) == 0) {
      print("No records found with query $mySQL");
  }
  while ($row = mysqli_fetch_assoc($result)) {
      foreach ($row as $key => $value) {
          $a[$key][] = $row[$key];
      }
  }
    $actorList = $a['Actor'];
    $aList = array_values(array_unique($actorList));
    foreach ($aList as $key => $value) {
        $name[$value] = explode(' ', $value);
    }
    $filmList = $a['Film'];
    $combinedList = array_combine_($actorList, $filmList);
    $filmCount = array_count_values($a['Actor']);
    $finalList = array_merge_recursive($name, $filmCount, $combinedList);
    $outputFile = fopen("Text_Files/writeActors.txt", "rw") or die("Unable to open file!");
    foreach ($finalList as $key => $value) {
        $txt = $finalList[$key][0].",".$finalList[$key][1].":".$finalList[$key][2].":";
        fwrite($outputFile, $txt);
        for ($i=3; $i <= ((sizeof($finalList[$key]))-1); $i++) {
            $txt1 = $finalList[$key][$i].",";
            fwrite($outputFile, $txt1);
            if ($i == (sizeof($finalList[$key])-1)) {
                fwrite($outputFile, "\n");
            }
        }
    }
    ?>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Last</th>
          <th scope="col">First</th>
          <th scope="col">Films Appeared</th>
          <?php
          $e = 1;
          foreach ($finalList as $key => $value) {
              while ($e <= $finalList[$key][2]) {
                  echo "<th scople='col'>Film".$e."</th>";
                  $e++;
              }
          }
           ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $f = 1;
        foreach ($finalList as $key => $value) {
            echo "<tr>";
            echo "<th scope = 'row'>".$f."</th>";
            echo "<td>".$finalList[$key][0]."</td>";
            echo "<td>".$finalList[$key][1]."</td>";
            echo "<td>".$finalList[$key][2]."</td>";
            for ($i=3; $i <= ((sizeof($finalList[$key]))-1); $i++) {
                echo "<td>".$finalList[$key][$i].",";
            }
            $f++;
            echo "</tr>";
        }
        fclose($outputFile);
        mysqli_close($connect);
         ?>
      </tbody>
    </table>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
