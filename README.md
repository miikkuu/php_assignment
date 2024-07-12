# User Data Management API

## Overview

This User Data Management API is a Symfony-based application developed as an assignment for Persist Ventures. It provides a set of endpoints to manage user data, interact with a database, and handle email notifications.

Made by - Yashraj Singh

## Features

- Upload and store user data from CSV files
- View stored user data
- Backup the database
- Restore the database from a backup file
- Asynchronous email notifications

## Technologies Used

- PHP 7.4+
- Symfony 5.x
- MySQL 5.7+
- Composer

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/yourusername/user-data-management-api.git
   cd user-data-management-api
   ```

2. Install dependencies:
   ```
   composer install
   ```

3. Set up your environment:
   ```
   cp .env.example .env
   ```
   Edit the `.env` file with your specific configuration details.

4. Create the database:
   ```
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. Start the Symfony development server:
   ```
   symfony server:start
   ```

## API Endpoints

### 1. Upload User Data
- **URL**: `/api/upload`
- **Method**: POST
- **Description**: Uploads a CSV file containing user data and stores it in the database.
- **Request Body**: 
  - `file`: CSV file (multipart/form-data)

### 2. View User Data
- **URL**: `/api/users`
- **Method**: GET
- **Description**: Retrieves all stored user data.

### 3. Backup Database
- **URL**: `/api/backup`
- **Method**: GET
- **Description**: Creates a backup of the current database state.

### 4. Restore Database
- **URL**: `/api/restore`
- **Method**: POST
- **Description**: Restores the database from a backup file.
- **Request Body**:
  - `backup_file`: SQL backup file (multipart/form-data)

## Usage Examples

### Uploading User Data

```bash
curl -X POST -F "file=@path/to/your/data.csv" http://localhost:8000/api/upload
```

### Viewing User Data

```bash
curl http://localhost:8000/api/users
```

### Creating a Database Backup

```bash
curl http://localhost:8000/api/backup
```

### Restoring the Database

```bash
curl -X POST -F "backup_file=@path/to/your/backup.sql" http://localhost:8000/api/restore
```

## Development

### Running Tests

To run the test suite:

```bash
php bin/phpunit
```


## Acknowledgments

- Persist Ventures for providing the project requirements
- Symfony documentation and community for their excellent resources

## Contact

Yashraj Singh - yshraj.work@gmail.com

Project Link: [https://github.com/miikkuu/php_assignment](https://github.com/miikkuu/php_assignment)
