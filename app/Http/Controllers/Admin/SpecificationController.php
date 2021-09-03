<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specification;

class SpecificationController extends Controller
{
    /**
     * Menampilkan halaman index specification menu
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $specs = Specification::latest()->paginate(15);
        return view('admin.specification.index', compact('specs'));
    }

    /**
     * Menyimpan data ke Spesification table di database
     * 
     * @return \Illuminate\Http\RedirectResponse
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $spec = request()->validate(['name' => 'required|unique:specifications,name']);

        Specification::create($spec);
        alert()->success('Successfully Added');
        return back();
    }

    /**
     * Memperbarui data dari spesifik specification menu
     * 
     * @param Specification $specification
     * 
     * @return \Illuminate\Http\RedirectResponse
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Specification $spec)
    {
        $specs = request()->validate(['name' => 'required|unique:specifications,name',]);

        $spec->update($specs);

        alert()->success('Successfully Updated');
        return back();
    }

    /**
     * Menghapus spesifik data dari specification menu
     * 
     * @param Specification $specification
     * 
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function destroy(Specification $spec)
    {
        $spec->delete();

        alert()->success('Successfully Deleted');
        return back();
    }
}
