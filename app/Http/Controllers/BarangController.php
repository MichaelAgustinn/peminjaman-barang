<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class BarangController extends Controller
{
    function tampil()
    {
        $barang = Barang::get();
        return view('barang.tampil', compact('barang'));
    }

    function index()
    {
        $barang = Barang::get();
        return view('welcome', compact('barang'));
    }



    function tambah()
    {
        return view('barang.tambah');
    }

    function submit(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'kategori_barang' => 'required|string|max:255',
            'stok_barang' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambar_barang')) {
            $file = $request->file('gambar_barang');

            // Membuat nama file unik: date + random angka
            $fileName = date('YmdHis') . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();

            // Menyimpan gambar ke folder public/img
            $file->move(public_path('img'), $fileName); // Menyimpan gambar di folder public/img

            // Menyimpan path gambar relatif terhadap public folder
            $filePath = 'img/' . $fileName;
        }

        // Simpan data barang ke database
        $barang = new Barang();
        $barang->nama = $request->nama_barang;
        $barang->gambar = $filePath; // Simpan path gambar
        $barang->kategori = $request->kategori_barang;
        $barang->stok = $request->stok_barang;
        $barang->save();

        // Redirect setelah berhasil menambah barang
        return redirect()->route('barang.tampil')->with('success', 'Barang berhasil ditambahkan!');
    }

    function edit($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            // Jika data tidak ditemukan, redirect ke halaman lain dengan pesan error
            return redirect()->route('barang.tampil')->with('error', 'Barang tidak ditemukan.');
        }

        // Jika data ditemukan, kirim ke view
        return view('barang.edit', compact('barang'));
    }

    function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return redirect()->route('barang.tampil')->with('error', 'Barang tidak ditemukan.');
        }

        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'kategori_barang' => 'required|string|max:255',
            'stok_barang' => 'required|integer|min:0',
        ]);

        // Perbarui data barang
        $barang->nama = $request->nama_barang;
        $barang->kategori = $request->kategori_barang;
        $barang->stok = $request->stok_barang;

        // Jika ada file gambar baru diunggah
        if ($request->hasFile('gambar_barang')) {
            // Hapus gambar lama jika ada
            // if ($barang->gambar && file_exists(public_path('img/' . $barang->gambar))) {
            //     unlink(public_path($barang->gambar));
            // }
            if ($barang->gambar && file_exists(public_path($barang->gambar))) {
                unlink(public_path($barang->gambar)); // Menghapus file gambar
            }

            // Simpan gambar baru
            $file = $request->file('gambar_barang');
            $filename = now()->format('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $barang->gambar = 'img/' . $filename;
        }

        // Simpan perubahan ke database
        $barang->save();

        return redirect()->route('barang.tampil')->with('success', 'Barang berhasil diperbarui.');
    }


    public function delete($id)
    {
        $barang = Barang::find($id);

        // dd($barang);

        if (!$barang) {
            return redirect()->route('barang.tampil')->with('error', 'Barang tidak ditemukan.');
        }

        // Menghapus gambar dari storage (jika ada)
        if ($barang->gambar && file_exists(public_path($barang->gambar))) {
            unlink(public_path($barang->gambar)); // Menghapus file gambar
        }

        // Menghapus data barang
        $barang->delete();

        return redirect()->route('barang.tampil')->with('success', 'Barang berhasil dihapus.');
    }
}
