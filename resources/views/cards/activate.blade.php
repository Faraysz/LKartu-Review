<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Kartu — {{ $card->unique_code }}</title>
    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #f4f5f7;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .card-box {
            background: #fff;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 420px;
        }
        h1 { font-size: 20px; margin-bottom: 4px; }
        .code { color: #888; font-size: 13px; margin-bottom: 24px; }
        label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; margin-top: 16px; }
        input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }
        button {
            margin-top: 24px;
            width: 100%;
            padding: 12px;
            background: #1a1a1a;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
        }
        .success {
            background: #e6f7ee;
            color: #1a7f4e;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 16px;
        }
        .error {
            background: #fdecea;
            color: #c0392b;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="card-box">
        <h1>Aktivasi Kartu Review</h1>
        <div class="code">Kode kartu: {{ $card->unique_code }}</div>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('cards.activate.submit', ['code' => $card->unique_code]) }}">
            @csrf

            <label for="business_name">Nama Usaha</label>
            <input type="text" id="business_name" name="business_name" placeholder="Contoh: Kopi Senja" value="{{ old('business_name') }}" required>

            <label for="target_url">Link Google Review</label>
            <input type="url" id="target_url" name="target_url" placeholder="https://g.page/r/xxxx/review" value="{{ old('target_url') }}" required>

            <button type="submit">Aktivasi Kartu Sekarang</button>
        </form>
    </div>
</body>
</html>
