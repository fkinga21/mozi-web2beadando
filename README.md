# Mozi – Web-programozás 2 beadandó

A Művészfilm Kht. mozijainak, filmjeinek és előadásainak adatait bemutató Laravel webalkalmazás.

**Készítette:** Fődi Kinga (EW67RO), Lőrik Levente (AICYHB)
**Élő oldal:** http://mozi.nhely.hu

## Funkciók

| Menü | Útvonal | Leírás | Jogosultság |
|------|---------|--------|-------------|
| Főoldal | `/` | Összesített statisztikák (filmek, mozik, előadások, nézők, bevétel) | mindenki |
| Adatbázis | `/adatbazis` | Filmek, mozik és előadások táblázatai, szűrés és lapozás | mindenki |
| Kapcsolat | `/kapcsolat` | Üzenetküldő űrlap szerver oldali validációval | mindenki |
| Diagram | `/diagram` | Havi bevétel, városonkénti nézőszám, top 10 film (Chart.js) | mindenki |
| Üzenetek | `/uzenetek` | A beküldött üzenetek listája | bejelentkezett felhasználó |
| CRUD | `/film` | Filmek létrehozása, listázása, módosítása, törlése | admin |

## Technológiák

- PHP 8.2+, Laravel 12
- Blade sablonok, Bootstrap 5 (Bootswatch Minty téma), Chart.js
- MySQL (éles), SQLite (helyi fejlesztés)

## Adatbázis

- `film` – id, cim, ev, hossz
- `mozi` – id, nev, varos, ferohely
- `eloadas` – filmid → film, moziid → mozi, datum, nezoszam, bevetel
- `uzenetek` – nev, email, uzenet, időbélyegek
- `users` – a Laravel alap táblája egy `role` oszloppal (1 = admin, 2 = felhasználó)

A kezdő adatokat a `database/seeders/data/*.tsv` fájlokból a `MoziSeeder` tölti be.

## Telepítés helyben

```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Ezután az oldal a http://localhost:8000 címen érhető el.

## Teszt felhasználók

| Szerep | E-mail | Jelszó |
|--------|--------|--------|
| Felhasználó | `user@mozi.hu` | `user1234` |
| Admin | `admin@mozi.hu` | `admin1234` |
