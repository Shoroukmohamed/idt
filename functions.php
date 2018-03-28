<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

function UPDATE($connection,$table_name,$WHERE,$WHERE_VALUE,$TARGET,$SET_VALUE) 
{

    $sql  = "UPDATE $table_name SET $TARGET= $SET_VALUE WHERE $WHERE=$WHERE_VALUE";
    mysqli_query($connection,$sql);
    if($connection->query($sql) === TRUE)
    {
           $data =SELECT($connection,$table_name,$WHERE,$WHERE_VALUE);
           if($data[$TARGET]==$SET_VALUE)return TRUE;
           else return FALSE;
    }  
   else
   {
        return FALSE;  
   }
}



function SELECT ($connection,$table,$column,$value)
{
$sql = "SELECT* FROM $table WHERE $column=$value ";
$result = $connection->query($sql);
if ($result->num_rows > 0)
    {
          $row = $result->fetch_assoc();
          return $row;   
    }
else{
            return FALSE;
    }
}


function DELETE($connection,$table,$column,$value)
{
    $check=SELECT($connection,$table,$column,$value);
    if($check==FALSE) return FALSE;
    $sql = "DELETE FROM $table WHERE $column=$value";
    if ($connection->query($sql) === TRUE)
    {
               $check=SELECT($connection,$table,$column,$value);
               if($check==FALSE) return TRUE;
               else return FALSE;
    }
    else
    {
        return FALSE;    
    }
}

function INSERT($connection,$table,$numberOfColumns, &$columns,&$data)
{
    $request="INSERT INTO $table (";
    $request1="VALUES(";
   for($i= 0;$i<$numberOfColumns;$i++)
   {
      if($i!=($numberOfColumns-1))
      {
          
           $request="$request$columns[$i], ";
           $request1="$request1'$data[$i]', ";
      }
      else
      {
           $request="$request$columns[$i])";
           $request1="$request1'$data[$i]')";
      }
   }
   $sql=$request." ".$request1;
   if($connection->query($sql) === TRUE)
   {
         return TRUE;
    }
    else
    {
    return FALSE;
    }
}

$mobile="2";
$column="id";
$table="user";
$tar="pst_score";
$score=50;
$data=array("Eslam Alaa","01221275631");
$columns=array("name","mobile");
$check=INSERT($conn,$table,2,$columns,$data);
if($check==FALSE) {echo"error";}

?>