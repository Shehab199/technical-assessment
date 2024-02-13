# Technical Assessment README

This README provides instructions for setting up and running the technical assessment project.

## Steps

1. **Create Database**: 
   - Create a new database named `technical_assessment` in your preferred database management system.

2. **Open Project in Text Editor**:
   - Open the project in any text editor of your choice (e.g., VS Code, Atom, Sublime Text).

3. **Fill Environment Variables**:
   - Locate the `.env` file in the project root.
   - Fill in the `DB_*` environment variables with your own database connection details.

4. **Install Dependencies**:
   - Run `composer install` in your terminal to install project dependencies.

5. **Run Migrations and Seed Database**:
   - Execute `php artisan migrate --seed` in the terminal to run migrations and seed the database with initial data.

6. **Update Environment Variables**:
   - After seeding, copy the generated `DB_CLIENT_ID` and `DB_CLIENT_SECRET` values into the corresponding variables in the `.env` file.

7. **Run the Server**:
   - Start the server by running `php artisan serve` in the terminal.

8. **Access the Application**:
   - Once the server is running, you can access the application by visiting [http://localhost:8000](http://localhost:8000) in your web browser.
   
   The application should be accessible through [http://localhost:8000/](http://localhost:8000/).

Now you should be able to see the application in action!

For any further assistance or issues, feel free to contact us.

Happy coding!