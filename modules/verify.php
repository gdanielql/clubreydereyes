<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito verificar que los datos introducidos por el usuario en la página de "login" estén correctos.
          Si están correctos, redirige a la página de inicio "dashboard". Si está incorrecto permanece en el login notificándole al usuario
          que hay un error en los datos.
*/
//Se conecta a la base de datos.
     include 'config1.php';

     // una vez oprima el botón de iniciar sesión se corroborarán los datos con la base de datos.
     if(isset($_POST['submit']))
     {
         $nm=$_POST['name'];
         $pass=$_POST['pass'];
        if( isset($nm) && isset($pass))
      {
        if(!empty($nm) && !empty($pass) )
        {
          $stmt = $conn->prepare("SELECT uid, uname FROM user WHERE uname= ? AND password=?");
            $stmt->execute(array($nm,$pass));
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($result))
            {

            $uid = $result[0]['uid'];
						$uname = $result[0]['uname'];
						session_start();

                $_SESSION['islogin'] ="1";
								$_SESSION['uid'] = $uid;
								$_SESSION['uname'] = $uname;

                // Si los datos son correctos redirigir a la página de inicio "dashboard".
							header("location:../index.php?page=dashboard");
            }
            else
            {
              //Si los datos son inválidos notificar al usuario y permanecer en la misma página.
               header("location:../index.php?invalid=y");
            }


          }else
          {
             header("location:../index.php?invalid=y");
          }
        }
      }

?>
