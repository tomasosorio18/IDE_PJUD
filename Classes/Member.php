<?php
namespace Phppot;

class Member
{

    private $ds;

    function __construct()
    {
        require_once __DIR__ . '../../Configuration/DataSource.php';
        $this->ds = new DataSource();
    }



    /**
     * to check if the email already exists
     *
     * @param string $email
     * @return boolean
     */
    public function isEmailExists($email)
    {
        $query = 'SELECT * FROM usuario where USUARIO_CORREO = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function getMember($email)
    {
        $query = 'SELECT * FROM usuario where USUARIO_CORREO = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }
    public function getRol($email)
    {
        
        $query ='SELECT rol.ROL_ID, rol.ROL_NOMBRE, usuario.USUARIO_ID, usuario.USUARIO_NOMBRE,tribunal.TRIBUNAL_ID,tribunal.TRIBUNAL_NOMBRE,tribunal_usu_rol.TUR_ID FROM tribunal_usu_rol
        INNER JOIN rol on tribunal_usu_rol.ROL_ID =rol.ROL_ID
        INNER JOIN usuario on tribunal_usu_rol.USUARIO_ID = usuario.USUARIO_ID
        INNER JOIN tribunal on tribunal_usu_rol.TRIBUNAL_ID = tribunal.TRIBUNAL_ID
        where usuario.USUARIO_CORREO = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $RolMemberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $RolMemberRecord;
    }
    /**
     * to signup / register a user
     *
     * @return string[] registration status message
     */
    public function registerMember()
    {
        // $isUsernameExists = $this->isUsernameExists($_POST["username"]);
        $isEmailExists = $this->isEmailExists($_POST["email"]);
        if ($isEmailExists) {
            $response = array(
                "status" => "error",
                "message" => "El correo ya existe!."
            );
        } else {
            if (! empty($_POST["signup-password"])) {

                // PHP's password_hash is the best choice to use to store passwords
                // do not attempt to do your own encryption, it is not safe
                $hashedPassword = password_hash($_POST["signup-password"], PASSWORD_DEFAULT); //$_POST["signup-password"];
            }
            $name=$_POST["nombre"];
            $apellido=$_POST["apellido"];
            $tribunal=$_POST["selecttribunal"];

            $query = 'INSERT INTO usuario (USUARIO_CONTRASENA, USUARIO_CORREO, USUARIO_NOMBRE, USUARIO_APELLIDO) VALUES (?, ?, ?, ?)';
            $paramType = 'ssss';
            $paramValue = array(    
                $hashedPassword,
                $_POST["email"],
                $name,
                $apellido);

            $memberId = $this->ds->insert($query, $paramType, $paramValue);
            
            if (! empty($memberId)) {
                    $memberRecord = $this->getMember($_POST["email"]);

                if (! empty($memberRecord)) {
                    date_default_timezone_set('America/Cuiaba');
                    $año = date("Y-m-d");
                    $user = $memberRecord[0]["USUARIO_ID"];
                    $query_rol =  'INSERT INTO tribunal_usu_rol (TRIBUNAL_ID,ROL_ID,USUARIO_ID,TUR_FECHA_INICIO,TUR_FECHA_FIN) VALUES (?,?,?,?,?)';
                    $paramType2 = 'iiiss';
                    $paramValue2 = array(    
                        $tribunal,
                        2,
                        $user,
                        $año,
                    NULL);
                        $this->ds->insert($query_rol, $paramType2, $paramValue2);
                }
                


                $response = array(
                    "status" => "success",
                    "message" => "Te has registrado con exito!."
                );
            }
        }
        return $response;
    }

  

    /**
     * to login a user
     *
     * @return string
     */
    public function loginMember()
    { 
        $memberRecord = $this->getMember($_POST["email"]);
        $RolMemberRecord = $this->getRol($_POST["email"]);
        $loginPassword = 0;
        if (! empty($memberRecord)) {
            if (! empty($_POST["login-password"])) {
                $password = $_POST["login-password"];
            }else{
                $loginStatus = "Empty"; 
                return $loginStatus;
            }
            $hashedPassword = $memberRecord[0]["USUARIO_CONTRASENA"];
            $loginPassword = 0;
            if (password_verify($password, $hashedPassword)) {
                $loginPassword = 1;
            }
        } else {
            $loginPassword = 0;
        }
        if ($loginPassword == 1) {
            // login sucess so store the member's username in
            // the session
            session_id($memberRecord[0]['USUARIO_ID']);
            session_start();
            $_SESSION['id'] = $memberRecord[0]['USUARIO_ID'];
            $_SESSION['name'] = $memberRecord[0]['USUARIO_NOMBRE'];
		    $_SESSION['apellido'] = $memberRecord[0]['USUARIO_APELLIDO'];
            $_SESSION["rol"] = $RolMemberRecord[0]['ROL_ID'];
            $_SESSION["tribunal"] =$RolMemberRecord[0]['TRIBUNAL_ID'];
            $_SESSION["tur_id"] =$RolMemberRecord[0]['TUR_ID'];
            $_SESSION["logeado"]=TRUE;
            $_SESSION["inicio"]= time();
            $_SESSION["fin"]=$_SESSION["inicio"] + (100* 60);
            session_write_close();

            
            $url = "Pages/Home-usuario.php";
            $url2 = "Pages/Home-admin.php";
            switch ($_SESSION["rol"]) {
                case 2:
                    header("Location: $url"."?sesion=sesioninicio");
                    break;
                
                case 1:
                    header("Location: $url2"."?sesion=sesioninicio");
                    break;
            }       
        } else if ($loginPassword == 0) {
            $loginStatus = "Error"; 
            return $loginStatus;
        }
    }
}