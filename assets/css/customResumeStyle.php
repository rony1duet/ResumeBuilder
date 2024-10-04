<style>
    @page {
        size: A4;
        margin: 0;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f0f8ff 0%, #c5d8e8 100%);
        color: #333;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .action-buttons button {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        transition: transform 0.2s, background-color 0.3s;
    }

    .action-buttons button:hover {
        transform: scale(1.05);
        background-color: #d8d8d8;
    }

    .offcanvas {
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 8px;
        transition: height 0.3s ease-in-out;
    }

    select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        margin-top: 10px;
        border: 1px solid #ccc;
    }

    select option {
        font-size: 18px;
    }

    /*.offcanvas design*/
    .theme-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        max-height: calc(100vh - 100px);
        overflow-y: auto;
        scrollbar-width: none;
    }

    .theme-container::-webkit-scrollbar {
        display: none;
    }

    .theme-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        /* Center each theme block and its label */
    }

    .theme-block {
        display: flex;
        width: 80px;
        height: 120px;
        border: 2px solid transparent;
        border-radius: 6px;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .theme-block:hover {
        transform: scale(1.05);
    }

    .theme-block.selected {
        border-color: #118AB2;
        /* Change to a color to indicate selection */
    }

    .light-section,
    .dark-section {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .light-section {
        border-right: 1px solid #ddd;
        /* Divider between light and dark sections */
    }

    .theme-name {
        margin-top: 8px;
        font-size: 14px;
        color: #333;
        text-align: center;
    }

    .offcanvas-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .offcanvas-header h5 {
        margin: 0;
        font-size: 24px;
    }

    .resume-container {
        max-width: 210mm;
        height: 297mm;
        margin: 20px auto;
        display: flex;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        animation: fadeIn 0.8s ease forwards;
    }

    .left-section {
        flex: 1;
        background: #f7f9fc;
        padding: 25px;
        position: relative;
        border-right: 2px solid #d6d6d6;
        animation: slideInLeft 1s ease;
    }

    .right-section {
        flex: 2;
        background: #1a1b2e;
        padding: 25px;
        color: #f0f0f5;
        animation: slideInRight 1s ease;
    }

    @keyframes slideInLeft {
        0% {
            opacity: 0;
            transform: translateX(-100px);
        }

        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        0% {
            opacity: 0;
            transform: translateX(100px);
        }

        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes bounceIn {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }

        60% {
            transform: scale(1.05);
            opacity: 1;
        }

        100% {
            transform: scale(1);
        }
    }

    .profile-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .profile-header h2:hover {
        color: #007bff;
        transform: translateY(-2px);
        transition: color 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
        animation: bounceIn 1s ease;
    }

    .profile-image:hover {
        transform: scale(1.05);
        transition: 0.5s ease-in-out;
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #444;
        margin-top: 20px;
        margin-bottom: 10px;
        border-bottom: 1px solid #e5e5e5;
        padding-bottom: 5px;
        display: flex;
        align-items: center;
        animation: fadeIn 0.8s ease;
    }

    .section-title i {
        margin-right: 10px;
        color: #007bff;
    }

    .right-section .section-title {
        color: #ececec;
        border-bottom: 1px solid #444;
    }

    .contact-item,
    .reference-item,
    .experience-item,
    .education-item,
    .project-item {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    .references .reference-item:nth-child(1),
    .work-experience .experience-item:nth-child(1),
    .education .education-item:nth-child(1),
    .projects .project-item:nth-child(1) {
        animation-delay: 0.2s;
    }

    .references .reference-item:nth-child(2),
    .work-experience .experience-item:nth-child(2),
    .education .education-item:nth-child(2),
    .projects .project-item:nth-child(2) {
        animation-delay: 0.4s;
    }

    .contact-item {
        display: flex;
        align-items: center;
        margin: 8px 0;
        font-size: 12px;
        color: #444;
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    .contact-item span {
        margin-left: 10px;
    }

    .contact-item a {
        margin-left: 10px;
        font-size: 11px;
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
        max-width: 220px;
        color: #444;
        text-decoration: none;
    }

    .contact-item a:hover {
        color: #007bff;
    }

    .skill-item {
        background: #e1f5ff;
        border-radius: 12px;
        padding: 5px 10px;
        margin: 5px 5px 5px 0;
        display: inline-block;
        font-size: 12px;
        color: #007bff;
        animation: fadeInUp 0.6s ease forwards;
    }

    .skill-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        transition: 0.3s ease;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        color: #007bff;
    }

    /* User-friendly animations with improved colors */

    .experience-item:hover,
    .project-item:hover,
    .education-item:hover {
        background-color: rgba(30, 144, 255, 0.08);
        border-radius: 6px;
        padding: 12px;
        transition: background-color 0.3s ease, padding 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .right-section .project-item,
    .right-section .education-item,
    .right-section .experience-item {
        border-left: 3px solid transparent;
        padding-left: 15px;
        transition: border-color 0.3s ease, padding-left 0.3s ease;
    }

    .right-section .project-item:hover,
    .right-section .education-item:hover,
    .right-section .experience-item:hover {
        border-left: 3px solid #5cb3ff;
        padding-left: 18px;
        transition: border-color 0.3s ease-in-out, padding-left 0.3s ease-in-out;
    }


    a:hover,
    .contact-item a:hover {
        color: #3498db;
        transition: color 0.3s ease-in-out;
    }

    .profile-header h2:hover {
        color: #1e90ff;
        transform: translateY(-3px);
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .profile-image:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }


    @media print {
        body {
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            background: linear-gradient(135deg, #f0f8ff 0%, #c5d8e8 100%) !important;
            /* Preserve background gradient */
            color: #333 !important;
            /* Preserve text color */
        }

        /* Ensure that background colors, gradients, and text colors are preserved */
        * {
            background-color: inherit !important;
            color: inherit !important;
        }

        .resume-container {
            width: 210mm;
            height: 297mm;
            box-shadow: none;
            margin: 0;
            border-radius: 10px !important;
            page-break-after: avoid !important;
            background: white !important;
        }

        .left-section {
            background: #f7f9fc !important;
            border-right: 2px solid #d6d6d6 !important;
        }

        .skill-item {
            background: #e1f5ff !important;
            border-radius: 12px;
            padding: 5px 10px;
            margin: 5px 5px 5px 0;
            display: inline-block;
            font-size: 12px;
        }

        .right-section {
            background: #1a1b2e !important;
            color: #f0f0f5 !important;
        }

        /* Hide elements that should not be printed */
        #extraFunctionlities {
            display: none !important;
        }

        /* Remove any transitions or animations that are not necessary for print */
        .action-buttons {
            display: none !important;
        }

        .profile-header h2,
        .profile-image {
            transform: none !important;
        }
    }
</style>