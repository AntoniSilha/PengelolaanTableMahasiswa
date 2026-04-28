<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "kampus";
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 $sql = "SELECT nim,nama, prodi FROM mahasiswa";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
 // output data of each row
 while ($row = $result->fetch_assoc()) {
 echo "nim: " . $row["nim"] . " - Name: " . $row["nama"] . " " .
 $row["prodi"] . "<br>";
 }
 } else {
 echo "0 results";
 }
 $conn->close();
 ?>