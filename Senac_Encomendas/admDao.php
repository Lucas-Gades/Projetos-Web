<?php
include "conexao.php";
include_once "adm.php";

class AdmDao
{

    public static function inserir($adm)
    {
        $con = Conexao::getConexao();
        $sql = $con->prepare("insert into adm_register values (null,?, ?, ?, ?, ?, ?, ?, ?)");


        $name = $adm->getName();
        $username = $adm->getUsername();
        $occupation = $adm->getOccupation();
        $specialty = $adm->getSpecialty();
        $email = $adm->getEmail();
        $phone = $adm->getPhone();
        $password = $adm->getPassword();
        $userImage = $adm->getUserImage();

        $sql->bindParam(1, $name);
        $sql->bindParam(2, $username);
        $sql->bindParam(3, $occupation);
        $sql->bindParam(4, $specialty);
        $sql->bindParam(5, $email);
        $sql->bindParam(6, $phone);
        $sql->bindParam(7, $password);
        $sql->bindParam(8, $userImage);

        $sql->execute();
    }
}
