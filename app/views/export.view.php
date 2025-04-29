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
      <option value="Blood" name ="test">Blood</option>
      <option value="Urine" name ="test">Unine</option>
      <option value="Xray" name ="test">Xray</option>
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

   </form>
</body>

</html>