# ResumeBuilder

The **PHP Resume Builder** is a web application that allows users to build, edit, and manage their resumes. It includes features like resume creation, editing, cloning, deletion, and theme customization. The project supports secure user registration, login, and OTP-based password recovery. It also includes email verification using PHPMailer for enhanced security.

## Features

- User Registration and Login
- Resume Creation, Editing, and Viewing
- Cloning and Deleting Resumes
- OTP-based Password Reset
- Customizable Resume Themes
- Font Update for Resumes
- Profile Management
- Email Verification using PHPMailer

## Project Structure

├── actions/ │ ├── action.font_update.php │ ├── action.otp_send.php │ ├── action.otp_verify.php │ ├── action.password_change.php │ ├── action.profile_update.php │ ├── action.resume_clone.php │ ├── action.resume_create.php │ ├── action.resume_delete.php │ ├── action.resume_update.php │ ├── action.theme_update.php │ ├── action.user_login.php │ ├── action.user_logout.php │ └── action.user_register.php ├── assets/ │ ├── class/ │ │ ├── class.Database.php │ │ └── class.Functions.php │ ├── css/ │ │ ├── customMainStyle.css │ │ └── customResumeStyle.php │ └── images/ │ └── (all image assets for resumes) ├── packages/ │ ├── PHPMailer/ │ │ ├── Exception.php │ │ ├── PHPMailer.php │ │ └── SMTP.php ├── index.php ├── otp_verify.php ├── password_change.php ├── password_forgot.php ├── resume_create.php ├── resume_update.php ├── resume_view.php ├── user_account.php ├── user_login.php └── user_register.php

## Installation

To install and run the project locally:

1. **Clone the repository**:

   ```bash
   git clone https://github.com/rony1duet/ResumeBuilder.git
   cd php-resume-builder

   ```

2. Install required dependencies. PHPMailer is already included in
   /packages/PHPMailer.

3. Set up the MySQL database:

   Import the SQL file located in assets/class/ into your MySQL database.
   Update the database credentials in class.Database.php.

4. Configure email settings:

   Update SMTP details in PHPMailer.php for email notifications (OTP password reset).

5. Start the PHP built-in server:
   php -S localhost:8000

6. Visit http://localhost:8000 in your browser to access the application.

## Technologies

    PHP for backend development
    MySQL for database management
    HTML/CSS/JavaScript for front-end development
    PHPMailer for sending emails (OTP and notifications)

## License

MIT License

Copyright (c) 2024 RONY

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

## Contact

    If you have any questions, reach out to:

    Email: rony.hossen.duet@gmail.com
    GitHub: https://github.com/rony1duet
