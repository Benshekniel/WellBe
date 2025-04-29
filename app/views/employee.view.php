<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Administrative Staff Dashboard</title>
   <link rel="stylesheet" href="<?= ROOT ?>/assets/css/labTechs.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
   <div class="dashboard-container">
      <!-- Main Content -->
      <div class="main-content">

         <!--Content Container-->
         <div class="content-container">
            <div class="top-buttons">
               <div class="search-bar">
                  <form method="Get" action="<?= ROOT ?>/Employee/search" role="search">
                     <input value="<?= old_value('find', '', 'get') ?>" name="find" type="search" placeholder="Search..." aria-label="Search">
                  </form> <button type="submit">
                     <i class="fas fa-search"></i>
                  </button>
               </div>
               <div class="add-patient">
                  <a onclick="window.location.href='register'">
                     <i class="fas fa-plus"></i>
                     <span class="add-text">Add New Lab Technician</span>
                  </a>
               </div>
            </div>
            <div class="table-container">
               <table class="lab-tech-table">
                  <tr class="header-row">
                     <th>Lab Technician ID</th>
                     <th>Name</th>
                     <th>Age</th>
                     <th>Contact No</th>
                  </tr>
                  <?php if (!empty($labTechs)): ?>
                     <?php foreach ($labTechs as $labTech): ?>
                        <tr onclick="window.location.href='<?= ROOT ?>/Employee/employeeProfile?nic=<?= $labTech->nic ?>'">
                           <td><?= htmlspecialchars($labTech->nic) ?></td>
                           <td><?= htmlspecialchars($labTech->name) ?></td>
                           <td><?= htmlspecialchars($labTech->age) ?></td>
                           <td><?= htmlspecialchars($labTech->contact) ?></td>
                        </tr>
                     <?php endforeach; ?>
                  <?php else: ?>
                     <tr>
                        <td colspan="5">No lab technicians found.</td>
                     </tr>
                  <?php endif; ?>
               </table>
            </div>
         </div>
      </div>
   </div>
</body>

</html>