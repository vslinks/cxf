<?php
if(empty(!$_POST)){
    //>>����post �ύ
    echo json_encode($_POST);
}
if(!empty($_GET)){
    echo json_encode($_GET);
}

