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

### Usage


1.  **Create an admin user:**
    Run the following command and follow the prompts to create your login credentials.
    ```bash
    php artisan make:filament-user
    ```

2.  **Start the development server:**
    ```bash
    php artisan serve
    ```

3.  Navigate to `http://127.0.0.1:8000/admin` in your web browser.
4.  Log in with the credentials you created in the previous step.
5.  Go to the "Expenses" section from the sidebar.
6.  You can now:
    * Click **"New expense"** to add a single record.
    * Click **"Import Expenses"** to upload a CSV file. The CSV must have the columns: `date,source,amount`.
    * Use the filter dropdown on the pie chart to change the reporting period.
