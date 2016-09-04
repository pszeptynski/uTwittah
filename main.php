<?php
// sprawdz czy user is logged, jesli nie to -> na strone logowania (GET)
//
// Zapisujemy wpis jesli zostal przestlany z formularza POST
// id z sesji - zalogwoany user
//
// pobierz wszystkie wpisy z bazy ORDER BY od najnowszego do najstarszego
// zeby pobrac wpisy wraz z nazwa autora musimy zrobic SELECT z JOIN
//
// wywietl formularz do dodawania nowego wpisu
// formularz sklada sie z pola <textarea> i submita do przysylania go
//
//
//
// wyswietl wszystkie wpisy
/* Nazwa usera, data
 * Treść wpisu
 */
// klikniecie na nazwe uzytkownika przenosi na strone userInfo.php?user_id=$id_uzytkownika
// zrobic template do htmla, zeby sie zawsze taki sam wyswietlal


require_once('src/User.php');
require_once('src/Post.php');
require_once('src/connection.php');

// wywołaj statyczną metodę loadAllPosts
//$allPosts = Post::loadAllPosts($conn);
//var_dump($allPosts);
include('html/header.html');
?>


<center><h2>Wszystkie wpisy:</h2></center>

<table border="3">
    <thead>
        <tr>
            <th>Numer wpisu</th>
            <th>Nazwa użytkownika</th>
            <th>Treść</th>
            <th>Data utworzenia</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $allPosts = Post::loadAllPosts($conn);
        foreach ($allPosts as $row) {
            $userID = $row->getUserID();
            $username = User::loadUserByID($conn, $userID);
//                var_dump($username);
            echo "<tr>";
//                var_dump($row);
            echo " <td>" . $row->getID() . "</td>";
            echo " <td>" . $username->getUsername() . "</td>";
            echo " <td>" . $row->getPostContent() . "</td>";
            echo " <td>" . $row->getCreationDate() . "</td>";
            echo "</tr>";
        }



        $conn->close();
        $conn = null;
        ?>

    </tbody>
</table>

<?php
include('html/footer.html');
?>
