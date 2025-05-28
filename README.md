# 📄 PHP Resume Builder

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-777BB4.svg)](https://php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1.svg)](https://mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.2-7952B3.svg)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

A comprehensive **PHP Resume Builder** web application that empowers users to create, customize, and manage professional resumes with ease. Built with modern technologies and featuring an intuitive interface, real-time theme customization, and robust security features.

## ✨ Features

### 🔐 Authentication & Security
- **Secure User Registration** with email verification
- **Login System** with session management
- **OTP-based Password Reset** via email
- **Profile Management** with password updates
- **Email Verification** using PHPMailer integration

### 📝 Resume Management
- **Create Professional Resumes** with guided forms
- **Edit & Update** existing resumes
- **Clone Resumes** for quick variations
- **Delete Resumes** with confirmation
- **Multiple Resume Support** per user

### 🎨 Customization Features
- **7 Beautiful Themes**: Default, Classic Navy, Elegant Rose, Sunset Orange, Golden Glow, Mint Green, Sky Blue, Slate Dark
- **20+ Professional Fonts**: Including Poppins, Roboto, Open Sans, Playfair Display, and more
- **Real-time Preview** of changes
- **Responsive Design** for all devices

### 📊 Resume Sections
- **Personal Information** with profile picture upload
- **Professional Summary**
- **Work Experience** with detailed descriptions
- **Education** with achievements
- **Skills** categorization
- **Projects** with links
- **Professional References**

### 🛠 Advanced Features
- **Print-ready A4 Format** with proper styling
- **Image Compression** for profile pictures
- **URL Validation** for links
- **Dynamic Form Fields** (add/remove entries)
- **Animated Transitions** and hover effects
- **Share Functionality**

## 🏗 Project Structure

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
├── 📄 Main Pages                  # Application pages
│   ├── index.php                  # User dashboard
│   ├── resume_create.php          # Resume creation form
│   ├── resume_update.php          # Resume editing
│   ├── resume_view.php            # Resume display & export
│   ├── user_*.php                 # Authentication pages
│   └── password_*.php             # Password management
└── 📄 README.md                   # Project documentation
```

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

## 🚀 Installation & Setup

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

## 🛠 Technology Stack

### Backend
- **PHP 7.4+** - Server-side scripting
- **MySQL 5.7+** - Database management
- **PHPMailer** - Email functionality
- **Session Management** - User authentication

### Frontend
- **HTML5** - Semantic markup
- **CSS3** - Styling with animations
- **JavaScript/jQuery** - Interactive functionality
- **Bootstrap 5.3.2** - Responsive framework
- **Bootstrap Icons** - Icon library
- **Google Fonts** - Typography

### Features
- **Responsive Design** - Mobile-first approach
- **AJAX** - Asynchronous operations
- **Print Optimization** - A4 format styling
- **Real-time Preview** - Instant customization feedback
- **Image Processing** - Profile picture compression

## 🎨 Customization Options

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

## 🔒 Security Features

- **Password Hashing** with MD5 (Note: Consider upgrading to bcrypt)
- **SQL Injection Protection** with escaped queries
- **XSS Prevention** with output sanitization
- **CSRF Protection** through session validation
- **Email Verification** for account activation
- **Secure File Upload** with type validation
- **Session Management** with proper timeout

## 📱 Browser Compatibility

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

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

## 🐛 Known Issues & Limitations

- **Security**: Uses MD5 for password hashing (should be upgraded to bcrypt)
- **Email**: Requires Gmail SMTP (consider supporting other providers)
- **File Upload**: Limited to JPEG/PNG formats only
- **Browser**: Print functionality may vary across browsers

## 🔮 Future Enhancements

- [ ] **Enhanced Security**: Implement bcrypt password hashing
- [ ] **Multi-language Support**: Add internationalization
- [ ] **Template System**: Multiple resume layouts
- [ ] **Export Options**: PDF generation, Word format
- [ ] **Social Integration**: LinkedIn import
- [ ] **Advanced Analytics**: View tracking, download stats
- [ ] **API Development**: RESTful API for mobile apps
- [ ] **Cloud Storage**: Amazon S3 integration for images

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

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

## 📞 Contact & Support

For questions, suggestions, or support, please reach out:

- **Email**: [rony.hossen.duet@gmail.com](mailto:rony.hossen.duet@gmail.com)
- **GitHub**: [@rony1duet](https://github.com/rony1duet)
- **Project Repository**: [ResumeBuilder](https://github.com/rony1duet/ResumeBuilder)

### Reporting Issues

Please use the GitHub Issues tab to report bugs or request features. When reporting issues, include:
- PHP version
- Browser and version
- Steps to reproduce
- Expected vs actual behavior
- Screenshots (if applicable)

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
