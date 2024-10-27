<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* Space above the table */
        }
        
        table, th, td {
            border: 1px solid #7FA1C3; /* Border color */
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #E2DAD6; /* Header background color */
            color: #522258; /* Header text color */
        }

        .delete-button {
            color: red;
            cursor: pointer;
        }

        .update-button {
            color: white; /* Update button text color */
            background-color: #007BFF; /* Update button background color (blue) */
            padding: 5px 10px; /* Padding for the button */
            border-radius: 5px; /* Rounded corners */
            text-decoration: none; /* Remove underline */
        }

        .update-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .add-button {
            float: right; /* Align the button to the right */
            background-color: #28a745; /* Button background color (green) */
            color: white; /* Button text color */
            padding: 10px 15px; /* Padding */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer on hover */
            text-decoration: none; /* Remove underline */
            transition: background-color 0.3s; /* Smooth transition */
        }

        .add-button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .pagination {
            text-align: center;
            margin: 20px 0;
        }

        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            color: #522258; /* Pagination link color */
        }

        .pagination a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
    <h1>User List</h1>
    
    <a href="<?php echo site_url('api/users/create'); ?>" class="add-button">Add User</a> <!-- Button to add user -->
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Branch</th>
                <th>Faculty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($users) > 0): ?>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['student_id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['phone']; ?></td>
                    <td><?php echo $user['branch']; ?></td>
                    <td><?php echo $user['faculty']; ?></td>
                    <td>
                        <a href="<?php echo site_url('api/users/update/' . $user['id']); ?>" class="update-button">Update</a>
                        <a href="<?php echo site_url('api/users/delete/' . $user['id']); ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No users found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div class="pagination">
        <?php if ($current_page > 1): ?>
            <a href="<?php echo site_url('api/users?page=' . ($current_page - 1)); ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="<?php echo site_url('api/users?page=' . $i); ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="<?php echo site_url('api/users?page=' . ($current_page + 1)); ?>">Next</a>
        <?php endif; ?>
    </div>
</body>
</html>
