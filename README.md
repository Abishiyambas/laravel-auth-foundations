# Ninja Network
Laravel auth til ninjaer

## Formål
Ninja Network er en læringsapp bygget i Laravel, der demonstrerer autentificering, relationer og CRUD-flows i en simpel domæne-model (ninjas og dojos).

## Funktioner
- Registrering, login og logout med session-regenerering
- Beskyttede routes via `auth`/`guest` middleware
- Ninja CRUD: liste, opret, vis detaljer, slet
- Relationer mellem Ninjas og Dojos (Eloquent)
- Paginering af ninjaliste (10 pr. side)
- Validering af formularer med fejlvisning
- Flash-beskeder ved oprettelse og sletning
- Seeders og factories til demo-data

## Teknologi
- Laravel 12, PHP 8.2+
- Blade templates og komponenter
- Vite + Tailwind CSS
- MySQL eller SQLite

## Datamodel
- `Dojo` har mange `Ninja`
- `Ninja` tilhører én `Dojo`

## Forudsætninger
- PHP 8.2+
- Composer
- Node.js 18+ og npm
- MySQL eller SQLite

## Installation
1. `composer install`
2. `cp .env.example .env`
3. `php artisan key:generate`
4. Konfigurér databasen i `.env`
5. `php artisan migrate --seed`
6. `npm install`
7. `npm run build`

Hvis du vil bruge SQLite:
1. `touch database/database.sqlite`
2. Sæt `DB_CONNECTION=sqlite` og `DB_DATABASE=database/database.sqlite` i `.env`

## Kør lokalt
1. `php artisan serve`
2. `npm run dev`
3. Besøg `http://localhost:8000`

Valgfrit: `composer run dev` (starter server, queue, logs og Vite samtidigt).

## Demo-login (seed)
- Email: `test@example.com`
- Password: `password`

## Ruter
| Metode | Path | Beskyttet | Beskrivelse |
| --- | --- | --- | --- |
| GET | `/` | Nej | Velkomstside |
| GET | `/login` | Guest | Vis login-form |
| POST | `/login` | Guest | Login |
| GET | `/register` | Guest | Vis register-form |
| POST | `/register` | Guest | Opret bruger |
| POST | `/logout` | Auth | Logout |
| GET | `/ninjas` | Auth | List ninjas (paginering) |
| GET | `/ninjas/create` | Auth | Opret ninja (form) |
| POST | `/ninjas` | Auth | Gem ninja |
| GET | `/ninjas/{ninja}` | Auth | Vis ninja og dojo |
| DELETE | `/ninjas/{ninja}` | Auth | Slet ninja |

## Validering (uddrag)
- Register: `name` (max 255), `email` (unik), `password` (min 8, confirmed)
- Login: `email`, `password`
- Ninja: `name` (max 255), `skill` (0-100), `bio` (20-1000), `dojo_id` (skal eksistere)

## Test
- `php artisan test`
