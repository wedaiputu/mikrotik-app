<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RouterOS Connection</title>
</head>
<body>
    <h1>Connect to RouterOS</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('router.connect') }}" method="POST">
        @csrf
        <label for="host">Host:</label>
        <input type="text" id="host" name="host" value="{{ old('host') }}" required>
        <br><br>
        
        <label for="user">User:</label>
        <input type="text" id="user" name="user" value="{{ old('user') }}" required>
        <br><br>
        
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required>
        <br><br>
        
        <label for="port">Port:</label>
        <input type="number" id="port" name="port" value="{{ old('port', 8728) }}" required>
        <br><br>
        
        <button type="submit">Connect</button>
    </form>
</body>
</html>
