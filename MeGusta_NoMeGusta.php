<?php
require_once ("Conexion.php");

$memberId = 1;
$commentId = $_POST['comentario_id'];
$likeOrUnlike = 0;
if($_POST['like_unlike'] == 1)
{
$likeOrUnlike = $_POST['like_unlike'];
}

$sql = "SELECT * FROM megusta_nomegusta WHERE comentario_id=" . $commentId . " and member_id=" . $memberId;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if (! empty($row)) 
{
    $query = "UPDATE megusta_nomegusta SET like_unlike = " . $likeOrUnlike . " WHERE  comentario_id=" . $commentId . " and member_id=" . $memberId;
} else
{
    $query = "INSERT INTO megusta_nomegusta(member_id,comentario_id,like_unlike) VALUES ('" . $memberId . "','" . $commentId . "','" . $likeOrUnlike . "')";
}
mysqli_query($conn, $query);

$totalLikes = "No ";
$likeQuery = "SELECT sum(like_unlike) AS likesCount FROM megusta_nomegusta WHERE comentario_id=".$commentId;
$resultLikeQuery = mysqli_query($conn,$likeQuery);
$fetchLikes = mysqli_fetch_array($resultLikeQuery,MYSQLI_ASSOC);
if(isset($fetchLikes['likesCount'])) {
    $totalLikes = $fetchLikes['likesCount'];
}

echo $totalLikes;
?>