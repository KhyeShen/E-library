<?php  
//action.php
$connect = mysqli_connect('localhost', 'root', '', 'elibrary');

$input = filter_input_array(INPUT_POST);

$material_title = mysqli_real_escape_string($connect, $input["material_title"]);
$author_name = mysqli_real_escape_string($connect, $input["author_name"]);
$publish_year = mysqli_real_escape_string($connect, $input["publish_year"]);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE material 
 SET material_title = '".$material_title."', 
 author_name = '".$author_name."'
 WHERE material_ID = '".$input["material_ID"]."'
 ";
mysqli_query($connect, $query);
//  if($update != null)
//  {
//     echo '<script>alert("Update Failure")</script>';
//  };

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM tbl_user 
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($connect, $query);
}

echo json_encode($input);

?>