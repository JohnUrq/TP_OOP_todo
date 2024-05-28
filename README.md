# To-Do List Application

This is a simple to-do list application built using PHP, HTML, JavaScript, and a MySQL database managed via phpMyAdmin. The application allows users to create new to-do lists, add items to these lists, delete items, and mark items as completed.

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Acknowledgments](#acknowledgments)

## Features

- Create new to-do lists
- Add items to a to-do list
- Delete items from a list
- Mark items as completed

## Technologies Used

- PHP
- HTML
- CSS
- JavaScript
- MySQL (managed via phpMyAdmin)

## Installation

### Prerequisites

Before you begin, ensure you have met the following requirements:

- You have installed XAMPP or any other local server (Apache, MySQL).
- You have phpMyAdmin for database management.

### Steps

1. **Clone the repository:**

    ```sh
    git clone https://github.com/JohnUrq/TP_OOP_todo.git
    cd todo-list-app
    ```

2. **Set up the database:**

    - Open phpMyAdmin.
    - Create a new database named `todo_list`.
    - Import the `todo_list.sql` file from the `database` directory to set up the required tables.

3. **Configure the database connection:**

    - Open `config.php` in the root directory.
    - Update the database credentials (host, username, password, database name) as needed.

    ```php
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "todo_list";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```

4. **Start the local server:**

    - Start Apache and MySQL from your XAMPP control panel.

5. **Access the application:**

    - Open your web browser and navigate to `http://localhost/todo-list-app`.

## Usage

### Creating a New To-Do List

1. Enter the name of your new to-do list in the input box.
2. Click the "Create List" button.

### Adding Items to a List

1. Select the to-do list you want to add items to.
2. Enter the item description in the input box.
3. Press "Enter" or click the "Add Item" button.

### Deleting Items

1. Click the "Delete" button next to the item you wish to delete.

### Completing Items

1. Click the checkbox next to the item to mark it as completed.

## Contributing

Contributions are welcome! Please follow these steps to contribute:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature-name`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/your-feature-name`).
5. Open a Pull Request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Thanks to [Tom Parson] [(https://tomparson.com/)] for assistance and tutelage in creating this awesome project!
- Hat tip to anyone whose code was used.

