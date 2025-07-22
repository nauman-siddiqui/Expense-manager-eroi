# Marketing Expense Tracker

A simple but powerful admin panel built with Laravel and Filament to track and analyze marketing expenses from various sources.

## Overview

This application provides a user-friendly interface to manage daily marketing expenses. Users can input costs for different traffic sources (e.g., Google Ads, Meta Ads) and visualize the data in a report. The key feature is a dynamic pie chart that shows the percentage breakdown of expenses by source, which can be filtered by different time frames. The app also supports bulk uploading of expenses via a CSV file to streamline data entry.

## Features

* **Manual Expense Entry:** A simple form to add a new expense with a date, source, and amount.
* **Bulk CSV Upload:** An "Import Expenses" feature to upload multiple records at once from a CSV file.
* **Expense Listing:** A clean, sortable, and searchable table of all recorded expenses.
* **Dynamic Pie Chart Report:** A visual representation of the expense distribution by source, showing percentages.
* **Time-Based Filtering:** Filter the pie chart report by "Today," "This Week," "This Month," and "This Year."
* **User-Friendly Interface:** Built with Filament for a modern and responsive user experience.

## Technology Stack

* **Backend:** Laravel 11
* **Admin Panel:** Filament 3
* **Language:** PHP 8.1+
* **Database:** SQLite (for simplicity)
* **Frontend:** handled by Filament

## Getting Started

Follow these instructions to set up the project on your local machine.

### Prerequisites

* PHP 8.1+
* Composer
* SQLite

### Installation

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/your-username/your-repository-name.git](https://github.com/your-username/your-repository-name.git)
    cd your-repository-name
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Create your environment file:**
    ```bash
    cp .env.example .env
    ```

4.  **Configure the database:**
    Open the `.env` file and ensure the database connection is set to SQLite:
    ```env
    DB_CONNECTION=sqlite
    ```
    (You can remove the other `DB_` variables as they are not needed for SQLite).

5.  **Create the SQLite database file:**
    ```bash
    touch database/database.sqlite
    ```

6.  **Generate an application key:**
    ```bash
    php artisan key:generate
    ```

7.  **Run the database migrations:**
    This will create the `users` and `expenses` tables.
    ```bash
    php artisan migrate
    ```

8.  **Create an admin user:**
    Run the following command and follow the prompts to create your login credentials.
    ```bash
    php artisan make:filament-user
    ```

9.  **Start the development server:**
    ```bash
    php artisan serve
    ```

### Usage

1.  Navigate to `http://127.0.0.1:8000/admin` in your web browser.
2.  Log in with the credentials you created in the previous step.
3.  Go to the "Expenses" section from the sidebar.
4.  You can now:
    * Click **"New expense"** to add a single record.
    * Click **"Import Expenses"** to upload a CSV file. The CSV must have the columns: `date,source,amount`.
    * Use the filter dropdown on the pie chart to change the reporting period.
