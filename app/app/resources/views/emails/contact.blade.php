<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowa wiadomość kontaktowa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 30px -30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .field {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .field:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 600;
            color: #6366f1;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .value {
            font-size: 16px;
            color: #333;
        }
        .message-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #6366f1;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 Nowa wiadomość kontaktowa</h1>
        </div>
        
        <div class="field">
            <div class="label">Imię i nazwisko</div>
            <div class="value">{{ $data['name'] }}</div>
        </div>
        
        <div class="field">
            <div class="label">Adres e-mail</div>
            <div class="value">
                <a href="mailto:{{ $data['email'] }}" style="color: #6366f1;">{{ $data['email'] }}</a>
            </div>
        </div>
        
        @if(!empty($data['phone']))
        <div class="field">
            <div class="label">Telefon</div>
            <div class="value">
                <a href="tel:{{ $data['phone'] }}" style="color: #6366f1;">{{ $data['phone'] }}</a>
            </div>
        </div>
        @endif
        
        <div class="field">
            <div class="label">Wiadomość</div>
            <div class="message-box">
                {!! nl2br(e($data['message'])) !!}
            </div>
        </div>
        
        <div class="footer">
            <p>Wiadomość wysłana ze strony {{ config('site.name') }}</p>
            <p>Data: {{ now()->format('d.m.Y H:i') }}</p>
        </div>
    </div>
</body>
</html>
