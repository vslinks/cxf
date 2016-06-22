<?php
if(empty(!$_POST)){
    //>>进行post 提交
    echo json_encode($_POST);
}
if(!empty($_GET)){
    echo json_encode($_GET);
}

