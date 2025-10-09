<h2>
Register
</h2>

@if ($errors->any())
   <ul style="color: red;">
       @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
       @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

        <label>Nama Lengkap:</label>
        <input type="text" id="name" name="nama" required><br>

        <label>Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label>Alamat:</label>
        <input type="text" id="alamat" name="alamat" required><br>

        <label>No HP:</label>
        <input type="text" id="no_hp" name="no_hp" required><br>

        <label>No KTP</label>
        <input type="text" id="no_ktp" name="no_ktp" required><br>

        <label>Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label>Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required><br>
   
        <button type="submit">Daftar</button>
</form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>   
   
