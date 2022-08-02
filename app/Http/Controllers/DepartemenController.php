<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Departemen;

use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DepartemenExport;

use Session;

class DepartemenController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function index() {
        $departemens = Departemen::all()->sortBy('nama');
        return view('departemen.index', compact('departemens'));
    }

    public function create() {
        return view('departemen.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'nama' => ['required', 'unique:departemen'],
        ]);

        $departemen = new Departemen;
        $departemen->nama = $request->nama;
        $departemen->save();
        return redirect('departemen')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id) {
        $departemen = Departemen::findOrFail($id);
        return view('departemen.edit', compact('departemen'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'nama' => 'required',
        ]);
        
        $departemen = Departemen::findOrFail($id);
        $departemen->nama = $request->nama;
        $departemen->update();
        return redirect('departemen')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id) {
        $departemen = Departemen::findOrFail($id);
        $departemen->delete();
        return redirect('departemen')->with('danger', 'Data berhasil dihapus!');
    }

    public function createPdf() {
        $departemens = Departemen::all()->sortBy('nama');
        $file = PDF::loadView('departemen.create_pdf', ['departemens' => $departemens]);
        return $file->download('Data Departemen.pdf');
    }

    public function exportExcel() {
        return Excel::download(new DepartemenExport, 'Data Departemen.xlsx');
    }
    
}
