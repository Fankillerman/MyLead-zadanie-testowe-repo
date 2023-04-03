<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Zadanie rekrutacyjne Backend Developer (Laravel)

## Zadania

1. Przygotować projekt oparty o framework Laravel (najnowsza wersja) oraz silnikiem bazy danych MySQL

2. Przygotować strukturę bazodanową umożliwiająca przechowywanie produktów wraz z cenami (jeden produkt może być
   dostępny w wielu cenach), a każdy produkt posiada swój opis.

3. Przygotować endpointy, które umożliwią wylistowanie produktów, a także przedstawienie informacji szczegółowych o
   wybranym produkcie. Dodatkowo dla użytkownika zalogowanego możliwe będzie zarządzanie produktami (dodawanie,edycja,
   usuwanie). Lista produktów powinna umożliwiać sortowanie i filtrowanie.

4. Dodatkowo mile widziane jest pokrycie aplikacji testami.

## Komentarze

- W drugim zadaniu użyłem relacji jeden do wielu między tabelami z produktami i cenami oraz między produktami i
  kategoriami
- W przypadku endpointów użyłem wbudowanego w Laravel mechanizmu routingu o nazwie routes
- Cały kod kontrolera odpowiedzialny za funkcjonalność wprowadziłem do usługi klasy, ponieważ pozwala to uniknąć
  powtarzania kodu w przyszłości
- Do testowania użyłem Feature tests ponieważ testy te sprawdzają działanie aplikacji z punktu widzenia użytkownika i
  symulują działania użytkownika
- Do wypełnienia bazy danych wykorzystano seeder i factory

## Konfiguracja projektu

1. Sklonuj repozytorium na swój komputer

2. Stwórz wirtualne środowisko

3. Przejdź do katalogu projektu

4. Zainstaluj zależności:   `` composer install``

5. Skopiuj plik .env.example w .env:  ``  cp .env.example .env``

6. Wygeneruj klucz aplikacji:`` php artisan key:generate``

7. Skonfiguruj połączenie z bazą danych w pliku .env:

``` 
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=database_name
    DB_USERNAME=database_username
    DB_PASSWORD=database_password
```

8. Wykonaj migracje, aby utworzyć tabele w bazie danych:``php artisan migrate``


9. Uruchom serwer aplikacji :``php artisan serve``

## Testowanie

Możesz uruchomić testy za pomocą polecenia:

```
    php artisan test
```



