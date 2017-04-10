<?php

class User {

    private $id;
    private $username;
    private $hashedPassword;
    private $email;
    private $dateRegistered;

    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->email - "";
        $this->hashedPassword = "";
        $this->dateRegistered = "";
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($newPassword) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setDateRegistered($dateRegistered) {
        $this->dateRegistered = $dateRegistered;
    }

    public function getID() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDateRegistered() {
        return $this->dateRegistered;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            //saving new user to DB
            $sql = "INSERT INTO users(username, email, hashed_password, date_registered)
                    VALUES ('$this->username', '$this->email', '$this->hashedPassword','$this->dateRegistered')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {
            $sql = "UPDATE users SET username='$this->username',
                                      email='$this->email',
                                      hashed_password='$this->hashedPassword'
                                      date_registered='$this->dateRegistered'
                    WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    static public function loadUserByID(mysqli $connection, $id) {
        $sql = "SELECT * FROM users WHERE id=$id";

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];
            $loadedUser->dateRegistered = $row['date_registered'];
            return $loadedUser;
        }
        return null;
    }

    static public function loadAllUsers(mysqli $connection) {
        $sql = "SELECT * FROM users";
// Tworzymy pustą tablicę którą potem wypełnimy obiektami wczytanymi z bazy danych
        $ret = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $loadedUser->email = $row['email'];
                $loadedUser->dateRegistered = $row['date_registered'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

    public function delete(mysqli $connection) {
        if ($this->id != -1) {
            $sql = "DELETE FROM users WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1; // Jako, że usunęliśmy obiekt to zmieniamy jego id na -1
                return true;
            }
            return false;
        }
        return true; // jeśli obiektu nie było w bazie, to można od razu zwrócić true
    }

}
