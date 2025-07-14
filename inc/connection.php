<?php
function dbconnect() 
{
    static $connect = null; 
    if ($connect === null) 
    {
        $connect = mysqli_connect('localhost', 'ETU004173', 'O41g5qN9', 'db_s2_ETU004173');

        if (!$connect) 
        {
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }

        mysqli_set_charset($connect, 'utf8mb4');
    }
    return $connect;
}
?>
