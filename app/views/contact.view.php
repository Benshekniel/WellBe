<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="<?= ROOT ?>/assets/css/contact.css">
</head>

<body>

   <form action="<?= ROOT ?>/contact" method="post">
      <center>
         <h1>this is a form</h1>
      </center>
      <div class="form">
         <div class="item"><input type="text" placeholder="phone" name="phone" id=""></div>
         <div class="item"><input type="email" placeholder="email" name="email" id=""></div>
         <div class="item"><textarea placeholder="type..." name="text" id=""></textarea></div>
         <button>Submit</button>
      </div>
</body>
</form>

</html>