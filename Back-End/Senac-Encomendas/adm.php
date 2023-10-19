<?php
class Adm
{
    private $id;
    private $name;
    private $username;
    private $occupation;
    private $specialty;
    private $email;
    private $phone;
    private $password;
    private $userImage;



    public function __construct($id, $name, $username, $occupation, $specialty, $email, $phone, $password, $userImage)
    {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->occupation = $occupation;
        $this->specialty = $specialty;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->userImage = $userImage;
    }


    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getOccupation()
    {
        return $this->occupation;
    }

    public function getSpecialty()
    {
        return $this->specialty;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUserImage()
    {
        return $this->userImage;
    }

    public function setNome($newName)
    {
        $this->name = $newName;
    }

    public function setUsername($newUsername)
    {
        $this->username = $newUsername;
    }

    public function setOccupation($newOccupation)
    {
        $this->occupation = $newOccupation;
    }

    public function setSpecialty($newSpecialty)
    {
        $this->specialty = $newSpecialty;
    }

    public function setEmail($newEmail)
    {
        $this->email = $newEmail;
    }

    public function setPhone($newPhone)
    {
        $this->phone = $newPhone;
    }

    public function setPassword($newPassword)
    {
        $this->password = $newPassword;
    }

    public function setUserImage($newUserImage)
    {
        $this->userImage = $newUserImage;
    }

    public function __toString()
    {
        $texto = "";
        $texto .= "Nome: " . $this->name . "<br>";
        $texto .= "Username: " . $this->username . "<br>";
        $texto .= "Occupation: " . $this->occupation . "<br>";
        $texto .= "Specialty: " . $this->specialty . "<br>";
        $texto .= "Email: " . $this->email . "<br>";
        $texto .= "Phone: " . $this->phone . "<br>";
        $texto .= "Password: " . $this->password . "<br>";

        return $texto;
    }
}
