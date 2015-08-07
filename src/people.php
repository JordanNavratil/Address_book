<?php
class People
{
    private $name;
    private $phone_number;
    private $address;
    function __construct($person_name, $person_phone_number, $person_address)

    {
        $this->name = $add_name;
        $this->phone_number = $add_phone_number;
        $this->address = $add_address;
    }
    function setName ($new_name)
    {
        $this->name = (string) $new_name;
    }
    function getName ()
    {
        return $this->name;
    }
    function setPhone_Number ($new_phone_number)
    {
        $this->setPhone_Number = (int) $new_phone_number;
    }
    function getPhone_Number ()
    {
        return $this->phone_number;
    }
    function setAddress($new_address)
    {
        $this->address = (string) $new_address;
    }
    function getAddress()
    {
        return $this->address;
    }
    function save()
    {
        array_push($_SESSION['address_book'], $this);
    }

    static function getAll()
    {
        return $_SESSION['address_book'];
    }
    static function deleteAll()
    {
        $_SESSION['address_book']= array();
    }
}
?>
