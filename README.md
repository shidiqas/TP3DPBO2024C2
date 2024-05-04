# TP3DPBO2024C2
Saya Shidiq Arifin Sudrajat [2202152] mengerjakan soal TP3 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

## Desain Program
![Screenshot 2024-05-04 122407](https://github.com/shidiqas/TP3DPBO2024C2/assets/118581965/7783b730-6745-46da-88a5-8dab52447f56)
Program terinsipirasi dari game Honkai Star Rail. Program ini terdiri dari tiga tabel (kelas): `element`, `path`, dan `karakter`. Berikut adalah penjelasan mengenai kelas beserta atributnya dari setiap tabel:

### Tabel `path`
- **Atribut:**
  - `id_path`: Digunakan sebagai identifikasi unik untuk path yang diikuti oleh karakter.
  - `nama_path`: Sebuah string yang menyimpan nama dari setiap path.

### Tabel `element`
- **Atribut:**
  - `id_element`: Digunakan sebagai identifikasi unik untuk setiap elemen yang dimiliki oleh karakter.
  - `nama_element`: Sebuah string yang menyimpan nama dari setiap elemen.

### Tabel `karakter`
- **Atribut:**
  - `id_karakter`: Digunakan sebagai identifikasi unik untuk setiap karakter.
  - `foto`: Untuk menyimpan nama berkas gambar karakter.
  - `nama`: Untuk menyimpan nama karakter.
  - `jenis_kelamin`: Untuk menyimpan jenis kelamin karakter.
  - `tinggi`: Untuk menyimpan tinggi karakter..
  - `id_path`: Merupakan foreign key yang merujuk ke tabel `path`.
  - `id_element`: Merupakan foreign key yang merujuk ke tabel `element`.
 
## Alur Program
![Screenshot (1373)](https://github.com/shidiqas/TP3DPBO2024C2/assets/118581965/caee6ebb-c9b1-4725-9dea-57c6b653c50b)
Disaat baru pertama kali masuk ke program yang saya buat, pengguna akan diarahkan ke bagian index atau halaman depan yang terdiri dari tampilan daftar karakter Honkai Star Rail. Lalu terdapat beberapa pilihan menu atau navbar yang dapat melakukan berbagai macam fungsi. Saat salah satu kotak karakter ditekan, pengguna akan diarahkan ke halaman karakter detail yang akan menjelasakan secara lebih lengkap karakter tersebut. Pada kode yang saya buat, pengguna dapat menggunakan beberapa fitur yang akan saya jelaskan, diantaranya:

### Searching
Pengguna dapat melakukan fungsi searching atau pencarian terhadap nama karakter pada tabel karakter.

### Sorting
Pengguna dapat melakukan fungsi sorting atau pengurutan terhadap nama karakter pada tabel karakter baik secara Ascending maupun Descending

### CRUD
Pengguna dapat melakukan fungsi CRUD (Create, Read, Update, Delete) pada semua tabel (`element`, `path`, `karakter`).
