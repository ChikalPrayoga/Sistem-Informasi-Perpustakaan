<?php

namespace App\Controllers;

use App\Models\BookModel;

class Home extends BaseController
{
    protected BookModel $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel;
    }

    public function index(): string
    {
        return view('home/homepage');
    }

    public function book(): string
    {
        $itemPerPage = 20;

        // 1. Ambil input dari URL untuk search dan sort
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort');

        // 2. Membangun kueri dasar yang sama untuk semua kondisi
        $query = $this->bookModel
            ->select('books.*, book_stock.quantity, categories.name as category, racks.name as rack, racks.floor')
            ->join('book_stock', 'books.id = book_stock.book_id', 'LEFT')
            ->join('categories', 'books.category_id = categories.id', 'LEFT')
            ->join('racks', 'books.rack_id = racks.id', 'LEFT')
            // Perbaikan: Filter untuk soft delete harus di kueri database, bukan di PHP
            ->where('books.deleted_at', null);

        // 3. Terapkan filter pencarian jika ada
        if ($search) {
            $query->groupStart() // Mengelompokkan kondisi LIKE agar tidak bentrok dengan WHERE lain
                ->like('title', $search, insensitiveSearch: true)
                ->orLike('slug', $search, insensitiveSearch: true)
                ->orLike('author', $search, insensitiveSearch: true)
                ->orLike('publisher', $search, insensitiveSearch: true)
                ->groupEnd();
        }

        // 4. Terapkan logika sorting
        switch ($sort) {
            case 'title_asc':
                $query->orderBy('title', 'ASC');
                break;
            case 'title_desc':
                $query->orderBy('title', 'DESC');
                break;
            case 'year_asc':
                $query->orderBy('year', 'ASC');
                break;
            case 'year_desc':
            default: // Menjadi urutan default jika tidak ada pilihan
                $query->orderBy('year', 'DESC');
                $sort = 'year_desc'; // Set default value untuk dikirim ke view
                break;
        }

        // 5. Eksekusi kueri dengan paginasi dan siapkan data untuk view
        $data = [
            'books'       => $query->paginate($itemPerPage, 'books'),
            'pager'       => $this->bookModel->pager,
            'currentPage' => $this->request->getVar('page_books') ?? 1,
            'itemPerPage' => $itemPerPage,
            'search'      => $search,
            'sort'        => $sort, // PENTING: kirim variabel sort ke view
        ];
        return view('home/book', $data);
    }
    // --- METHOD BARU DITAMBAHKAN ---
    public function detailBuku($slug = null)
    {
        // 1. Cari buku berdasarkan slug, sertakan juga data dari tabel lain
        $book = $this->bookModel
            ->select('books.*, book_stock.quantity, categories.name as category, racks.name as rack, racks.floor')
            ->join('book_stock', 'books.id = book_stock.book_id', 'LEFT')
            ->join('categories', 'books.category_id = categories.id', 'LEFT')
            ->join('racks', 'books.rack_id = racks.id', 'LEFT')
            ->where('books.deleted_at', null)
            ->where('books.slug', $slug)
            ->first();

        // 2. Jika buku tidak ditemukan, tampilkan halaman 404 Not Found
        if (!$book) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku dengan slug ' . $slug . ' tidak ditemukan.');
        }

        // 3. Siapkan data untuk dikirim ke view
        $data = [
            'book' => $book,
        ];

        // 4. Muat view baru yang akan kita buat di langkah berikutnya
        return view('home/book_detail', $data);
    }
}
