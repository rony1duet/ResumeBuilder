<script>
    document.querySelector('.profile-image').addEventListener('mouseover', function() {
        this.style.transform = 'scale(1.1)';
    });
    document.querySelector('.profile-image').addEventListener('mouseout', function() {
        this.style.transform = 'scale(1)';
    });

    // Smooth scroll to sections
    document.querySelectorAll('.section-title').forEach(item => {
        item.addEventListener('click', () => {
            item.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    function updateProfilePicture(base64Image) {
        const imgPreview = document.getElementById('profile-preview');
        imgPreview.src = base64Image;
    }
    const receivedBase64Image = "data:image/jpeg;base64,<?php echo $resume['profile_picture']; ?>";
    updateProfilePicture(receivedBase64Image);

    $("#fonts").change(function() {
        const selectedFont = $(this).children("option:selected").val();
        $(".resume-container").css("font-family", selectedFont);
        $.ajax({
            url: "actions/action.font_update.php",
            type: "POST",
            data: {
                resume_id: <?= @$resume['id'] ?>,
                font: selectedFont
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
    $(document).ready(function() {
        const selectedFont = "<?php echo !empty($resume['font']) ? $resume['font'] : 'Poppins'; ?>";
        $(".resume-container").css("font-family", selectedFont);
        $("#fonts").val(selectedFont);
    });

    // Function to handle theme selection
    function selectTheme(element) {
        const blocks = document.querySelectorAll('.theme-block');
        blocks.forEach(block => block.classList.remove('selected'));
        element.classList.add('selected');
        const selectedTheme = element.dataset.theme || 'defaultTheme';

        // Define theme color settings for light and dark sections and heading sections
        const themeColors = {
            defaultTheme: {
                light: '#f7f9fc',
                dark: '#1a1b2e',
                textColor: '#fff',
                headingColor: '#007bff',
                secondaryTextColor: '#444',
                borderColor: '#d6d6d6',
                itemHoverBackground: 'rgba(30, 144, 255, 0.08)',
                itemHoverBorderColor: '#5cb3ff'
            },
            ClassicNavy: {
                light: '#EAEFF2',
                dark: '#1A1B2E',
                textColor: '#ECECEC',
                headingColor: '#118AB2',
                secondaryTextColor: '#007BFF',
                borderColor: '#d6d6d6',
                itemHoverBackground: 'rgba(30, 144, 255, 0.08)',
                itemHoverBorderColor: '#5cb3ff'
            },
            ElegantRose: {
                light: '#F8ECEA',
                dark: '#EF476F',
                textColor: '#3D2C2E',
                headingColor: '#C41E3A',
                secondaryTextColor: '#D6336C',
                borderColor: '#c2929d',
                itemHoverBackground: 'rgba(239, 71, 111, 0.08)',
                itemHoverBorderColor: '#ff1e53'
            },
            SunsetOrange: {
                light: '#FFF2E2',
                dark: '#F78C6B',
                textColor: '#5C4033',
                headingColor: '#D35400',
                secondaryTextColor: '#FA824C',
                borderColor: '#f3c29b',
                itemHoverBackground: 'rgba(247, 140, 107, 0.08)',
                itemHoverBorderColor: '#ff501b'
            },
            GoldenGlow: {
                light: '#FFF9E1',
                dark: '#FFD166',
                textColor: '#665C3E',
                headingColor: '#E67E22',
                secondaryTextColor: '#FFB627',
                borderColor: '#e6c961',
                itemHoverBackground: 'rgba(255, 209, 102, 0.08)',
                itemHoverBorderColor: '#ffb915'
            },
            MintGreen: {
                light: '#E6FFF5',
                dark: '#06D6A0',
                textColor: '#22523C',
                headingColor: '#16A085',
                secondaryTextColor: '#00B894',
                borderColor: '#6cc99c',
                itemHoverBackground: 'rgba(6, 214, 160, 0.08)',
                itemHoverBorderColor: '#08ffbd'
            },
            SkyBlue: {
                light: '#E0F5FF',
                dark: '#118AB2',
                textColor: '#153761',
                headingColor: '#14415F',
                secondaryTextColor: '#035A77',
                borderColor: '#8ac7e6',
                itemHoverBackground: 'rgba(17, 138, 178, 0.08)',
                itemHoverBorderColor: '#13a0cf'
            },
            SlateDark: {
                light: '#E3E6E8',
                dark: '#073B4C',
                textColor: '#ECECEC',
                headingColor: '#0290E5',
                secondaryTextColor: '#1F77B4',
                borderColor: '#465762',
                itemHoverBackground: 'rgba(7, 59, 76, 0.08)',
                itemHoverBorderColor: '#12799b'
            }
        };

        // Get the theme colors based on the selected theme
        const colors = themeColors[selectedTheme];

        // Update background colors of sections
        document.querySelector('.left-section').style.backgroundColor = colors.light;
        document.querySelector('.right-section').style.backgroundColor = colors.dark;

        // Update text colors for items in the right section
        document.querySelectorAll('.right-section, .right-section *').forEach(item => {
            item.style.color = colors.textColor;
        });

        // Update heading section colors
        document.querySelectorAll('.section-title').forEach(item => {
            item.style.color = colors.headingColor;
        });

        // Update border colors and hover effect for items
        const styleSheet = document.styleSheets[0];
        const existingHoverRules = Array.from(styleSheet.cssRules).find(rule =>
            rule.selectorText && rule.selectorText.includes('.right-section .project-item:hover, .right-section .education-item:hover, .right-section .experience-item:hover')
        );

        if (existingHoverRules) {
            styleSheet.deleteRule(Array.from(styleSheet.cssRules).indexOf(existingHoverRules));
        }

        styleSheet.insertRule(`
    .right-section .project-item:hover, 
    .right-section .education-item:hover, 
    .right-section .experience-item:hover {
      background-color: ${colors.itemHoverBackground} !important;
      border-left: 3px solid ${colors.itemHoverBorderColor} !important;
      padding-left: 18px;
      transition: border-color 0.3s ease-in-out, padding-left 0.3s ease-in-out;
    }
  `, styleSheet.cssRules.length);


        const printStyles = `
    @media print {
      .left-section {
        background-color: ${colors.light} !important;
        border-right: 2px solid ${colors.borderColor} !important;
      }
      .right-section {
        background-color: ${colors.dark} !important;
        color: ${colors.textColor} !important;
      }
      .section-title {
        color: ${colors.headingColor} !important;
      }
    }
  `;

        // Add the dynamic print styles to the document head
        let printStyleElement = document.getElementById('dynamic-print-styles');
        if (printStyleElement) {
            printStyleElement.innerHTML = printStyles;
        } else {
            printStyleElement = document.createElement('style');
            printStyleElement.id = 'dynamic-print-styles';
            printStyleElement.innerHTML = printStyles;
            document.head.appendChild(printStyleElement);
        }

        // AJAX request to save the selected theme
        $.ajax({
            url: "actions/action.theme_update.php",
            type: "POST",
            data: {
                resume_id: <?= @$resume['id'] ?>,
                theme: selectedTheme
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    $(document).ready(function() {
        const selectedTheme = "<?php echo !empty($resume['theme']) ? $resume['theme'] : 'defaultTheme'; ?>";
        $(".theme-block").each(function() {
            if ($(this).data("theme") === selectedTheme) {
                $(this).addClass("selected");

                // Apply initial styles based on the loaded theme
                selectTheme(this);
            }
        });
    });

    document.getElementById('share-btn').addEventListener('click', async function() {
        if (navigator.share) {
            try {
                await navigator.share({
                    title: 'Check out this resume!',
                    text: 'Click the link to view the resume.',
                    url: window.location.href
                });
                console.log('Successfully shared');
                alert('Resume shared successfully!');
            } catch (error) {
                console.error('Error sharing:', error);
            }
        } else {
            alert('Web Share API is not supported in your browser.');
        }
    });

    $("#save-btn").click(function() {
        $("#extraFunctionlities").hide();
        window.print();
        setTimeout(() => {
            $("#extraFunctionlities").show();
        }, 1000);
    });
</script>