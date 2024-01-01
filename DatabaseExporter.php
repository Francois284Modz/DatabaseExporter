<?php
require "Medoo/Medoo.php";

use Medoo\Medoo;

class DatabaseExporter {
    // Database instance
    protected $database;

    // Constructor to initialize the database connection
    public function __construct($databaseConfig) {
        // Initialize Medoo database connection
        $this->database = new Medoo($databaseConfig);
    }

    // Function to export all tables from the database
    public function exportAllTables() {
        // Fetch the list of all tables in the database
        $tables = $this->database->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN, 0);

        // Initialize variable to hold SQLDumper dump
        $sqlDump = "";
        foreach ($tables as $table) {

            // Log the table being processed
            echo "Processing table: $table\n";
            $this->flushOutput();

            // Export table structure
            $structure = $this->database->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_ASSOC);
            // Add DROP TABLE statement to SQLDumper dump
            $sqlDump .= "-- Structure for table `$table`\n";
            $sqlDump .= "DROP TABLE IF EXISTS `$table`;\n";
            // Correct the quoting and add CREATE TABLE statement to SQLDumper dump
            $sqlDump .= $this->correctQuoting($structure['Create Table']) . ";\n\n";

            // Export table data
            $rows = $this->database->select($table, "*");
            foreach ($rows as $row) {
                // Properly escape and quote each value
                $row = array_map(function ($value) {
                    return is_null($value) ? 'NULL' : $this->database->pdo->quote($value);
                }, $row);

                // Add INSERT statement for each row to SQLDumper dump
                $sqlDump .= "INSERT INTO `$table` (`" . implode('`, `', array_keys($row)) . "`) VALUES (" . implode(", ", $row) . ");\n";
            }
            // Add a newline for readability between tables
            $sqlDump .= "\n";

            echo "Finished processing table: $table\n";
            $this->flushOutput();

        }

        ob_end_clean();
        // Return the complete SQLDumper dump
        return $sqlDump;
    }

    // Function to correct quoting in CREATE TABLE statement
    private function correctQuoting($createStatement) {
        // Replace double quotes with backticks for MySQL compatibility
        return str_replace('"', '`', $createStatement);
    }


    private function flushOutput() {
        // Flush output buffer
        ob_flush();
        flush();
    }
}

