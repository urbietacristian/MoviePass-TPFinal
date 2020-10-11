<?php
    namespace Repository;

    use Models\User as User;

    interface IClientRepository
    {
        function Add(User $newClient);
        function GetAll();
        function GetById($id);
    }
?>