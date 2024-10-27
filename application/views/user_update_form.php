<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: 'Itim', sans-serif;
            background-color: #F5EDED; /* Background color */
            color: #522258; /* Text color */
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #8C3061; /* Header color */
        }

        form {
            max-width: 500px;
            margin: 0 auto; /* Center the form */
            background-color: #E2DAD6; /* Form background color */
            padding: 20px;
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%; /* Full width */
            padding: 10px; /* Padding */
            margin-bottom: 15px; /* Space between fields */
            border: 1px solid #7FA1C3; /* Border color */
            border-radius: 4px; /* Rounded corners */
            font-size: 16px; /* Font size */
        }

        button {
            background-color: #C63C51; /* Button color */
            color: white; /* Button text color */
            padding: 10px 15px; /* Padding */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer on hover */
            font-size: 16px; /* Font size */
            display: block; /* Center the button */
            width: 100%; /* Full width */
            transition: background-color 0.3s; /* Smooth transition */
        }

        button:hover {
            background-color: #D95F59; /* Button hover color */
        }
    </style>
</head>
<body>
    <h1>Update User</h1>
    <form action="<?php echo site_url('api/users/update/' . $user['id']); ?>" method="POST">
        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" id="student_id" value="<?php echo $user['student_id']; ?>" required>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" value="<?php echo $user['phone']; ?>" required>

        <label for="branch">Branch:</label>
        <input type="text" name="branch" id="branch" value="<?php echo $user['branch']; ?>" required>

        <label for="faculty">Faculty:</label>
        <input type="text" name="faculty" id="faculty" value="<?php echo $user['faculty']; ?>" required>

        <button type="submit">Update User</button>
    </form>
</body>
</html>
