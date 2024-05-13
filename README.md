# Montana Widget Company Management System

## Overview
The Montana Widget Company Management System is a web-based application designed to facilitate the management of suppliers, supply orders, and warehouses for the Montana Widget Company. This system provides functionalities for adding, updating, and deleting records related to suppliers, supply orders, and warehouses, as well as viewing existing records.

## Features
### Supplier Management
- **Add Supplier**: Enter details such as supplier name, contact person, and contact email to add a new supplier record to the system.
- **Update Supplier**: Modify the details of an existing supplier record by updating fields such as supplier name, contact person, and contact email.
- **Delete Supplier**: Remove a supplier record from the system, along with all associated information.

### Supply Order Management
- **Add Supply Order**: Input supplier ID, product ID, order date, and quantity to create a new supply order record in the system.
- **Update Supply Order**: Edit the details of an existing supply order, including supplier ID, product ID, order date, and quantity.
- **Delete Supply Order**: Remove a supply order record from the system, effectively canceling the associated order.

### Warehouse Management
- **Add Warehouse**: Specify the location of a new warehouse to add it to the system's records.
- **Update Warehouse**: Modify the location of an existing warehouse by updating its warehouse location field.
- **Delete Warehouse**: Remove a warehouse record from the system, potentially indicating the closure or relocation of the warehouse.

### Data Viewing
- **View Supplier Records**: Display a table of all existing supplier records, including supplier ID, name, contact person, and contact email.
- **View Supply Order Records**: Show a table of all existing supply order records, including supply order ID, supplier ID, product ID, order date, and quantity.
- **View Warehouse Records**: Present a table of all existing warehouse records, including warehouse ID and location.

### User Interface
- **Responsive Design**: Utilize Bootstrap to create a responsive and user-friendly interface that adapts to different screen sizes and devices.
- **Form Layout**: Organize input fields in intuitive forms, making it easy for users to add, update, or delete records.
- **Table Presentation**: Present data in tabular format, enhancing readability and allowing users to quickly scan through information.

## Technologies Used
- **Backend**: PHP (Hypertext Preprocessor)
- **Database**: MySQL
- **Frontend**: HTML, CSS (Cascading Style Sheets), Bootstrap
- **Frameworks/Libraries**: PDO (PHP Data Objects), Bootstrap (for styling)

## Setup
1. Clone the repository to your local machine.
git clone https://github.com/Lemoninmountain/DataBaseFinal.git
2. Save the .php files inside xampp\htdocs.
3. Update the database connection details in the PHP files (supplier.php, supply_order.php, warehouse.php) to match your MySQL database credentials.
4. Deploy the application to a web server that supports PHP and MySQL (e.g., Apache, Nginx).
5. Access the application through a web browser by navigating to the appropriate URL (e.g., http://localhost/5740finalfrot).

## Usage
- Follow the instructions provided in the **Usage Guide** section of the README to interact with and utilize the features of the Montana Widget Company Management System.

## Contributing
Contributions are welcome! If you find any bugs or have suggestions for improvement, please feel free to open an issue or create a pull request.
