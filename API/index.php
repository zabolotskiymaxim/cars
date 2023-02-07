<?php 
include_once("functions.php");
include_once("find_token.php");
include_once("error_handler.php");

if(preg_match_all("/^add_car$/ui", $_GET['type'])){
    if(!isset($_GET['title'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр title!",
            "ERROR",
            null
        );
        exit;
    }
    if(!isset($_GET['description'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр description!",
            "ERROR",
            null
        );
        exit;
    }
    if(!isset($_GET['price'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр price!",
            "ERROR",
            null
        );
        exit;
    }
    if(!isset($_GET['year'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр year!",
            "ERROR",
            null
        );
        exit;
    }

    $query = "INSERT INTO `cars`(`title`, `description`, `price`, `year`) VALUES ('".$_GET['title']."', '".$_GET['description']."',".$_GET['price'].",".$_GET['year'].")";
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            null
        );
        exit($query);
    }
    
    echo ajax_echo(
        "Успех!",
        "Машина добавлена",
        false,
        "SUCCESS"
    );
    exit;
}

else if(preg_match_all("/^add_user$/ui", $_GET['type'])){
    if(!isset($_GET['login'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр login!",
            "ERROR",
            null
        );
        exit;
    }
    if(!isset($_GET['password'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр password!",
            "ERROR",
            null
        );
        exit;
    }

    $query = "INSERT INTO `users`(`login`, `password`) VALUES ('".$_GET['login']."','".$_GET['password']."')";
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            null
        );
        exit($query);
    }
    
    echo ajax_echo(
        "Успех!",
        "Пользователь добавлен",
        false,
        "SUCCESS"
    );
    exit;
}

else if(preg_match_all("/^send_message$/ui", $_GET['type'])){
    if(!isset($_GET['car_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр car_id!",
            "ERROR",
            null
        );
        exit;
    }
    if(!isset($_GET['user_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр user_id!",
            "ERROR",
            null
        );
        exit;
    }
    if(!isset($_GET['message'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр message!",
            "ERROR",
            null
        );
        exit;
    }

    $query = "INSERT INTO `chats`(`car_id`, `user_id`, `message`) VALUES (".$_GET['car_id'].",".$_GET['user_id'].",'".$_GET['message']."')";
    
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            null
        );
        exit($query);
    }
    
    echo ajax_echo(
        "Успех!",
        "Сообщение добавлено",
        false,
        "SUCCESS"
    );
    exit;
}


else if(preg_match_all("/^update_car$/ui", $_GET['type'])){
    if(!isset($_GET['car_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр car_id!",
            "ERROR",
            null
        );
        exit;
    }

    $title = '';
    if(isset($_GET['title'])){
        $title = "`title` = '".$_GET['title']."',";
    }
    $description = '';
    if(isset($_GET['description'])){
        $description = "`description`='".$_GET['description']."',";
    }
    $price = '';
    if(isset($_GET['price'])){
        $price = "`price` = ".$_GET['price'].",";
    }
    $year = '';
    if(isset($_GET['year'])){
        $year = "`year`=".$_GET['year'].",";
    }
    $deleted = 'false';
    if(isset($_GET['deleted'])){
        $deleted = $_GET['deleted'];
    }

    $query = "UPDATE `cars` SET ".$title.$description.$price.$year."`deleted`=".$deleted." WHERE `id`=".$_GET['car_id'];
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            "ERROR",
            null
        );
        exit;
    }
    
    echo ajax_echo(
        "Успех!",
        "Машина изменена",
        false,
        "SUCCESS"
    );
    exit;
}

else if(preg_match_all("/^update_user$/ui", $_GET['type'])){
    if(!isset($_GET['user_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр match_id!",
            "ERROR",
            null
        );
        exit;
    }

    $login = '';
    if(isset($_GET['login'])){
        $login = "`login` = '".$_GET['login']."',";
    }
    $deleted = 'false';
    if(isset($_GET['deleted'])){
        $deleted = $_GET['deleted'];
    }

    $query = "UPDATE `users` SET ".$login." `deleted`=".$deleted." WHERE `id`=".$_GET['user_id'];
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            "ERROR",
            null
        );
        exit;
    }
    
    echo ajax_echo(
        "Успех!",
        "Пользователь изменен",
        false,
        "SUCCESS"
    );
    exit;
}

else if(preg_match_all("/^update_sold_cars$/ui", $_GET['type'])){
    if(!isset($_GET['sold_car_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали GET параметр sold_car_id!",
            "ERROR",
            null
        );
        exit;
    }

    $car_id = '';
    if(isset($_GET['car_id'])){
        $car_id = "`car_id` = ".$_GET['car_id'].",";
    }
    $deleted = 'false';
    if(isset($_GET['deleted'])){
        $deleted = $_GET['deleted'];
    }

    $query = "UPDATE `sold_cars` SET ".$car_id."`deleted`=".$deleted." WHERE `id`=".$_GET['sold_car_id'];
    $res_query = mysqli_query($connection, $query);
    
    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            "ERROR",
            null
        );
        exit;
    }
    
    echo ajax_echo(
        "Успех!",
        "Проданная машина изменена",
        false,
        "SUCCESS"
    );
    exit;
}


else if(preg_match_all("/^list_cars$/ui", $_GET['type'])){

    $query = "SELECT * FROM `cars` WHERE `deleted`=false";
    $res_query = mysqli_query($connection,$query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!", 
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $arr_res = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++){
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_res, $row);
    }
    echo ajax_echo(
        "Успех!", 
        "Список машин выведен",
        false,
        "SUCCESS",
        $arr_res
    );
    exit();
}

else if(preg_match_all("/^list_users$/ui", $_GET['type'])){
    $query = "SELECT `id`,`login` FROM `users` WHERE `deleted`=false";
    $res_query = mysqli_query($connection,$query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!", 
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $arr_res = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++){
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_res, $row);
    }
    echo ajax_echo(
        "Успех!", 
        "Список пользователей выведен",
        false,
        "SUCCESS",
        $arr_res
    );
    exit();
}

else if(preg_match_all("/^list_chats$/ui", $_GET['type'])){

    $query = "SELECT * FROM `chats` WHERE `deleted`=false";
    $res_query = mysqli_query($connection,$query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!", 
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $arr_res = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++){
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_res, $row);
    }
    echo ajax_echo(
        "Успех!", 
        "Список чатов выведен",
        false,
        "SUCCESS",
        $arr_res
    );
    exit();
}

else if(preg_match_all("/^list_sold_cars$/ui", $_GET['type'])){

    $query = "SELECT * FROM `sold_cars` WHERE deleted=false";
    $res_query = mysqli_query($connection,$query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!", 
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $arr_res = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++){
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_res, $row);
    }
    echo ajax_echo(
        "Успех!", 
        "Список проданных машин выведен",
        false,
        "SUCCESS",
        $arr_res
    );
    exit();
}

else if(preg_match_all("/^profit$/ui", $_GET['type'])){
    $query = "SELECT sum(price) AS `SUM` FROM `cars` WHERE id IN (SELECT `car_id` FROM `sold_cars`)";
    $res_query = mysqli_query($connection,$query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!", 
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $arr_res = array();
    $rows = mysqli_num_rows($res_query);

    for ($i=0; $i < $rows; $i++){
        $row = mysqli_fetch_assoc($res_query);
        array_push($arr_res, $row);
    }
    echo ajax_echo(
        "Успех!", 
        "Прибыль выведена",
        false,
        "SUCCESS",
        $arr_res
    );
    exit();
}
