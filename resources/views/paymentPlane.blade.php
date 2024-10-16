<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piani di Pagamento</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }
        .card h2 {
            margin: 0 0 10px;
        }
        .card p {
            margin: 10px 0;
        }
        .price {
            font-size: 24px;
            color: #333;
            margin: 10px 0;
        }
        .btn {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>Piani di Pagamento</h1>
    <div class="container">
        <div class="card">
            <h2>Piano Base</h2>
            <p>Accesso limitato alle funzionalità</p>
            <div class="price">€9/mese</div>
            <a href="#" class="btn">Scegli Piano</a>
        </div>
        <div class="card">
            <h2>Piano Premium</h2>
            <p>Accesso completo a tutte le funzionalità</p>
            <div class="price">€19/mese</div>
            <a href="#" class="btn">Scegli Piano</a>
        </div>
    </div>

</body>
</html>