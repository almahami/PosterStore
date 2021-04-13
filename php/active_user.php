<?php

    session_start();
    error_reporting();

    try{

        $fpConnection =mysqli_connect("127.0.0.1", "root", "", "poster_store");         // DB connection 
        if(! $fpConnection){    	                                                    // Error  
            echo "Fehler: Verbindung kann nich gestellt werden"- PHP_EQL;
            echo "Debug Fehlernummer " . mysqli_connect_errno(). PHP_EQL;
            echo "Debugb Fehlernummer ". mysqli_connect.eroor(). PHP_EQL;
        }

        $activ_user ="SELECT * FROM user WHERE online=true"; // number of active user
        //echo $activ_user;
        $result=mysqli_query($fpConnection,$activ_user);
        if ($result)
    	{
            $rowcount=mysqli_num_rows($result);
            $_SESSION['active_user']=$rowcount;
            echo $rowcount;
        }
            mysqli_close($fpConnection);        //db schließen 
    }
    catch(Exception $e){
        echo "Fehler bei der Verbindung ". $e;
    }

?>