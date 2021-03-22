# STEPS to RUN the project

1. Clone the project code to your project inside localhost folder e.g. MAMP/htdocs/

2. Install php composer if not installed already

3. Run `php composer` to install PHPUNIT for unit testing in the current project

4. To run database migrations,
   visit the URL `http://localhost:[PORT]/currency-converter/migrations/index.php`

   Make sure to replace [PORT] with your localhost port

   This will create a database named `currency_converter` if it does not exist already AND
   It will also create a table named `currency_conversion`

5. Run the API
   a. Launch Postman

   b. Enter this URL in POSTMAN to call the API
   `http://localhost:[PORT]/currency-converter/api/controller/convert.php`
   Make sure to replace [PORT] with your localhost port

   c. Refer to the following image to pass relevant parameters to get the conversion results:
   
   ![alt text](https://github.com/fakhirabano/currency-converter/blob/master/blob/postman_screenshot.jpg?raw=true)

6. To run Unit Test
   a. Navigate to project folder in the terminal and enter the following command
   `./vendor/bin/phpunit tests`
