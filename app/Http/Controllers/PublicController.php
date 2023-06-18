<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kp;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function getCountTable()
    {
        $buku = Buku::count();
        $kp = Kp::count();
        $skripsi = Skripsi::count();
        $bukuTerbanyakDilihat = Buku::orderBy('tahun_terbit', 'desc')->limit(7)->get();
        $skripsiTerbanyakDilihat = Skripsi::with('fileSkripsi')->orderBy('tahun_lulus', 'asc')->limit(6)->get();
        $kpTerbanyakDilihat = Kp::with('fileKp')->orderBy('tahun', 'desc')->limit(6)->get();


        return view('user.welcome', ['buku' => $buku, 'kp' => $kp, 'skripsi' => $skripsi,
            'bukuTerbanyakDilihat' => $bukuTerbanyakDilihat,
            'skripsiTerbanyakDilihat' => $skripsiTerbanyakDilihat,
            'kpTerbanyakDilihat' => $kpTerbanyakDilihat,]);
    }

    public function indexBuku(Request $request)
    {
        $buku = Buku::paginate(10);
        $search = $request->input('search');

        return view('user.buku', ['buku' => $buku, 'search' => $search]);
    }

    public function showBuku($id)
    {
        $buku = Buku::where('kode_buku', $id)->firstOrFail();


        return view('user.detail_buku', ['buku' => $buku]);
    }



    public function indexSkripsi(Request $request)
    {
        $skripsi = Skripsi::paginate(10);
        $search = $request->input('search');


        return view('user.skripsi', ['skripsi' => $skripsi, 'search' => $search]);
    }

    public function showSkripsi($id)
    {
        $skripsi = Skripsi::where('kode_skripsi', $id)->firstOrFail();

        return view('user.detail_skripsi', ['skripsi' => $skripsi]);
    }

    public function indexKp(Request $request)
    {
        $kp = Kp::paginate(10);
        $search = $request->input('search');


        return view('user.kp', ['kp' => $kp, 'search' => $search]);
    }

    public function showKp($id)
    {
        $kp = Kp::where('kode_kp', $id)->firstOrFail();
        return view('user.detail_kp', ['kp' => $kp]);
    }

    public function search(Request $request)
    {
        $category = $request->input('category');
        $filter = $request->input('filter');
        $search = $request->input('search');

        if ($category != null) {
            if ($category === 'buku') {
                if ($filter === 'tahun') {
                    return redirect()->route('search.category', ['category' => 'buku', 'filter' => 'tahun', 'search' => $search]);
                } if ($filter === 'judul') {
                    return redirect()->route('search.category', ['category' => 'buku', 'filter' => 'judul', 'search' => $search]);
                }
                if ($filter === 'penulis') {
                    return redirect()->route('search.category', ['category' => 'buku', 'filter' => 'penulis', 'search' => $search]);
                }
            }
            if ($category === 'kp') {
                if ($filter === 'tahun') {
                    return redirect()->route('search.category', ['category' => 'kp', 'filter' => 'tahun', 'search' => $search]);
                }
                if ($filter === 'judul') {
                    return redirect()->route('search.category', ['category' => 'kp', 'filter' => 'judul', 'search' => $search]);
                }
                if ($filter === 'penulis') {
                    return redirect()->route('search.category', ['category' => 'kp', 'filter' => 'penulis', 'search' => $search]);
                }
            }
            if ($category === 'skripsi') {
                if ($filter === 'tahun') {
                    return redirect()->route('search.category', ['category' => 'skripsi', 'filter' => 'tahun', 'search' => $search]);
                }
                if ($filter === 'judul') {
                    return redirect()->route('search.category', ['category' => 'skripsi', 'filter' => 'judul', 'search' => $search]);
                }
                if ($filter === 'penulis') {
                    return redirect()->route('search.category', ['category' => 'skripsi', 'filter' => 'penulis', 'search' => $search]);
                }
            }
        }

        // Kembali ke halaman tempat form berada jika tidak ada opsi yang dipilih
        return redirect()->back();
    }


    public function searchCategory(Request $request, $category, $filter)
    {
        $search = $request->input('search');

        if ($category === 'buku') {
            if ($filter === 'tahun') {
                $results = Buku::where('tahun_terbit', 'LIKE', '%' . $search . '%')->paginate(10);
                return view('user.buku', ['buku' => $results, 'search' => $search]);
            } 
            if ($filter === 'judul') {
                $results = Buku::where('judul_buku', 'LIKE', '%' . $search . '%')->paginate(10);
                return view('user.buku', ['buku' => $results, 'search' => $search]);
            }
            if ($filter === 'penulis') {
                $results = Buku::where('penulis', 'LIKE', '%' . $search . '%')->paginate(10);
                return view('user.buku', ['buku' => $results, 'search' => $search]);
            }
        }
        if ($category === 'kp') {
            if ($filter === 'tahun') {
                $results = Kp::where('tahun', 'LIKE', '%' . $search . '%')->paginate(10);
                return view('user.kp', ['kp' => $results, 'search' => $search]);
            }
            if ($filter === 'judul') {
                $results = Kp::where('judul_kp', 'LIKE', '%' . $search . '%')->paginate(10);
                return view('user.kp', ['kp' => $results, 'search' => $search]);
            }
            if ($filter === 'penulis') {
                $results = Kp::where('mahasiswa1', 'LIKE', '%' . $search . '%')
                ->orWhere('mahasiswa2', 'LIKE', '%' . $search . '%')
                ->orWhere('mahasiswa3', 'LIKE', '%' . $search . '%')
                ->orWhere('mahasiswa4', 'LIKE', '%' . $search . '%')
                ->orWhere('mahasiswa5', 'LIKE', '%' . $search . '%')
                ->paginate(10);

                return view('user.kp', ['kp' => $results, 'search' => $search]);
            }
        }
        if ($category === 'skripsi') {
            if ($filter === 'tahun') {
                $results = Skripsi::where('tahun_lulus', 'LIKE', '%' . $search . '%')->paginate(10);
                return view('user.skripsi', ['skripsi' => $results, 'search' => $search]);
            }
            if ($filter === 'judul') {
                $results = Skripsi::where('judul_skripsi', 'LIKE', '%' . $search . '%')->paginate(10);
                return view('user.skripsi', ['skripsi' => $results, 'search' => $search]);
            }
            if ($filter === 'penulis') {
                $results = Skripsi::where('nama_penulis', 'LIKE', '%' . $search . '%')->paginate(10);
                return view('user.skripsi', ['skripsi' => $results, 'search' => $search]);
            }
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
