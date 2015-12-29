<?php

class AdminController
{
    public static function actionView()
    {
        include_once ROOT . "/application/views/AdminView.php";
    }

    public static function actionAddImage()
    {
        var_dump($_FILES);
        foreach ($_FILES['files']['name'] as $index => $name)
            if($_FILES['files']['error'][$index] == UPLOAD_ERR_OK
                and move_uploaded_file($_FILES['files']['tmp_name'][$index], ROOT . '/templates/images/' . $name))
            {

            }
    }
}