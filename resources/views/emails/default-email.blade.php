<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f8; padding:20px">
    <div style="max-width:600px;margin:auto;background:#ffffff;padding:24px;border-radius:8px">
        <h2>{{ $title }}</h2>

        <p>{!! nl2br(e($content)) !!}</p>

        @isset($extra)
            <div style="margin-top:20px">
                {!! $extra !!}
            </div>
        @endisset

        <hr style="margin:30px 0">

        <small style="color:#666">
            {{ config('app.name') }} © {{ date('Y') }}
        </small>
    </div>
</body>
</html>
