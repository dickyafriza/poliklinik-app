<h2>Login
</h2>

@if ($errors->any())
   <p style="color: red;">{{ $errors->first() }}</p>  
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
</form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>

    //csrf token untuk keamanan form dari serangan CSRF (Cross-Site Request Forgery)
