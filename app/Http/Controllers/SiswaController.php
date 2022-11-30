<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function login() 
    // {
    // return view('dasboard.index');
    // }

    public function login()
    {
        return view('dasboard.login');
    }
    public function register()
    {
        return view('dasboard.register');
    }
    public function inputRegister(Request $request)
    {
        //testing hasil input//
        // dd($request->all());

        $request->validate([
            'email' => 'required',
            'name' => 'required|min:4|max:50',
            'username' => 'required|min:4|max:8',
            'password' => 'required',
        ]);

        //tambah data ke data base
        User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password'=>Hash::make($request->password),]);

     //apabila berhasil, bakal diarahin ke halaman login dengan pesan succes
     return redirect('/')->with('succes', 'berhasil membuat akun!');
        }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username', 
            'password' => 'required',
        ], 
        [
            'username.exists' => "This username doesn't exists(username ini tidak tersedia){kustom/bebas}"
        ]);

        $user = $request->only('username', 'password');
        if (Auth::attempt($user)) {
            return redirect()->route('todo.index');
        } else {
            return redirect('/')->with('fail', "Gagal login, periksa dan coba lagi!");
        }
    }

    public function logout()
    {
        //menghapus history login 
        Auth::logout();
        //mengarahkan ke halaman login lagi 
        return redirect('/');
    }
    
    public function index()
    {
        //menampilkan halaman awal 
        //ambil semua data Todo dari database
        //cari data todo yang punya user_id nya sama dengan id orang yang login, kalau ketemu data nya di ambil 
        $todos = Siswa::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 0],
        ])->get();
        //tampilin file index di folder dasboard dan bawa data dari variable yang namanya todos ke file tersebut 
        return view('dasboard.index', compact('todos')); 
    }

    public function updateComplated($id)
    {
       //$id pada parameter mengambil  data dari path dinamis {$id}
       //cari data yang memiliki value column id sama dengan data id yang dikirim ke route, maka update baris data tersebut 
       Siswa::where('id', $id)->update([
        'status' => 1, 
        'done_time' => Carbon::now(), 
       ]);
       //kalau berhasil bakal di arahin ke halaman lisst todo yang complated dengan pemberitahuan 
       return redirect()->route('todo.complated')->with('done', 'Todo Sudah Selesai Di Kerjakan!');
    }

    public function complated()
    {
        $todos = Siswa::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 1],
        ])->get();
        return view('dasboard.complated', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //menampilkan halaman input form tambah data 
    {
        return view('dasboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//mengirim data ke database(data baru) / menambahkan data baru ke database
    {
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);
        Siswa::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date, 
            'status' => 0, 
            'user_id' => Auth::user()->id, 
        ]);
        return redirect()->route('todo.index')->with('successAdd', 'Berhasil menambahkan data Todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //Menampilkan satu data
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan form edit data 
        //ambil data dari db yang id nya sma
        $todo = Siswa::where('id', $id)->first();
        //lalu tampilkan halaman dari view edit dengan mengirim data yang ada di varible todo 
        return view('dasboard.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);
         //update data yang id nya sama dengan id dari route, update nya ke db bagian table todos 
        Siswa::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date, 
            'status' => 0, 
            'user_id' => Auth::user()->id, 
        ]);
        //kalau berhasil bakal diarahin kehalaman awal todo dengan pemberitahuan berhasil 
        return redirect('/todo/')->with('successUpdate', 'Data berhasil diperbarui!');
        //mengubah data di database nya 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//menghapus data dari database 
    {
        // parameter $id akan mengambil data dari path dinamis {id} 
        //cari data ynag isian column id nya sama dengan $id yang dikirm ke path dinamis 
        //kalu ada, ambil data nya terus hapus 
        Siswa::where('id', '=', $id)->delete(); 
        // kalau berhasil, bakal dibalikan ke halaman list todo dengan pemberitahuan 
        return redirect()->route('todo.index')->with('successDelete', 'Berhasil Menghapus Data Todo!');
    }
};

