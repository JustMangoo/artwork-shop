<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
<title>Jauna Lapas Ziņa</title>
<style>
  body {
    font-family: "League Spartan", sans-serif;
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
    <p>Vārds: {{ $details['name'] }}</p>
    <p>Epasts: {{ $details['email'] }}</p>
    <p>Ziņa: {{ $details['message'] }}</p>
  </div>
  <div class="footer">
  </div>
</div>
</body>
</html>
