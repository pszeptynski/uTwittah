<?php

// klasa do wyświetlania postów aka twitów

class Post {

    private $id;
    private $userID;
    private $postContent;
    private $creationDate;

    public function __construct() {
        $this->id = -1;
        $this->userID = "";
        $this->postContent = "";
        $this->creationDate = "";
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setPostContent($postContent) {
        $this->postContent = $postContent;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate - $creationDate;
    }

    public function getID() {
        return $this->id;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getPostContent() {
        return $this->postContent;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    static public function loadPostByID(mysqli $connection, $id) {
        $sql = "SELECT * FROM `posts` WHERE id=$id";

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedPost = new Post();
            $loadedPost->id = $row['id'];
            $loadedPost->userID = $row['user_id'];
            $loadedPost->postContent = $row['post_content'];
            $loadedPost->creationDate = $row['creation_date'];
            return $loadedPost;
        }
        return null;
    }

    static public function loadAllPostsByUserID(mysqli $connection, $userID) {
        $sql = "SELECT * FROM `posts` WHERE user_id=$userID";
        // Tworzymy pustą tablicę którą potem wypełnimy obiektami wczytanymi z bazy danych
        $allPostsByUser = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedPost = new Post();
                $loadedPost->id = $row['id'];
                $loadedPost->userID = $row['user_id'];
                $loadedPost->postContent = $row['post_content'];
                $loadedPost->creationDate = $row['creation_date'];
                $allPostsByUser[] = $loadedPost;
            }
        }
        return $allPostsByUser;
    }

    static public function loadAllPosts(mysqli $connection) {
        // load all posts in reverse order
        $sql = "SELECT * FROM `posts` ORDER BY `id` DESC";
        //all columns
//        $sql = "SELECT * FROM `posts` JOIN `users` ON users.id = posts.user_id ORDER BY `posts`.id DESC";
        // selected columns
//          $sql = "SELECT posts.id, user_id, username, post_content, creation_date
//                    FROM  `posts` JOIN  `users` ON users.id = posts.user_id
//                    ORDER BY  `posts`.id DESC ";
        // Tworzymy pustą tablicę którą potem wypełnimy obiektami wczytanymi z bazy danych
        $allPosts = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
//                var_dump($row);
                $loadedPost = new Post();
                $loadedPost->id = $row['id'];
                $loadedPost->userID = $row['user_id'];
//                $loadedPost->username = $row['username'];
                $loadedPost->postContent = $row['post_content'];
                $loadedPost->creationDate = $row['creation_date'];
                $allPosts[] = $loadedPost;
            }
        }
        return $allPosts;
    }

    public function savePostToDB(mysqli $connection) {
        if ($this->id == -1) {
            //saving new post to DB
            $sql = "INSERT INTO `posts` (user_id, post_content, creation_date)
                    VALUES ('$this->userID', '$this->postContent', '$this->creationDate')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
// uncomment if editing posts enabled in the future
//        } else {
//            $sql = "UPDATE `posts` SET user_id='$this->userID',
//                                       post_content='$this->postContent',
//                                       creation_date='$this->creationDate'
//                    WHERE id=$this->id";
//            $result = $connection->query($sql);
//            if ($result == true) {
//                return true;
//            }
//        }
            return false;
        }
    }

}
