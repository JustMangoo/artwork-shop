<!DOCTYPE html>
<html lang="lv">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">
<title>Paldies par Pierakstīšanos!</title>
<style>
  body {
    font-family: 'League Spartan', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
  }
  .container {
    max-width: 600px;
    margin: 20px auto;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
  }
  .header {
    background-color: #9aa283;
    color: #ffffff;
    padding: 20px;
    text-align: center;
    font-size: 24px;
    font-weight: 700;
  }
  .content {
    padding: 20px;
    line-height: 1.5;
    font-weight: 400;
    text-align: center; /* Center align text for better reading on subscription confirmation */
  }
  .footer {
    background-color: #9aa283;
    color: #ffffff;
    padding: 10px;
    text-align: center;
    font-size: 14px;
  }
  .button {
    display: block;
    width: max-content;
    padding: 10px 20px;
    background-color: #76a676;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
    margin: 20px auto;
    font-weight: 700;
  }
</style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>Paldies par Pierakstīšanos!</h1>
  </div>
  <div class="content">
    <p>Laipni lūdzam mūsu biļetenā. Jūs esat veiksmīgi pierakstījušies, lai saņemtu jaunākās ziņas un ekskluzīvus piedāvājumus tieši savā e-pastā.</p>
    <a href="#" class="button">Apskatīt mūsu vietni</a>
  </div>
  <div class="footer">
    &copy; {{ date('Y') }} Artis Daugats. Visas tiesības aizsargātas.
  </div>
</div>
</body>
</html>
