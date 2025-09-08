<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakat = Masyarakat::latest()->paginate(10);
        return view('admin.masyarakat.index', compact('masyarakat'));
    }

    public function show($id = null)
    {
        if (!$id) {
            dd(
                'DIPANGGIL TANPA PARAMETER',
                request()->fullUrl(),
                debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)
            );
        }

        $masyarakat = Masyarakat::findOrFail($id);
        return view('admin.masyarakat.show', compact('masyarakat'));
    }

    public function destroy($id)
    {
        Masyarakat::findOrFail($id)->delete();
        return back()->with('success', 'Akun masyarakat berhasil dihapus');
    }
}