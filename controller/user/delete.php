<?
if(isset($_GET['id'])){
    $user_id = $_GET['id'];
    delete1Where($mysqli,'users','user_id',$user_id);
}
?>