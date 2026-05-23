<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookReview;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function landing()
    {
        $books = Book::latest()->get();

        return view('landing', compact('books'));
    }

    public function adminDashboard()
    {
        $books = Book::latest()->get();
        $categories = Category::orderBy('nama')->get();
        $users = User::latest()->get();
        $loans = Loan::latest()->get();
        $stats = [
            'totalBooks' => $books->count(),
            'totalCategories' => $categories->count(),
            'totalLoans' => $loans->count(),
            'totalUsers' => $users->count(),
        ];

        return view('admin.dashboard', compact('books', 'categories', 'users', 'stats'));
    }

    public function staffDashboard()
    {
        $books = Book::latest()->get();
        $categories = Category::orderBy('nama')->get();
        $users = User::latest()->get();
        $loans = Loan::latest()->get();
        $stats = [
            'totalBooks' => $books->count(),
            'totalCategories' => $categories->count(),
            'totalLoans' => $loans->count(),
            'totalUsers' => $users->count(),
        ];

        return view('staff.dashboard', compact('books', 'categories', 'users', 'stats'));
    }

    public function staffBooks()
    {
        $books = Book::latest()->get();
        $stats = [
            'totalBooks' => $books->count(),
            'totalStock' => $books->sum('stok'),
            'emptyStock' => $books->where('stok', 0)->count(),
            'totalCategories' => $books->pluck('kategori')->filter()->unique()->count(),
        ];
        return view('staff.books', compact('books', 'stats'));
    }

    public function staffLoans()
    {
        $loans = Loan::with(['user', 'book'])->latest()->get();
        $stats = [
            'pendingLoans' => $loans->where('status', 'Menunggu Persetujuan')->count(),
            'activeLoans' => $loans->where('status', 'Dipinjam')->count(),
            'returnedLoans' => $loans->where('status', 'Dikembalikan')->count(),
            'lateLoans' => $loans
                ->where('status', 'Dipinjam')
                ->filter(fn (Loan $loan) => $loan->due_at && $loan->due_at->lt(today()))
                ->count(),
        ];
        return view('staff.loans', compact('loans', 'stats'));
    }

    public function staffReports()
    {
        $users = User::latest()->get();
        $categories = Category::orderBy('nama')->get();
        $books = Book::latest()->get();
        $loans = Loan::latest()->get();

        $stats = [
            'totalBooks' => $books->count(),
            'totalUsers' => $users->count(),
            'totalCategories' => $categories->count(),
            'totalLoans' => $loans->count(),
        ];

        $reports = collect([
            [
                'module' => 'Pengguna',
                'total' => $users->count(),
                'detail' => $users->where('role', 'anggota')->count() . ' anggota, ' . $users->where('role', 'petugas')->count() . ' petugas, ' . $users->where('role', 'admin')->count() . ' admin',
                'route' => route('staff.reports'),
            ],
            [
                'module' => 'Kategori',
                'total' => $categories->count(),
                'detail' => 'Kategori buku yang tersedia',
                'route' => route('staff.books'),
            ],
            [
                'module' => 'Manajemen Buku',
                'total' => $books->count(),
                'detail' => $books->sum('stok') . ' total stok buku',
                'route' => route('staff.books'),
            ],
            [
                'module' => 'Pinjam Buku',
                'total' => $loans->where('status', 'Dipinjam')->count(),
                'detail' => 'Transaksi yang masih aktif',
                'route' => route('staff.loans'),
            ],
            [
                'module' => 'Pengembalian Buku',
                'total' => $loans->where('status', 'Dikembalikan')->count(),
                'detail' => 'Transaksi yang sudah selesai',
                'route' => route('staff.loans'),
            ],
        ]);
        $sidebarView = 'partials.staff-sidebar';
        $dashboardRoute = 'dashboard.petugas';
        $reportShowRoute = 'staff.reports.show';
        $reportPrintRoute = 'staff.reports.print';
        $pageTitle = 'Laporan Petugas';
        $pageDescription = 'Pilih data laporan petugas Pustakara yang ingin dicetak.';

        return view('admin.reports', compact('reports', 'stats', 'sidebarView', 'dashboardRoute', 'reportShowRoute', 'reportPrintRoute', 'pageTitle', 'pageDescription'));
    }

    public function adminLoans()
    {
        $loans = Loan::with(['user', 'book'])->latest()->get();
        $stats = [
            'pendingLoans' => $loans->where('status', 'Menunggu Persetujuan')->count(),
            'activeLoans' => $loans->where('status', 'Dipinjam')->count(),
            'returnedLoans' => $loans->where('status', 'Dikembalikan')->count(),
            'lateLoans' => $loans
                ->where('status', 'Dipinjam')
                ->filter(fn (Loan $loan) => $loan->due_at && $loan->due_at->lt(today()))
                ->count(),
        ];

        return view('admin.loans', compact('loans', 'stats'));
    }

    public function approveLoan(Loan $loan)
    {
        $approved = DB::transaction(function () use ($loan) {
            $loan = Loan::whereKey($loan->id)->lockForUpdate()->first();

            if (! $loan || $loan->status !== 'Menunggu Persetujuan') {
                return null;
            }

            $book = Book::whereKey($loan->book_id)->lockForUpdate()->first();

            if (! $book || $book->stok < 1) {
                return false;
            }

            $book->decrement('stok');
            $loan->update(['status' => 'Dipinjam']);

            return true;
        });

        if ($approved === null) {
            return back()->with('error', 'Pengajuan ini sudah diproses.');
        }

        if (! $approved) {
            return back()->with('error', 'Stok buku sedang habis, pengajuan belum bisa disetujui.');
        }

        return back()->with('success', 'Pengajuan peminjaman berhasil disetujui.');
    }

    public function rejectLoan(Loan $loan)
    {
        $rejected = Loan::whereKey($loan->id)
            ->where('status', 'Menunggu Persetujuan')
            ->update(['status' => 'Ditolak']);

        if (! $rejected) {
            return back()->with('error', 'Pengajuan ini sudah diproses.');
        }

        return back()->with('success', 'Pengajuan peminjaman ditolak.');
    }

    public function destroyLoan(Loan $loan)
    {
        DB::transaction(function () use ($loan) {
            $loan = Loan::whereKey($loan->id)->lockForUpdate()->first();

            if (! $loan) {
                return;
            }

            if ($loan->status === 'Dipinjam') {
                Book::whereKey($loan->book_id)->increment('stok');
            }

            $loan->delete();
        });

        return back()->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function adminUsers()
    {
        $users = User::where('role', 'anggota')->latest()->get();
        $stats = [
            'totalUsers' => $users->count(),
            'withAddress' => $users->whereNotNull('alamat')->where('alamat', '!=', '')->count(),
            'withoutAddress' => $users->filter(fn (User $user) => empty($user->alamat))->count(),
        ];

        return view('admin.users', compact('users', 'stats'));
    }

    public function destroyUser(User $user)
    {
        if ($user->role !== 'anggota') {
            return redirect()->route('admin.users')->withErrors(['user' => 'Akun yang dipilih bukan pengguna anggota.']);
        }

        DB::transaction(function () use ($user) {
            $activeLoans = Loan::where('user_id', $user->id)
                ->where('status', 'Dipinjam')
                ->select('book_id', DB::raw('COUNT(*) as total'))
                ->groupBy('book_id')
                ->get();

            foreach ($activeLoans as $loanGroup) {
                Book::whereKey($loanGroup->book_id)->increment('stok', $loanGroup->total);
            }

            $user->delete();
        });

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function adminStaff()
    {
        $staffUsers = User::where('role', 'petugas')->latest()->get();
        $stats = [
            'totalStaff' => $staffUsers->count(),
            'withAddress' => $staffUsers->whereNotNull('alamat')->where('alamat', '!=', '')->count(),
            'withoutAddress' => $staffUsers->filter(fn (User $user) => empty($user->alamat))->count(),
        ];

        return view('admin.staff', compact('staffUsers', 'stats'));
    }

    public function staffProfiles()
    {
        $staffUsers = User::where('role', 'petugas')->latest()->get();
        $stats = [
            'totalStaff' => $staffUsers->count(),
            'withPhoto' => $staffUsers->whereNotNull('profile_photo')->where('profile_photo', '!=', '')->count(),
            'withAddress' => $staffUsers->whereNotNull('alamat')->where('alamat', '!=', '')->count(),
        ];

        return view('admin.staff-profiles', compact('staffUsers', 'stats'));
    }

    public function createStaff()
    {
        return view('admin.staff-create');
    }

    public function storeStaff(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'alamat' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama petugas wajib diisi.',
            'username.required' => 'Nama pengguna petugas wajib diisi.',
            'username.unique' => 'Nama pengguna sudah digunakan.',
            'email.required' => 'Surel petugas wajib diisi.',
            'email.email' => 'Format surel tidak valid.',
            'email.unique' => 'Surel sudah terdaftar.',
            'password.required' => 'Kata sandi petugas wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'alamat' => $validated['alamat'] ?? null,
            'role' => 'petugas',
        ]);

        return redirect()->route('admin.staff')->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function editStaff(User $user)
    {
        if ($user->role !== 'petugas') {
            return redirect()->route('admin.staff')->withErrors(['staff' => 'Akun yang dipilih bukan petugas.']);
        }

        return view('admin.staff-edit', compact('user'));
    }

    public function updateStaff(Request $request, User $user)
    {
        if ($user->role !== 'petugas') {
            return redirect()->route('admin.staff')->withErrors(['staff' => 'Akun yang dipilih bukan petugas.']);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:6',
            'alamat' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama petugas wajib diisi.',
            'username.required' => 'Nama pengguna petugas wajib diisi.',
            'username.unique' => 'Nama pengguna sudah digunakan.',
            'email.required' => 'Surel petugas wajib diisi.',
            'email.email' => 'Format surel tidak valid.',
            'email.unique' => 'Surel sudah terdaftar.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
        ]);

        $user->fill([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'alamat' => $validated['alamat'] ?? null,
        ]);

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.staff')->with('success', 'Data petugas berhasil diperbarui.');
    }

    public function destroyStaff(User $user)
    {
        if ($user->role !== 'petugas') {
            return redirect()->route('admin.staff')->withErrors(['staff' => 'Akun yang dipilih bukan petugas.']);
        }

        $user->delete();

        return redirect()->route('admin.staff')->with('success', 'Petugas berhasil dihapus.');
    }

    public function adminProfiles()
    {
        $adminUsers = User::where('role', 'admin')->latest()->get();
        $stats = [
            'totalAdmins' => $adminUsers->count(),
            'withPhoto' => $adminUsers->whereNotNull('profile_photo')->where('profile_photo', '!=', '')->count(),
            'withAddress' => $adminUsers->whereNotNull('alamat')->where('alamat', '!=', '')->count(),
        ];

        return view('admin.profiles', compact('adminUsers', 'stats'));
    }

    public function editAdminProfile(User $user)
    {
        if ($user->role !== 'admin') {
            return redirect()->route('admin.profiles')->with('error', 'Akun yang dipilih bukan admin.');
        }

        return view('admin.profiles-edit', compact('user'));
    }

    public function updateAdminProfile(Request $request, User $user)
    {
        if ($user->role !== 'admin') {
            return redirect()->route('admin.profiles')->with('error', 'Akun yang dipilih bukan admin.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:6',
            'alamat' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Nama admin wajib diisi.',
            'username.required' => 'Nama pengguna admin wajib diisi.',
            'username.unique' => 'Nama pengguna sudah digunakan.',
            'email.required' => 'Surel admin wajib diisi.',
            'email.email' => 'Format surel tidak valid.',
            'email.unique' => 'Surel sudah terdaftar.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'profile_photo.image' => 'File harus berupa gambar.',
            'profile_photo.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'profile_photo.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $validated['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        if (auth()->id() === $user->id) {
            Auth::login($user->fresh());
        }

        return redirect()->route('admin.profiles')->with('success', 'Profil admin berhasil diperbarui.');
    }

    public function adminReports()
    {
        $users = User::latest()->get();
        $categories = Category::orderBy('nama')->get();
        $books = Book::latest()->get();
        $loans = Loan::latest()->get();
        $reviews = BookReview::latest()->get();

        $stats = [
            'totalBooks' => $books->count(),
            'totalUsers' => $users->count(),
            'totalCategories' => $categories->count(),
            'totalLoans' => $loans->count(),
        ];

        $reports = collect([
            [
                'module' => 'Pengguna',
                'total' => $users->count(),
                'detail' => $users->where('role', 'anggota')->count() . ' anggota, ' . $users->where('role', 'petugas')->count() . ' petugas, ' . $users->where('role', 'admin')->count() . ' admin',
                'route' => route('admin.users'),
            ],
            [
                'module' => 'Admin',
                'total' => $users->where('role', 'admin')->count(),
                'detail' => 'Akun admin yang mengelola Pustakara',
                'route' => route('admin.profiles'),
            ],
            [
                'module' => 'Petugas',
                'total' => $users->where('role', 'petugas')->count(),
                'detail' => 'Akun petugas perpustakaan',
                'route' => route('admin.staff'),
            ],
            [
                'module' => 'Anggota',
                'total' => $users->where('role', 'anggota')->count(),
                'detail' => 'Akun anggota perpustakaan',
                'route' => route('admin.users'),
            ],
            [
                'module' => 'Kategori',
                'total' => $categories->count(),
                'detail' => 'Kategori buku yang tersedia',
                'route' => route('books.categories'),
            ],
            [
                'module' => 'Manajemen Buku',
                'total' => $books->count(),
                'detail' => $books->sum('stok') . ' total stok buku',
                'route' => route('books.index'),
            ],
            [
                'module' => 'Peminjaman',
                'total' => $loans->count(),
                'detail' => $loans->where('status', 'Menunggu Persetujuan')->count() . ' menunggu, ' . $loans->where('status', 'Dipinjam')->count() . ' dipinjam, ' . $loans->where('status', 'Dikembalikan')->count() . ' kembali, ' . $loans->where('status', 'Ditolak')->count() . ' ditolak',
                'route' => route('admin.loans'),
            ],
            [
                'module' => 'Pinjam Buku',
                'total' => $loans->where('status', 'Dipinjam')->count(),
                'detail' => 'Transaksi yang masih aktif',
                'route' => route('admin.loans'),
            ],
            [
                'module' => 'Pengembalian Buku',
                'total' => $loans->where('status', 'Dikembalikan')->count(),
                'detail' => 'Transaksi yang sudah selesai',
                'route' => route('admin.loans'),
            ],
            [
                'module' => 'Ulasan',
                'total' => $reviews->count(),
                'detail' => 'Ulasan buku dari anggota',
                'route' => route('admin.reviews'),
            ],
        ]);

        $dashboardRoute = 'dashboard.admin';
        $reportShowRoute = 'admin.reports.show';
        $reportPrintRoute = 'admin.reports.print';
        $pageTitle = 'Laporan Admin';
        $pageDescription = 'Pilih data laporan admin Pustakara yang ingin dicetak.';

        return view('admin.reports', compact('reports', 'stats', 'dashboardRoute', 'reportShowRoute', 'reportPrintRoute', 'pageTitle', 'pageDescription'));
    }

    public function adminReportShow(string $type)
    {
        return $this->showReportTable(
            $type,
            'partials.admin-sidebar',
            'dashboard.admin',
            'admin.reports',
            'admin.reports.print'
        );
    }

    public function staffReportShow(string $type)
    {
        return $this->showReportTable(
            $type,
            'partials.staff-sidebar',
            'dashboard.petugas',
            'staff.reports',
            'staff.reports.print'
        );
    }

    public function adminReportPrint(string $type)
    {
        $report = $this->buildReportByType($type);
        $isStaffReport = request()->routeIs('staff.*');
        $showRoute = $isStaffReport ? 'staff.reports.show' : 'admin.reports.show';
        $indexRoute = $isStaffReport ? 'staff.reports' : 'admin.reports';
        $report['backUrl'] = $type === 'ringkasan' ? route($indexRoute) : route($showRoute, $type);

        return view('admin.report-print', $report);
    }

    private function showReportTable(string $type, string $sidebarView, string $dashboardRoute, string $reportIndexRoute, string $reportPrintRoute)
    {
        $report = $this->buildReportByType($type);
        $reportTypes = $this->reportTypes();

        return view('admin.report-table', array_merge($report, [
            'type' => $type,
            'reportTypes' => $reportTypes,
            'sidebarView' => $sidebarView,
            'dashboardRoute' => $dashboardRoute,
            'reportIndexRoute' => $reportIndexRoute,
            'reportPrintRoute' => $reportPrintRoute,
        ]));
    }

    private function buildReportByType(string $type): array
    {
        return match ($type) {
            'ringkasan' => $this->buildAdminOverviewReport(),
            'peminjaman' => $this->buildLoanOverviewReport(),
            'pengguna' => $this->buildUserReport(),
            'kategori' => $this->buildCategoryReport(),
            'buku' => $this->buildBookReport(),
            'pinjam' => $this->buildLoanReport('Dipinjam', 'Laporan Pinjam Buku', 'Daftar buku yang sedang dipinjam.'),
            'pengembalian' => $this->buildLoanReport('Dikembalikan', 'Laporan Pengembalian Buku', 'Daftar buku yang sudah dikembalikan.'),
            default => abort(404),
        };
    }

    private function reportTypes(): array
    {
        return [
            'pengguna' => 'Kelola User',
            'buku' => 'Kelola Buku',
            'peminjaman' => 'Kelola Peminjaman',
            'pengembalian' => 'Kelola Pengembalian',
        ];
    }

    private function buildAdminOverviewReport(): array
    {
        $users = User::latest()->get();
        $categories = Category::orderBy('nama')->get();
        $books = Book::latest()->get();
        $loans = Loan::latest()->get();
        $reviews = BookReview::latest()->get();

        return [
            'title' => 'Laporan Semua Data Admin',
            'description' => 'Ringkasan seluruh data yang dikelola admin Pustakara.',
            'columns' => ['No', 'Data', 'Jumlah', 'Keterangan'],
            'rows' => collect([
                ['Pengguna', $users->count(), $users->where('role', 'anggota')->count() . ' anggota, ' . $users->where('role', 'petugas')->count() . ' petugas, ' . $users->where('role', 'admin')->count() . ' admin'],
                ['Admin', $users->where('role', 'admin')->count(), 'Akun admin yang mengelola Pustakara'],
                ['Petugas', $users->where('role', 'petugas')->count(), 'Akun petugas perpustakaan'],
                ['Anggota', $users->where('role', 'anggota')->count(), 'Akun anggota perpustakaan'],
                ['Kategori', $categories->count(), 'Kategori buku yang tersedia'],
                ['Manajemen Buku', $books->count(), $books->sum('stok') . ' total stok buku'],
                ['Peminjaman', $loans->count(), $loans->where('status', 'Menunggu Persetujuan')->count() . ' menunggu, ' . $loans->where('status', 'Dipinjam')->count() . ' dipinjam, ' . $loans->where('status', 'Dikembalikan')->count() . ' kembali, ' . $loans->where('status', 'Ditolak')->count() . ' ditolak'],
                ['Pinjam Buku', $loans->where('status', 'Dipinjam')->count(), 'Transaksi yang masih aktif'],
                ['Pengembalian Buku', $loans->where('status', 'Dikembalikan')->count(), 'Transaksi yang sudah selesai'],
                ['Ulasan', $reviews->count(), 'Ulasan buku dari anggota'],
            ])->values()->map(fn (array $row, int $index) => [
                $index + 1,
                $row[0],
                $row[1],
                $row[2],
            ]),
        ];
    }

    private function buildUserReport(): array
    {
        $users = User::where('role', 'anggota')->latest()->get();

        return [
            'title' => 'Laporan Kelola User',
            'description' => 'Daftar akun anggota yang tercatat pada halaman kelola user.',
            'columns' => ['No', 'Nama', 'Username', 'Email', 'Alamat', 'Tanggal Daftar'],
            'rows' => $users->map(fn (User $user, int $index) => [
                $index + 1,
                $user->name,
                $user->username,
                $user->email,
                $user->alamat ?: '-',
                optional($user->created_at)->format('d M Y'),
            ]),
        ];
    }

    private function buildLoanOverviewReport(): array
    {
        $loans = Loan::with(['user', 'book'])->latest()->get();

        return [
            'title' => 'Laporan Peminjaman',
            'description' => 'Rekap peminjaman buku untuk admin dan petugas.',
            'columns' => ['Kode', 'Nama User', 'Judul Buku', 'Tanggal Pinjam', 'Tanggal Kembali', 'Durasi', 'Status'],
            'rows' => $loans->map(function (Loan $loan) {
                $endDate = $loan->returned_at ?: ($loan->status === 'Dikembalikan' ? $loan->due_at : today());
                $duration = $loan->borrowed_at ? (int) $loan->borrowed_at->diffInDays($endDate) : null;
                $lateDays = $loan->status === 'Dipinjam' && $loan->due_at && $loan->due_at->lt(today())
                    ? (int) $loan->due_at->diffInDays(today())
                    : 0;

                return [
                    'PJM-' . str_pad((string) $loan->id, 4, '0', STR_PAD_LEFT),
                    $loan->user->name ?? '-',
                    $loan->book->judul ?? '-',
                    optional($loan->borrowed_at)->format('d M Y') ?: '-',
                    optional($loan->returned_at ?: $loan->due_at)->format('d M Y') ?: '-',
                    $duration !== null ? $duration . ' hari' : '-',
                    $lateDays > 0 ? 'Terlambat' : $loan->status,
                ];
            }),
        ];
    }

    private function buildCategoryReport(): array
    {
        $bookCategories = Book::select('kategori')
            ->selectRaw('COUNT(*) as total_books')
            ->selectRaw('SUM(stok) as total_stock')
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->groupBy('kategori')
            ->get()
            ->keyBy('kategori');

        $categories = Category::orderBy('nama')
            ->get()
            ->map(function (Category $category) use ($bookCategories) {
                $bookCategory = $bookCategories->get($category->nama);
                $category->total_books = $bookCategory->total_books ?? 0;
                $category->total_stock = $bookCategory->total_stock ?? 0;

                return $category;
            });

        return [
            'title' => 'Laporan Kategori',
            'description' => 'Daftar kategori beserta jumlah buku dan stoknya.',
            'columns' => ['No', 'Kategori', 'Jumlah Buku', 'Total Stok', 'Tanggal Dibuat'],
            'rows' => $categories->values()->map(fn (Category $category, int $index) => [
                $index + 1,
                $category->nama,
                $category->total_books,
                $category->total_stock,
                optional($category->created_at)->format('d M Y'),
            ]),
        ];
    }

    private function buildBookReport(): array
    {
        $books = Book::latest()->get();

        return [
            'title' => 'Laporan Manajemen Buku',
            'description' => 'Daftar koleksi buku yang tercatat di Pustakara.',
            'columns' => ['No', 'Judul', 'Penulis', 'Kategori', 'Penerbit', 'Tahun', 'Stok'],
            'rows' => $books->map(fn (Book $book, int $index) => [
                $index + 1,
                $book->judul,
                $book->penulis,
                $book->kategori ?: '-',
                $book->penerbit ?: '-',
                $book->tahun_terbit ?: '-',
                $book->stok,
            ]),
        ];
    }

    private function buildLoanReport(string $status, string $title, string $description): array
    {
        $loans = Loan::with(['user', 'book'])
            ->where('status', $status)
            ->latest()
            ->get();

        return [
            'title' => $title,
            'description' => $description,
            'columns' => ['No', 'Peminjam', 'Buku', 'Tanggal Pinjam', 'Jatuh Tempo', 'Tanggal Kembali', 'Status'],
            'rows' => $loans->map(fn (Loan $loan, int $index) => [
                $index + 1,
                $loan->user->name ?? '-',
                $loan->book->judul ?? '-',
                optional($loan->borrowed_at)->format('d M Y'),
                optional($loan->due_at)->format('d M Y'),
                optional($loan->returned_at)->format('d M Y') ?: '-',
                $loan->status,
            ]),
        ];
    }

    public function adminReviews()
    {
        $reviews = DB::table('book_reviews')
            ->join('users', 'book_reviews.user_id', '=', 'users.id')
            ->join('books', 'book_reviews.book_id', '=', 'books.id')
            ->join('loans', 'book_reviews.loan_id', '=', 'loans.id')
            ->select(
                'book_reviews.id',
                'book_reviews.created_at',
                'book_reviews.rating',
                'book_reviews.comment',
                'book_reviews.user_id',
                'book_reviews.book_id',
                'loans.returned_at',
                'users.name as user_name',
                'users.email as user_email',
                'books.judul as book_title',
                'books.penulis as book_author',
                'books.kategori as book_category'
            )
            ->latest('book_reviews.created_at')
            ->get();

        $popularBooks = Book::query()
            ->withCount('reviews')
            ->orderByDesc('reviews_count')
            ->latest()
            ->take(6)
            ->get();

        $stats = [
            'totalReviews' => $reviews->count(),
            'reviewedBooks' => $reviews->pluck('book_title')->unique()->count(),
            'activeReaders' => $reviews->pluck('user_email')->unique()->count(),
        ];

        return view('admin.reviews', compact('reviews', 'popularBooks', 'stats'));
    }

    public function destroyReview(int $review)
    {
        DB::table('book_reviews')->where('id', $review)->delete();

        return redirect()->route('admin.reviews')->with('success', 'Ulasan berhasil dihapus.');
    }

    public function userDashboard()
    {
        $books = Book::latest()->get();

        return view('user.dashboard', compact('books'));
    }

    public function userCollection()
    {
        $books = Book::latest()->get();
        $favoriteBookIds = auth()->check()
            ? auth()->user()->favoriteBooks()->pluck('books.id')->toArray()
            : [];
        $activeLoanBookIds = auth()->check()
            ? auth()->user()->loans()->whereIn('status', ['Menunggu Persetujuan', 'Dipinjam'])->pluck('book_id')->toArray()
            : [];

        return view('user.collection', compact('books', 'favoriteBookIds', 'activeLoanBookIds'));
    }

    public function userFavorites()
    {
        $books = auth()->user()
            ->favoriteBooks()
            ->latest('favorite_books.created_at')
            ->get();

        return view('user.favorites', compact('books'));
    }

    public function userLoanHistory()
    {
        $loans = auth()->user()
            ->loans()
            ->with('book')
            ->latest()
            ->get();
        $reviewedLoanIds = DB::table('book_reviews')
            ->where('user_id', auth()->id())
            ->pluck('loan_id')
            ->toArray();

        return view('user.loan-history', compact('loans', 'reviewedLoanIds'));
    }

    public function loanReceipt(Loan $loan)
    {
        $role = strtolower(trim((string) auth()->user()->role));

        if ($loan->user_id !== auth()->id() && ! in_array($role, ['admin', 'petugas'], true)) {
            abort(403);
        }

        $loan->load(['user', 'book']);

        return view('loans.receipt', compact('loan'));
    }

    public function returnLoan(Loan $loan)
    {
        if ($loan->user_id !== auth()->id()) {
            abort(403);
        }

        $returned = DB::transaction(function () use ($loan) {
            $loan = Loan::whereKey($loan->id)->lockForUpdate()->first();

            if (! $loan || $loan->user_id !== auth()->id() || $loan->status !== 'Dipinjam') {
                return false;
            }

            $loan->update([
                'status' => 'Dikembalikan',
                'returned_at' => today(),
            ]);

            Book::whereKey($loan->book_id)->increment('stok');

            return true;
        });

        if (! $returned) {
            return redirect()->route('loans.history')->with('error', 'Buku ini belum bisa dikembalikan.');
        }

        return redirect()->route('loans.history')->with('success', 'Buku berhasil dikembalikan.');
    }

    public function storeReview(Request $request, Loan $loan)
    {
        if ($loan->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ], [
            'rating.required' => 'Rating wajib dipilih.',
            'rating.min' => 'Rating minimal 1.',
            'rating.max' => 'Rating maksimal 5.',
            'comment.required' => 'Ulasan wajib diisi.',
            'comment.min' => 'Ulasan minimal 5 karakter.',
            'comment.max' => 'Ulasan maksimal 1000 karakter.',
        ]);

        if ($loan->status !== 'Dikembalikan') {
            return redirect()->route('loans.history')->with('error', 'Ulasan hanya bisa diberikan setelah buku dikembalikan.');
        }

        $alreadyReviewed = DB::table('book_reviews')
            ->where('loan_id', $loan->id)
            ->exists();

        if ($alreadyReviewed) {
            return redirect()->route('loans.history')->with('error', 'Kamu sudah memberi ulasan untuk peminjaman ini.');
        }

        DB::table('book_reviews')->insert([
            'loan_id' => $loan->id,
            'user_id' => auth()->id(),
            'book_id' => $loan->book_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('loans.history')->with('success', 'Ulasan berhasil dikirim.');
    }

    public function createLoan(Book $book)
    {
        $user = auth()->user();

        if ($book->stok < 1) {
            return back()->with('error', 'Stok buku sedang habis.');
        }

        $hasActiveLoan = $user->loans()
            ->where('book_id', $book->id)
            ->whereIn('status', ['Menunggu Persetujuan', 'Dipinjam'])
            ->exists();

        if ($hasActiveLoan) {
            return back()->with('error', 'Kamu masih punya pengajuan atau pinjaman aktif untuk buku ini.');
        }

        return view('loans.create', [
            'book' => $book,
            'borrowedAt' => today(),
            'defaultDueAt' => today()->addDays(7),
        ]);
    }

    public function borrowBook(Request $request, Book $book)
    {
        $validated = $request->validate([
            'due_at' => 'required|date|after_or_equal:today|before_or_equal:' . today()->addDays(14)->toDateString(),
        ], [
            'due_at.required' => 'Tanggal kembali wajib diisi.',
            'due_at.after_or_equal' => 'Tanggal kembali tidak boleh sebelum hari ini.',
            'due_at.before_or_equal' => 'Tanggal kembali maksimal 14 hari dari hari ini.',
        ]);

        $user = auth()->user();

        if ($book->stok < 1) {
            return back()->with('error', 'Stok buku sedang habis.');
        }

        $hasActiveLoan = $user->loans()
            ->where('book_id', $book->id)
            ->whereIn('status', ['Menunggu Persetujuan', 'Dipinjam'])
            ->exists();

        if ($hasActiveLoan) {
            return back()->with('error', 'Kamu masih punya pengajuan atau pinjaman aktif untuk buku ini.');
        }

        $loan = DB::transaction(function () use ($book, $user, $validated) {
            return Loan::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'borrowed_at' => now()->toDateString(),
                'due_at' => $validated['due_at'],
                'status' => 'Menunggu Persetujuan',
            ]);
        });

        return redirect()->route('loans.receipt', $loan)->with('success', 'Pengajuan peminjaman berhasil dikirim. Simpan bukti ini sampai disetujui admin atau petugas.');
    }

    public function toggleFavorite(Book $book)
    {
        $user = auth()->user();
        $isFavorite = $user->favoriteBooks()->where('books.id', $book->id)->exists();

        if ($isFavorite) {
            $user->favoriteBooks()->detach($book->id);
            $message = 'Buku dihapus dari favorit.';
        } else {
            $user->favoriteBooks()->attach($book->id);
            $message = 'Buku ditambahkan ke favorit.';
        }

        return back()->with('success', $message);
    }

    public function userProfile()
    {
        $books = Book::latest()->get();
        $activeLoanBookIds = auth()->user()
            ->loans()
            ->whereIn('status', ['Menunggu Persetujuan', 'Dipinjam'])
            ->pluck('book_id')
            ->toArray();

        return view('user.profile', compact('books', 'activeLoanBookIds'));
    }

    public function editUserProfile()
    {
        return view('user.profile-edit');
    }

    public function updateUserProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'alamat' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Nama pengguna wajib diisi.',
            'username.unique' => 'Nama pengguna sudah digunakan.',
            'email.required' => 'Surel wajib diisi.',
            'email.email' => 'Format surel tidak valid.',
            'email.unique' => 'Surel sudah terdaftar.',
            'profile_photo.image' => 'File harus berupa gambar.',
            'profile_photo.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'profile_photo.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $validated['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->update($validated);
        Auth::login($user->fresh());

        return redirect()->route('profile.user')->with('success', 'Profil berhasil diperbarui.');
    }

    public function create()
    {
        $categories = Category::orderBy('nama')->get();

        return view('books.create', compact('categories'));
    }

    public function index()
    {
        $books = Book::latest()->get();
        $stats = [
            'totalBooks' => $books->count(),
            'totalStock' => $books->sum('stok'),
            'emptyStock' => $books->where('stok', 0)->count(),
            'totalCategories' => $books->pluck('kategori')->filter()->unique()->count(),
        ];

        return view('books.index', compact('books', 'stats'));
    }

    public function categories()
    {
        $bookCategories = Book::select('kategori')
            ->selectRaw('COUNT(*) as total_books')
            ->selectRaw('SUM(stok) as total_stock')
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->groupBy('kategori')
            ->get()
            ->keyBy('kategori');

        $categories = Category::orderBy('nama')
            ->get()
            ->map(function (Category $category) use ($bookCategories) {
                $bookCategory = $bookCategories->get($category->nama);
                $category->total_books = $bookCategory->total_books ?? 0;
                $category->total_stock = $bookCategory->total_stock ?? 0;

                return $category;
            });

        $stats = [
            'totalCategories' => $categories->count(),
            'totalBooks' => $categories->sum('total_books'),
            'totalStock' => $categories->sum('total_stock'),
        ];

        return view('books.categories', compact('categories', 'stats'));
    }

    public function createCategory()
    {
        return view('books.create-category');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:categories,nama',
        ], [
            'nama.required' => 'Kategori wajib diisi.',
            'nama.unique' => 'Kategori sudah ada.',
        ]);

        Category::create($validated);

        return redirect()->route('books.categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'kategori' => ['required', 'string', 'max:100', Rule::exists('categories', 'nama')],
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:2100',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Penulis wajib diisi.',
            'kategori.required' => 'Kategori wajib diisi.',
            'kategori.exists' => 'Kategori tidak valid.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'cover.image' => 'Cover harus berupa gambar.',
            'cover.mimes' => 'Cover harus berformat JPG, JPEG, PNG, atau WEBP.',
            'cover.max' => 'Ukuran cover maksimal 2 MB.',
        ]);

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('book-covers', 'public');
            $validated['cover'] = asset('storage/' . $coverPath);
        }

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:2100',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Penulis wajib diisi.',
            'kategori.required' => 'Kategori wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'cover.image' => 'Cover harus berupa gambar.',
            'cover.mimes' => 'Cover harus berformat JPG, JPEG, PNG, atau WEBP.',
            'cover.max' => 'Ukuran cover maksimal 2 MB.',
        ]);

        if ($request->hasFile('cover')) {
            if ($book->cover && str_contains($book->cover, '/storage/book-covers/')) {
                $oldCover = substr($book->cover, strpos($book->cover, '/storage/') + strlen('/storage/'));
                Storage::disk('public')->delete($oldCover);
            }

            $coverPath = $request->file('cover')->store('book-covers', 'public');
            $validated['cover'] = asset('storage/' . $coverPath);
        } else {
            unset($validated['cover']);
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover && str_contains($book->cover, '/storage/book-covers/')) {
            $oldCover = substr($book->cover, strpos($book->cover, '/storage/') + strlen('/storage/'));
            Storage::disk('public')->delete($oldCover);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
