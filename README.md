# DatabaseExporter

## Overview

`DatabaseExporter` is a PHP class designed to export the entire content of a specified MySQL database. It generates SQL dump files that can be used for backup or migration purposes. The class uses the Medoo database framework for database interactions and provides real-time logging of the export process.

## Features

- Export all tables and their data from a specified database.
- Generate SQL dump files compatible with phpMyAdmin and other MySQL database management tools.
- Real-time progress logging during the export process.
- Handles special characters and null values correctly.

## Requirements

- PHP 7.x or higher.
- Medoo database framework.

## Installation

1. Ensure you have Medoo installed in your project. If not, you can install it via Composer:

composer require catfan/medoo

2. Include the `DatabaseExporter` class in your PHP project.

## Usage

### Basic Usage

1. Create a new instance of `DatabaseExporter` with your database configuration.
2. Call the `exportAllTables` method to start the export process.
3. The SQL dump will be generated, and progress will be logged in real-time.

### Example

```php
require 'path/to/DatabaseExporter.php';

$databaseConfig = [
 'database_type' => 'mysql',
 'database_name' => 'name',
 'server' => 'localhost',
 'username' => 'your_username',
 'password' => 'your_password'
];

$exporter = new DatabaseExporter($databaseConfig);
$exporter->exportAllTables();

```

## Customization

- The class can be customized for various formats or specific database configurations.
- Error handling and additional logging can be implemented as needed.

## Contributions

Contributions are welcome. Please submit a pull request or an issue if you have any improvements or suggestions.
For more information on how to use or extend this class, please refer to the source code documentation.

### Notes for Customization:

- **Path Adjustments**: Replace `'path/to/DatabaseExporter.php'` with the actual path to your `DatabaseExporter` class.
- **Contribution Guidelines**: If you have specific guidelines for contributions, include them in the "Contributions" section.
- **Additional Documentation**: If the class has more complex functionalities or configurations, consider adding a separate documentation file or extending the README with more details.
