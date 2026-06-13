RowerOwo

PHP 8, Laravel, MariaDB , HTML5 + CSS3

Co spełnia
-Rejestracja i logowanie oparte o bazę danych, hasła szyfrowane
-Dodawanie użytkowników
-Trzy poziomy uprawnień: klient, kierownik, administrator
-Po zalogowaniu każda rola widzi inne strony
-Panel admina z zarządzaniem użytkownikami
-Walidacja formularzy 

Funkcjonalności sklepu
Koszyk trzymany w sesji
Dodawanie i usuwanie produktów (kierownik, administrator)
Realizacja złożonych zamówień przez Kierownika, zmiana srtatusów
link aktywacyjny dla klienta
Składanie zamówień przez klienta
Historia zamówień

composer install
php artisan migrate --seed
php artisan serve

Aplikacja działa pod adresem http://127.0.0.1:8000
