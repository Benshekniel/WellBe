<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>example</title>
   <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Pharmacy/medicationRequestList.css">
</head>

<body>

   <form action="<?= ROOT ?>/example" method="post">
      <option value="Blood" name="test">Blood</option>
      <option value="Urine" name="test">Unine</option>
      <option value="Xray" name="test">Xray</option>
      </!select>
      < <input type="text" pattern="[A-Z][a-z]*" max="5" minlength="4" name="" id="">
         <input type="text" pattern="[0-9]{10}" max="5" name="" id="">
         <label>Select a Color:</label>
         <input type="color" name="selectedColor">
         <form action="<?= ROOT ?>/yourcontroller" method="post">
            <input type="checkbox" name="age" value="1"> Age<br>
            <input type="checkbox" name="name" value="1"> Name<br>
            <input type="checkbox" name="address" value="1"> Address<br>

            <button type="submit">Submit</button>
         </form>

         <button type="submit">submit</button>
         <form action="<?= ROOT ?>/example" method="post">
            <label>Select Gender:</label><br>
            <input type="radio" name="gender" value="male"> Male<br>
            <input type="radio" name="gender" value="female"> Female<br>
            <input type="radio" name="gender" value="other"> Other<br>

            <button type="submit">Submit</button>
         </form>
   </form>

   <head>
      <title>One Word Input</title>
      <script>
         function validateInput() {
            var input = document.getElementById("wordInput").value;
            if (input.trim().split(/\s+/).length > 1) {
               alert("Only one word is allowed!");
               return false;
            }
            return true;
         }
      </script>
   </head>

   <body>
      <form onsubmit="return validateInput()">
         <label for="wordInput">Enter a single word:</label>
         <input type="text" id="wordInput" name="wordInput">
         <button type="submit">Submit</button>
      </form>
   </body>

   <input type="text" pattern="[A-Za-z]{3,10}" title="Only letters (3-10 characters)">
   <input type="text" required>
</body>

</html>