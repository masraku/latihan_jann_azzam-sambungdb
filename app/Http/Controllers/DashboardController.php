<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // /dashboard diarahkan sesuai role
    public function index()
    {
        return match (Auth::user()->role?->nama_role) {
            'admin'  => redirect()->route('admin.dashboard'),
            'seller' => redirect()->route('seller.dashboard'),
            'buyer'  => redirect()->route('buyer.dashboard'),
            default  => abort(403, 'Akun ini belum punya role.'),
        };
    }

    public function admin()
    {
        $users = User::with('role')->orderBy('name')->get();
        return view('dashboard.admin', compact('users'));
    }

    public function seller()
    {
        $produks = Auth::user()->produks()->orderBy('nama_produk')->get();
        return view('dashboard.seller', compact('produks'));
    }

    public function buyer()
    {
        return view('dashboard.buyer');
    }
}
