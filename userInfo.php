<?php

// sprawdz czy nie wysłano formularza z wiadomościa do użytkownika
// jesli tak to zostaje on zapisany do tabeli z wiadomościami
// jako odbiorca zostanie ustawiony uzytkownik o id przekazanym w %_GET['user_id']
// jako nadawca zostanie ustawiony user z sesji $_SESSION['logged_user_id']




// pobierz z bazy użytkownika o id = $_GET['user_id'];

// wyswietl formularz do wysyłania wiadomości do usera przez method="post" action="#"
// zawiera pole <textarea> na tresc wiadomości

//wyswietlamy dane usera
