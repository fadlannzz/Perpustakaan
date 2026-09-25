# Instalasi

## Prasyarat

- PHP 8.3 atau lebih baru
- Composer
- Node.js dan npm
- SQLite atau MySQL

## Langkah Instalasi

1. Clone repository dan masuk ke folder proyek:

    ```bash
    git clone <url-repository>
    cd web_perpus
    ```

2. Jalankan setup otomatis:

    ```bash
    composer run setup
    ```

3. Konfigurasikan database pada file `.env`.

    Secara default, aplikasi menggunakan SQLite. Untuk menggunakan MySQL, ubah `DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.

4. Jalankan aplikasi:

    ```bash
    composer run dev
    ```

5. Buka `http://localhost:8000` di browser.
