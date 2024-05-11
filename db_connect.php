<!-- Reference -connection to db W3schools.com - https://www.w3schools.com/php/php_mysql_connect.asp -->
 <?php
       $connect= mysqli_connect('localhost','root','','swim_management');

        if(!$connect){
           echo'connection failed : '.mysqli_connect_error();
         }
         
?>


