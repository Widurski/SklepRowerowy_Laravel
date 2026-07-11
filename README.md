RowerOwo

PHP 8, Laravel, MariaDB , HTML5 + CSS3

Wymagany PHP 8.4 lub nowszy.

Co spełnia
- Rejestracja i logowanie oparte o bazę danych, hasła szyfrowane
- Dodawanie użytkowników
- Trzy poziomy uprawnień: klient, kierownik, administrator
- Po zalogowaniu każda rola widzi inne strony
- Panel admina z zarządzaniem użytkownikami
- Walidacja formularzy 

- Funkcjonalności sklepu
- Koszyk trzymany w sesji
- Dodawanie i usuwanie produktów (kierownik, administrator)
- Realizacja złożonych zamówień przez Kierownika, zmiana srtatusów
- link aktywacyjny dla klienta
- Składanie zamówień przez klienta
- Historia zamówień

- composer install
- php artisan migrate --seed
- php artisan serve

Aplikacja działa pod adresem http://127.0.0.1:8000
php artisan optimize:clear


https://github.com/Widurski/SklepRowerowy_Laravel

Uruchomienie od zera 

1. Wejdź na https://windows.php.net/download/ i pobierz paczkę
   **PHP 8.4 (x64) Non Thread Safe** (plik ZIP).
2. Rozpakuj zawartość ZIP-a do np. `C:\php`.
3. W folderze `C:\php` skopiuj plik `php.ini-development` i zmień jego nazwę
   na `php.ini`.
4. Otwórz `C:\php\php.ini` i odkomentuj (usuń `;` na początku linii)
   następujące rozszerzenia:
   - `extension=curl`
   - `extension=fileinfo`
   - `extension=mbstring`
   - `extension=openssl`
   - `extension=pdo_mysql`
5. Dodaj `C:\php` do zmiennej środowiskowej `PATH`:
   - Wyszukaj w Windows "Edytuj zmienne środowiskowe systemu", otwórz
     "Zmienne środowiskowe", w sekcji "Zmienne systemowe" zaznacz `Path`,
     kliknij "Edytuj", "Nowy", wpisz `C:\php` i zatwierdź OK we wszystkich oknach.
6. Otwórz nowy terminal (np. PowerShell) i sprawdź instalację:
   ```
   php -v
   ```
   Powinna pojawić się wersja PHP 8.4.x.

2. Zainstaluj Composer

1. Pobierz instalator ze strony https://getcomposer.org/download/
   (`Composer-Setup.exe`).
2. Uruchom instalator — gdy zapyta o lokalizację PHP, wskaż `C:\php\php.exe`.
3. Po instalacji sprawdź w nowym terminalu:
   ```
   composer -V
   ```

3. Zainstaluj serwer bazy danych (MariaDB)

1. Pobierz instalator MariaDB ze strony https://mariadb.org/download/
   (wersja "MSI Package" dla Windows x64).
2. Uruchom instalator z domyślnymi ustawieniami. Podczas instalacji ustaw
   hasło dla użytkownika `root` (lub zostaw puste, jeśli instalator na to
   pozwala — plik `.env.example` w tym projekcie zakłada puste hasło).
3. Zaznacz opcję dodania MariaDB do `PATH` (jeśli instalator o to pyta).
4. Po instalacji otwórz terminal i zaloguj się, aby utworzyć bazę danych
   projektu:
   ```
   mysql -u root -p
   ```
   a następnie w konsoli MariaDB:
   ```
   CREATE DATABASE rowerowo;
   EXIT;
   ```

4. Zainstaluj Git (opcjonalnie, do pobrania repozytorium)

1. Pobierz i zainstaluj Git ze strony https://git-scm.com/download/win



5. Pobierz projekt i otwórz go w VS Code

1. Sklonuj repozytorium (lub rozpakuj paczkę ZIP z kodem) do wybranego
   folderu, np.:
   ```
   git clone https://github.com/Widurski/SklepRowerowy_Laravel.git
   ```
2. W VS Code: `File`, `Open Folder...` i wskaż folder projektu.
3. Otwórz zintegrowany terminal: `Terminal`, `New Terminal`.

6. Zainstaluj zależności PHP

W terminalu VS Code, w katalogu głównym projektu:
```
composer install
```

7. Skonfiguruj plik .env

1. Skopiuj plik `.env.example` do `.env`:
   ```
   copy .env.example .env
   ```
2. Otwórz `.env` i upewnij się, że dane bazy danych zgadzają się z tym, co
   ustawiono w kroku 3 (nazwa bazy `rowerowo`, użytkownik `root`, hasło
   ustawione podczas instalacji MariaDB):
   ```
   DB_CONNECTION=mariadb
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=rowerowo
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Wygeneruj klucz aplikacji:
   ```
   php artisan key:generate
   ```

8. Utwórz tabele i dane przykładowe

```
php artisan migrate --seed
```
Polecenie utworzy wszystkie tabele oraz doda przykładowe konta i produkty,
m.in. konto administratora `admin@rowerowo.pl` / hasło `Crmm1234`
(dane logowania zdefiniowane w `database/seeders/DatabaseSeeder.php`).

Konfiguracja poczty (aktywacja konta)

Aplikacja wysyła e-mail z linkiem aktywacyjnym po rejestracji. Do testów
używamy  Mailtrap https://mailtrap.io —

1. Załóż darmowe konto
2. Wejdź w Email Testing i skopiuj 

   MAIL_MAILER=smtp
   MAIL_SCHEME=null
   MAIL_HOST=sandbox.smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=twoj_username_z_mailtrap
   MAIL_PASSWORD=twoje_haslo_z_mailtrap
   ```
4. Po rejestracji nowego konta wejdź na https://mailtrap.io i sprawdź inbox

9. Uruchom aplikację

```
php artisan serve
```

10. Otwórz aplikację w przeglądarce

Wejdź na http://127.0.0.1:8000

Jeśli po zmianach w konfiguracji (`.env`) lub trasach coś nie działa,
wyczyść cache poleceniem:
```
php artisan optimize:clear
```
