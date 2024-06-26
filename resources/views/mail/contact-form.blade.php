<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Alegreya:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
<title>Jauna Lapas Ziņa</title>
<style>
  body {
    font-family: "Alegreya Sans", sans-serif;
    font-weight: 500;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
  }
  .container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #ffffff;
    padding: 20px;
  }
  .header {
    background-color: #9aa283;
    font-family: "Alegreya", serif;
    color: #ffffff;
    padding: 10px;
    text-align: center;
  }
  .content {
    padding: 20px;
    text-align: left;
  }
  .footer {
    background-color: #9aa283;
    color: #ecf0f1;
    padding: 10px;
    min-height: 1rem;
    text-align: left;
  }
  .button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #9aa283;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
  }
</style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>Ir pienākusi jauna ziņa</h1>
  </div>
  <div class="content">
    <p><strong>Vārds:</strong> {{ $details['name'] }}</p>
    <p><strong>Epasts:</strong> {{ $details['email'] }}</p>
    <p><strong>Ziņa:</strong> {{ $details['message'] }}</p>
  </div>
  <div class="footer">
    &copy; {{ date('Y') }} Artis Daugats. Visas tiesības aizsargātas.
  </div>
</div>
</body>
</html>
