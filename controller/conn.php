<?php
  // $conn = mysqli_connect("my","bscfypwb_khyeshen","G^MPB##NaAf7","bscfypwb_E-library");
  $conn = mysqli_connect("localhost","root","","elibrary");
  
  //Connection Failure
  if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>