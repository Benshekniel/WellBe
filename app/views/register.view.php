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
        <div class="main-content">
            <!--Content Container-->
            <div class="content-container">
                <div class="form-tabs">
                    <span class="tab active">Lab Technician Details</span>
                </div>
                <div class="form-container">

                    <form class="labtech-form" action="<?php echo ROOT; ?>/Register/" method="POST">
                        <span class="form-title">Personal Information</span>

                        <div class="error-messages">
                            <?php if (!empty($errors)): ?>
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <div class="form-row">
                            <label for="nic">NIC:</label>
                            <input type="text" id="nic" name="nic" value="<?= esc($formData['nic'] ?? '') ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="fullName">First Name:</label>
                            <input type="text" id="first_name" name="first_name" value="<?= esc($formData['first_name'] ?? '') ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="fullName">Last Name:</label>
                            <input type="text" id="last_name" name="last_name" value="<?= esc($formData['last_name'] ?? '') ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="dob" value="<?= esc($formData['dob'] ?? '') ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="gender">Gender:</label>
                            <input type="radio" id="male" name="gender" value="M"
                                <?= isset($formData['gender']) && $formData['gender'] === 'M' ? 'checked' : '' ?>>
                            <label for="male">M</label>
                            <input type="radio" id="female" name="gender" value="F"
                                <?= isset($formData['gender']) && $formData['gender'] === 'F' ? 'checked' : '' ?>>
                            <label for="female">F</label>
                        </div>

                        <div class="form-row">
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" value="<?= esc($formData['address'] ?? '') ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="email">Email Address:</label>
                            <input type="email" id="email" name="email" value="<?= esc($formData['email'] ?? '') ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="contact">Contact No:</label>
                            <input type="text" id="contact" name="contact" value="<?= esc($formData['contact'] ?? '') ?>" required>
                            <label for="emergency_contact_no">Emergency Contact No:</label>
                            <input type="text" id="emergency_contact_no" name="emergency_contact_no" value="<?= esc($formData['emergency_contact_no'] ?? '') ?>" required>
                        </div>
                        <div class="button">
                            <a href="<?= ROOT ?>/landing"><button type="button" class="back">Back</button></a>
                            <button type="submit" class="submit-button">Submit</button>
                        </div>
                    </form>
                </div>



            </div>

        </div>
    </div>

</body>

</html>