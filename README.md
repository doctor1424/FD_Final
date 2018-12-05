# File and Database Final
Each individual will turn in the files listed in this assignment. You are to work on this assignment ALONE.
Do not discuss this assignment with anyone else in the class or outside of the class (this includes tutors –
I am the only person you may discuss this assignment with). You may use Google, your notes, and
whatever other resources you want to solve these problems. If you use any code from the internet,
make sure to site where you got your code from.

## Assignment Instructions
**Tasks 1** and **2** will be written in html and php files (see directions below). **Task 3** will be turned in via a
single pdf file titled **finalExam.pdf**. (If you submit in some other format other than PDF your
submission will not be counted). ***These files are to be submitted to UTC Learn Under “TestSubmission”
-&gt; “FinalExam”.***

## Task 1:
1. Create a file titled writeActors.php. This file should query your database to find all the movies
that each actor starred in. You need to write to a text file a record for each actor. The record
should contain the first and last name of the actor, the number of films they starred in, and a list
of the films. You should also write this information to an HTML table with 3 columns. Use the
format shown below. (note that Julia Fawcett actually starred in 15 films, below is simply to
demonstrate the file format). Both the html table and the text file should be sorted by actor last
name.
```
Last Name, First Name:number of films:filmTitle,filmTitle1,filmTitle2;\n

```
You may use any combination of SQL / PHP you wish. You can write a fancy SQL statement to do some
processing for you, or you can simply use SQL to “grab” the info from the database, then use PHP to
process the info. If you concatenate actor last name and first name you will have a unique value you can
use as a key in an associative array.

## Task 2:
1. For this task you will create a reverse SHA lookup website. A user will be able to provide a SHA
hash value, and you should present the string that created the SHA value. You are given 3 input
files, **sha1_list.txt, sha224_list.txt, and sha256_list.txt**. Each file has the
given word followed by its hash value, separated by a colon. Each file uses the algorithm
specified in the file name.

2. A user should be able to access an html file called **sha.html**, and enter a sha hash value that
will be submitted to a file called **sha.php**.

3. The **sha.php** file should load the information from the 3 text files into a data structure of your
choice. (note that the hash values are unique among all 3 files, so you can use the hash value as a key in an associative array). Next, the php script should search for the string that generated
the given hash value.

4. Your php script should generate a dynamic html file that displays the hash value that was
searched for, along with either the string that generated the hash value, or a message indicating
that the value could not be found in the server’s records.

5. You should include a button and an input form that allows the user to search for another string[
and triggers the same php script again.

### Known Issues:
Within the **writeActors.php**, currently when accessing the sakila database it acesses a list of **actors, the number of films appeared in, and the title of each film**. When putting the actors names into an array were get unique name values but this takes out actors with the same first and last names but different actorID numbers. Working on fix.
