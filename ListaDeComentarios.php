<?php
require_once ("Conexion.php");
$memberId = 1;
$sql = "SELECT comentario.*,megusta_nomegusta.like_unlike FROM comentario LEFT JOIN megusta_nomegusta ON comentario.comentario_id = megusta_nomegusta.comentario_id AND member_id = " . $memberId . " ORDER BY parent_comentario_id asc, comentario_id asc";

$result = mysqli_query($conn, $sql);
$record_set = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($record_set, $row);
}
mysqli_free_result($result);

mysqli_close($conn);
echo json_encode($record_set);
?>