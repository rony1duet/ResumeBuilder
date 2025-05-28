SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+06:00";

CREATE TABLE `resumes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resume_title` varchar(250) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `portfolio` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `updated_at` int(20) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `profile_picture` text DEFAULT NULL,
  `font` varchar(250) DEFAULT NULL,
  `theme` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `resume_education` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `institution` varchar(100) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) DEFAULT NULL,
  `achievements` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `resume_experience` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `resume_projects` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `project_link` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `resume_references` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `company` varchar(250) NOT NULL,
  `position` varchar(250) NOT NULL,
  `relationship` varchar(250) NOT NULL,
  `ref_email` varchar(250) DEFAULT NULL,
  `ref_number` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `resume_skills` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `skill` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `email_id` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `resume_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`);

ALTER TABLE `resume_experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`);

ALTER TABLE `resume_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`);

ALTER TABLE `resume_references`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`);

ALTER TABLE `resume_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

ALTER TABLE `resumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `resume_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `resume_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `resume_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `resume_references`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `resume_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `resumes`
  ADD CONSTRAINT `resumes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

ALTER TABLE `resume_education`
  ADD CONSTRAINT `resume_education_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

ALTER TABLE `resume_experience`
  ADD CONSTRAINT `resume_experience_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

ALTER TABLE `resume_projects`
  ADD CONSTRAINT `resume_projects_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

ALTER TABLE `resume_references`
  ADD CONSTRAINT `resume_references_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

ALTER TABLE `resume_skills`
  ADD CONSTRAINT `resume_skills_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

COMMIT;
