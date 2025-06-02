# 🚀 PHP Resume Builder

> *A comprehensive web application that empowers users to create, customize, and manage professional resumes with ease.*

---

## 📌 Table of Contents

1. [Overview](#overview)
2. [Purpose](#purpose)
3. [Key Features](#key-features)
4. [Technology Stack](#technology-stack)
5. [System Architecture](#system-architecture)
6. [Project Screenshots](#project-screenshots)
7. [Installation & Setup](#installation--setup)
8. [Project Structure](#project-structure)
9. [Database Schema](#database-schema)
10. [Customization Options](#customization-options)
11. [Security Features](#security-features)
12. [Browser Compatibility](#browser-compatibility)
13. [Learning Outcomes](#learning-outcomes)
14. [Known Issues & Limitations](#known-issues--limitations)
15. [Future Enhancements](#future-enhancements)
16. [Contributing](#contributing)
17. [Support](#support)
18. [License](#license)
19. [Acknowledgments](#acknowledgments)

---

## 📖 Overview

This project aims to simplify the resume creation process with a feature-rich, user-friendly web application.  
It is designed to be responsive, customizable, and secure with modern PHP practices.

---

## 🎯 Purpose

- Solve the challenge of creating professional-looking resumes without design skills
- Practice and apply PHP, MySQL, and frontend technologies in a real-world application
- Demonstrate secure user authentication with email verification
- Showcase theme customization and dynamic content management
- Provide users with a complete resume management system

---

## ✨ Key Features

- ✅ **Secure Authentication** - User registration with email verification and OTP-based password recovery
- ✅ **Resume Management** - Create, edit, clone, and delete multiple resumes
- ✅ **Theme Customization** - 8 beautiful themes with real-time preview
- ✅ **Font Selection** - 20+ professional fonts for personalization
- ✅ **Comprehensive Sections** - Personal info, experience, education, skills, projects, and references
- ✅ **Dynamic Forms** - Add/remove entries for experiences, education, skills, and more
- ✅ **Responsive Design** - Mobile-friendly interface
- ✅ **Print Optimization** - A4 format styling for professional printing
- ✅ **Image Handling** - Profile picture upload with compression
- ✅ **Data Validation** - Form validation and secure data processing

---

## 🛠️ Technology Stack

### Frontend
- **HTML5** - Semantic markup
- **CSS3** - Styling with animations
- **JavaScript/jQuery** - Interactive functionality
- **Bootstrap 5.3.2** - Responsive framework
- **Bootstrap Icons** - Icon library
- **Google Fonts** - Typography

### Backend
- **PHP 7.4+** - Server-side scripting
- **MySQL 5.7+** - Database management
- **PHPMailer** - Email functionality
- **Session Management** - User authentication

### Other Tools
- **Git & GitHub** - Version control
- **AJAX** - Asynchronous operations
- **Image Processing** - Profile picture compression

---

## 🧠 System Architecture

Here's an overview of the system design and flow:

```
User → Authentication → Dashboard → Resume Management
                            ↓
                      Create/Edit Resume
                            ↓
                    Theme/Font Selection
                            ↓
                      Print/Share/Clone
```

The application follows an MVC-like pattern:
- **Models**: Database interactions via class.Database.php
- **Views**: PHP templates with embedded HTML/CSS
- **Controllers**: Action handlers in the actions/ directory

---

## 📸 Project Screenshots

| Interface | Description |
|-----------|------------|
| 🏠 **Dashboard** | View and manage all your resumes |
| 📝 **Resume Creation** | Intuitive form for creating professional resumes |
| 🎨 **Theme Selection** | Choose from 8 beautiful themes |
| 🔤 **Font Customization** | Select from 20+ professional fonts |
| 📱 **Mobile View** | Responsive design for all devices |
| 🖨️ **Print Preview** | Optimized A4 format for printing |

---

## ⚙️ Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or PHP built-in server
- SMTP email account for OTP functionality

### Step-by-Step Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/rony1duet/ResumeBuilder.git
   cd ResumeBuilder
   ```

2. **Database Setup**
   ```bash
   # Create a new MySQL database
   mysql -u root -p
   CREATE DATABASE resumebuilder;
   
   # Import the database schema
   mysql -u root -p resumebuilder < database/resumebuilder.sql
   ```

3. **Configure Database Connection**
   
   Edit `assets/class/class.Database.php`:
   ```php
   private $host = 'localhost';
   private $database = 'resumebuilder';
   private $username = 'your_username';
   private $password = 'your_password';
   ```

4. **Configure Email Settings**
   
   Update SMTP credentials in OTP action files:
   ```php
   // In actions/action.otp_send.php and action.user_register.php
   $mail->Username = 'your_email@gmail.com';
   $mail->Password = 'your_app_password';
   ```

5. **Set Permissions**
   ```bash
   chmod 755 assets/images/
   chmod 644 assets/css/*
   chmod 644 assets/js/*
   ```

6. **Start the Application**
   ```bash
   # Using PHP built-in server
   php -S localhost:8000
   
   # Or configure with Apache/Nginx virtual host
   ```

7. **Access the Application**
   
   Open your browser and navigate to `http://localhost:8000`

---

## 📁 Project Structure

```
ResumeBuilder/
├── 📁 actions/                    # Server-side action handlers
│   ├── action.font_update.php     # Font customization
│   ├── action.otp_send.php        # OTP email sending
│   ├── action.otp_verify.php      # OTP verification
│   ├── action.password_change.php # Password reset
│   ├── action.profile_update.php  # User profile updates
│   ├── action.resume_*.php        # Resume CRUD operations
│   ├── action.theme_update.php    # Theme customization
│   └── action.user_*.php          # User authentication
├── 📁 assets/                     # Static assets
│   ├── 📁 class/                  # Core PHP classes
│   │   ├── class.Database.php     # Database connection & operations
│   │   └── class.Functions.php    # Utility functions
│   ├── 📁 css/                    # Stylesheets
│   │   ├── customMainStyle.css    # Main application styles
│   │   └── customResumeStyle.php  # Dynamic resume styling
│   ├── 📁 images/                 # Application images
│   ├── 📁 includes/               # Shared components
│   │   ├── inc.header.php         # Common header
│   │   ├── inc.footer.php         # Common footer
│   │   └── inc.navbar.php         # Navigation bar
│   ├── 📁 js/                     # JavaScript files
│   │   ├── customForm.js          # Form interactions
│   │   └── customResumeAnimation.php # Resume animations
│   └── 📁 packages/               # Third-party libraries
│       └── PHPMailer/             # Email functionality
├── 📁 database/                   # Database schema
│   └── resumebuilder.sql          # MySQL database structure
├── 📄 index.php                   # User dashboard
├── 📄 resume_*.php                # Resume management pages
├── 📄 user_*.php                  # User account pages
├── 📄 password_*.php              # Password management pages
└── 📄 README.md                   # Project documentation
```

---

## 🗄 Database Schema

The application uses a well-structured MySQL database with the following tables:

- **`users`** - User authentication and profile data
- **`resumes`** - Main resume information and metadata
- **`resume_experience`** - Work experience entries
- **`resume_education`** - Educational background
- **`resume_skills`** - Skills and competencies
- **`resume_projects`** - Project portfolios
- **`resume_references`** - Professional references

All tables are properly normalized with foreign key constraints and CASCADE delete operations.

---

## 🎨 Customization Options

### Resume Sections
- **Personal Information** with profile picture upload
- **Professional Summary**
- **Work Experience** with detailed descriptions
- **Education** with achievements
- **Skills** categorization
- **Projects** with links
- **Professional References**

### Available Themes
1. **Default Theme** - Clean and professional
2. **Classic Navy** - Traditional corporate look
3. **Elegant Rose** - Sophisticated feminine touch
4. **Sunset Orange** - Warm and creative
5. **Golden Glow** - Luxurious and premium
6. **Mint Green** - Fresh and modern
7. **Sky Blue** - Calm and trustworthy
8. **Slate Dark** - Bold and contemporary

### Font Options
- **Handwriting**: Caveat, Dancing Script, Handlee
- **Modern**: Fredoka, Playpen Sans, Poppins, Roboto
- **Professional**: Open Sans, Montserrat, Source Sans 3
- **Serif**: Playfair Display, Lora, PT Serif, Cardo
- **And many more...**

---

## 🔒 Security Features

- **Password Hashing** with MD5 (Note: Consider upgrading to bcrypt)
- **SQL Injection Protection** with escaped queries
- **XSS Prevention** with output sanitization
- **CSRF Protection** through session validation
- **Email Verification** for account activation
- **Secure File Upload** with type validation
- **Session Management** with proper timeout

---

## 📱 Browser Compatibility

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

---

## 🎓 Learning Outcomes

While building this project, I learned:

- 🔒 Implementing secure user authentication with email verification
- 🗄️ Designing and implementing a normalized database schema
- 📱 Creating responsive interfaces with Bootstrap
- 🎨 Building a theme and font customization system
- 🖨️ Optimizing content for print output
- 📝 Developing dynamic form handling
- 🔄 Using AJAX for asynchronous updates
- 🧩 Structuring a PHP project for maintainability
- 🛡️ Implementing security best practices for form handling and data storage
- 📨 Integrating email functionality with PHPMailer

---

## 🐛 Known Issues & Limitations

- **Security**: Uses MD5 for password hashing (should be upgraded to bcrypt)
- **Email**: Requires Gmail SMTP (consider supporting other providers)
- **File Upload**: Limited to JPEG/PNG formats only
- **Browser**: Print functionality may vary across browsers

---

## 🔮 Future Enhancements

- [ ] **Enhanced Security**: Implement bcrypt password hashing
- [ ] **Multi-language Support**: Add internationalization
- [ ] **Template System**: Multiple resume layouts
- [ ] **Export Options**: PDF generation, Word format
- [ ] **Social Integration**: LinkedIn import
- [ ] **Advanced Analytics**: View tracking, download stats
- [ ] **API Development**: RESTful API for mobile apps
- [ ] **Cloud Storage**: Amazon S3 integration for images

---

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Development Guidelines
- Follow PSR-4 coding standards
- Add comments for complex functions
- Test thoroughly before submitting
- Update documentation as needed

---

## 🤝 Support

If you encounter issues or have questions:

- 📧 Email: [rony.hossen.duet@gmail.com](mailto:rony.hossen.duet@gmail.com)
- 📬 GitHub Issues: [Submit an issue](https://github.com/rony1duet/ResumeBuilder/issues)
- ⭐ Star this repo to show support!

### Reporting Issues

Please use the GitHub Issues tab to report bugs or request features. When reporting issues, include:
- PHP version
- Browser and version
- Steps to reproduce
- Expected vs actual behavior
- Screenshots (if applicable)

---

## 📄 License

This project is licensed under the **MIT License** – see the [LICENSE](LICENSE) file for details.

```
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
```

---

## 🙏 Acknowledgments

- **Bootstrap Team** - For the amazing CSS framework
- **PHPMailer Contributors** - For reliable email functionality
- **Google Fonts** - For beautiful typography options
- **Bootstrap Icons** - For comprehensive icon library
- **Community Contributors** - For feedback and suggestions

---

<div align="center">

**Made with ❤️ by [RONY](https://github.com/rony1duet)**

⭐ Star this repository if you found it helpful!

[Report Bug](https://github.com/rony1duet/ResumeBuilder/issues) · [Request Feature](https://github.com/rony1duet/ResumeBuilder/issues) · [Documentation](https://github.com/rony1duet/ResumeBuilder/wiki)

</div>
