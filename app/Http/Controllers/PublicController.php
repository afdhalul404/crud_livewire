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

        return view('user.welcome', ['buku' => $buku, 'kp' => $kp, 'skripsi' => $skripsi]);
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
        $search = $request->input('search');

        if ($category != null) {
            if ($category === 'buku') {
                return redirect()->route('search.category', ['category' => 'buku', 'search' => $search]);
            }
            if ($category === 'kp') {
                return redirect()->route('search.category', ['category' => 'kp', 'search' => $search]);
            }
            if ($category === 'skripsi') {
                return redirect()->route('search.category', ['category' => 'skripsi', 'search' => $search]);
            }
        }

        // Kembali ke halaman tempat form berada jika tidak ada opsi yang dipilih
        return redirect()->back();
    }


    public function searchCategory(Request $request, $category)
    {
        $search = $request->input('search');

        if ($category === 'buku') {

            $results = Buku::where('judul_buku', 'LIKE', '%' . $search . '%')->paginate(10);
            return view('user.buku', ['buku' => $results, 'search' => $search]);
        }
        if ($category === 'kp') {
            // Logika pencarian untuk kategori "kp"
            $results = Kp::where('judul_kp', 'LIKE', '%' . $search . '%')->paginate(10);
            return view('user.kp', ['kp' => $results, 'search' => $search]);
        }
        if ($category === 'skripsi') {
            // Logika pencarian untuk kategori "skripsi"
            $results = Skripsi::where('judul_skripsi', 'LIKE', '%' . $search . '%')->paginate(10);
            return view('user.skripsi', ['skripsi' => $results, 'search' => $search]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
