<?php

class verificator
{
   function verificateLOG($email, $password)
   {
       $errors = [];
       $ini_array = parse_ini_file('parameters.ini');
       $pdo = new PDO
       (
           'pgsql:host=' . $ini_array['host'] .
           ';port=' . $ini_array['port'] .
           ';dbname=' . $ini_array['name'] .
           ';user=' . $ini_array['login'] .
           ';password=' . $ini_array['password']);
       $query = "SELECT password, id
                    FROM usr 
                    WHERE email = :email";
       $result = $pdo->prepare($query);
       $result->bindParam(':email', $email, PDO::PARAM_STR);
       $result->execute();

       if ($result->rowCount() != 1)
       {
           $errors[] = "Аккаунт не найден!";
           return $errors;
       }

       $data = $result->fetchAll();
       $passHash = $data[0]["password"];
       if (!password_verify( $password, $passHash))
       {
           $errors[] = "Пароль не верный!";
           return $errors;
       }
       return $data[0]["id"];
   }

   function verificateREG($email, $phone, $password, $repeatPass, $name)
   {
       $errors = [];
       if (!is_numeric($phone))
       {
           $errors[] = "Телефон должен состоять только из цифр!";
       }

       if (is_int($password) || strlen($password) < 7)
       {
           $errors[] = "Пароль должен состоять не только из цифр и его длина не меньше 7!";
       }

       if ($password != $repeatPass)
       {
           $errors[] = "Пароли не совпадают";
       }

       if (!preg_match("/[а-яА-Я]+$/", $name))
       {
           $errors[] = "Имя должно содержать только русские буквы";
       }

       if (!filter_var($email, FILTER_VALIDATE_EMAIL))
       {
           $errors[] = "Неправильный формат email.";
       }

       $ini_array = parse_ini_file('parameters.ini');
       $pdo = new PDO
       (
           'pgsql:host=' . $ini_array['host'] .
           ';port=' . $ini_array['port'] .
           ';dbname=' . $ini_array['name'] .
           ';user=' . $ini_array['login'] .
           ';password=' . $ini_array['password']);
       $query = "SELECT * 
                    FROM usr 
                    WHERE email = :email";
       $result = $pdo->prepare($query);
       $result->bindParam(':email', $email, PDO::PARAM_STR);
       $result->execute();

       if ($result->rowCount() != 0)
       {
           $errors[] = "Такой email уже есть в БД!";
       }

       return $errors;

   }

}