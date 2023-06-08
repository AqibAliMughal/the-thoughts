/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.28-MariaDB : Database - the-thoughts
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`the-thoughts` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `the-thoughts`;

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `blog_title` varchar(11) DEFAULT NULL,
  `post_per_page` int(11) DEFAULT NULL,
  `blog_background_image` text DEFAULT NULL,
  `blog_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`blog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `blog` */

insert  into `blog`(`blog_id`,`user_id`,`blog_title`,`post_per_page`,`blog_background_image`,`blog_status`,`created_at`,`updated_at`) values 
(1,NULL,NULL,NULL,NULL,NULL,'2023-05-12 21:02:46','2023-05-12 21:02:46'),
(2,44,'TechFo',4,'Admin_ID[44]_1126blog2.jpg','Active','2023-05-12 23:59:42','2023-05-12 21:13:20'),
(3,44,'Tech.AI',5,'Admin_ID[44]_3905blog2.png','InActive','2023-05-13 00:08:18','2023-05-12 21:16:05'),
(4,45,'Educate',4,'Admin_ID[45]_3320solid1.jpg','Active','2023-05-15 09:42:38','2023-05-15 09:42:38'),
(5,45,'Techkor',6,'Admin_ID[44]_2664card7.jpg','Active','2023-05-16 01:28:50','2023-05-16 01:28:50'),
(6,44,'Educationis',6,'Admin_ID[44]_2664card7.jpg','Active','2023-05-16 01:29:41','2023-05-16 01:29:41'),
(7,45,'Freelancing',6,'Admin_ID[44]_3881card7.jpg','Active','2023-05-16 01:30:16','2023-05-16 01:30:16');

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  `category_status` enum('Active','InActive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `category` */

insert  into `category`(`category_id`,`category_title`,`category_description`,`category_status`,`created_at`,`updated_at`) values 
(1,'Action Gaming','Gaming category that contains all the post related to action, arcade, mind games.					 ','Active','2023-05-13 10:16:30','2023-05-13 08:18:23'),
(2,'Technology','Technology is the application of knowledge for achieving practical goals in a reproducible lorem ipsum','Active','2023-05-13 12:23:17','2023-05-13 12:32:51'),
(3,'Artifical Intelligence','Artificial intelligence is intelligence—perceiving, synthesizing, and inferring information—demonstrated by machines					','InActive','2023-05-13 10:32:31','2023-05-13 10:28:56'),
(4,'Science','Science is a fun','Active','2023-05-13 20:17:27','2023-05-15 12:25:21'),
(5,'Education','A key to success..','Active','2023-05-13 20:19:59','2023-05-15 12:26:14');

/*Table structure for table `following_blog` */

DROP TABLE IF EXISTS `following_blog`;

CREATE TABLE `following_blog` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `blog_following_id` int(11) DEFAULT NULL,
  `status` enum('Followed','Unfollowed') DEFAULT 'Followed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`follow_id`),
  KEY `blog_following_id` (`blog_following_id`),
  KEY `follower_id` (`follower_id`),
  CONSTRAINT `following_blog_ibfk_1` FOREIGN KEY (`blog_following_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `following_blog_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `following_blog` */

insert  into `following_blog`(`follow_id`,`follower_id`,`blog_following_id`,`status`,`created_at`,`updated_at`) values 
(1,53,2,'Followed','2023-05-18 12:55:27','2023-05-18 12:55:34'),
(2,56,4,'Followed','2023-05-18 12:58:10','2023-05-18 12:58:14'),
(3,44,3,'Unfollowed','2023-05-23 15:30:32','2023-05-23 15:30:32');

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_summary` text NOT NULL,
  `post_description` longtext NOT NULL,
  `featured_image` text DEFAULT NULL,
  `post_status` enum('Active','InActive') DEFAULT 'Active',
  `is_comment_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`post_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post` */

insert  into `post`(`post_id`,`blog_id`,`post_title`,`post_summary`,`post_description`,`featured_image`,`post_status`,`is_comment_allowed`,`created_at`,`updated_at`) values 
(1,2,'Hyundai Tucson Gets An Advanced New Feature in Pakistan','Basic equipment no longer suffices for customers seeking vehicles that provide a comprehensive package encompassing convenience, comfort, and, most importantly, safety.\r\n\r\nHyundai Nishat Motor, a relatively new player in the Pakistani automotive industry, has swiftly emerged as a strong contender across various segments.','\r\n\r\nOne such segment is the C-SUV category, where the Hyundai Tucson has gained popularity since its launch, becoming one of the most sought-after C-SUVs on the roads and the top choice for customers.\r\n\r\nHyundai has now raised the safety bar by introducing front and rear parking sensors in the top-of-the-line Tucson AWD variant.\r\n\r\nBy incorporating front and rear parking sensors into the Hyundai Tucson AWD, the brand showcases its commitment to delivering advanced safety features. It aims to be best-in-class within its category.\r\n\r\nParking sensors have revolutionized maneuvering in tight spaces, reducing the risk of collisions and transforming parking into a hassle-free task.\r\n\r\nThe front and rear parking sensors in the Tucson AWD employ cutting-edge technology to detect obstacles within close proximity to the vehicle.\r\n\r\nEquipped with ultrasonic and radar sensors, this system accurately measures distances and alerts the driver through audio and visual cues.\r\n\r\nAs the vehicle approaches an object, the sensors emit a series of beeps that intensify, enabling the driver to effectively gauge the distance to the obstacle with the help of visual alerts on the MID screen and beep alerts.\r\n\r\nApart from the newly added parking sensors, the Tucson AWD comes with a range of other features, including a smart tailgate, panoramic sunroof, HTRAC all-wheel drive system, differential lock, wireless charger, puddle lamps, ECM mirror with a compass, power seats with lumbar support, and a cooled glove box.\r\n\r\nEnhanced safety is ensured through features like downhill brake control, dual SRS airbags, hill-start assist, an anti-lock braking system, and a shell crafted from Advanced High Strength Steel (AHSS).\r\n\r\nHyundai’s decision to equip the Tucson AWD with parking sensors reflects the brand’s understanding of Pakistani consumers’ evolving needs and expectations.','Post_1099card4.jpg','Active',1,'2023-05-17 10:43:02',NULL),
(9,3,'How AI is revolutionizing the world, Read.','Developing safe and beneficial AI requires people from a wide range of disciplines and backgrounds. View careers. I encourage my team to keep learning. Ideas in different topics or fields can often inspire new ideas and broaden the potential solution space.','As an information and computer science company, we aim to and have been at the forefront of advancing the frontier of AI through our path-breaking and field-defining research to develop more capable and useful AI. From this research and development, we are bringing breakthrough innovations into the real world to assist people and benefit society everywhere through our infrastructure, tools, products and services, as well as through enabling and working with others to benefit society. We are also pursuing innovations that will help to unlock scientific discoveries and to tackle humanity’s greatest challenges and opportunities. Many of our innovations are already assisting and benefiting people (in some cases billions of people), communities, businesses, and organizations, and society broadly—with more such innovations still to come. ','Post_1257card4.jpg','Active',1,'2023-05-17 10:21:28','2023-05-16 10:35:14'),
(11,2,'A flower-shaped soft robot could make brain monitoring less invasive','A tiny, flexible machine might one day help neuroscientists eavesdrop on electrical activity in the brain, allowing them to pinpoint and potentially treat seizures.','The robotic device consists of a central hub surrounded by six flat, petal-shaped sensors made of a soft, flexible material. At first, the petals are inverted into the hub. “It’s a bit like a glove where … you flip it outside in,” says Stéphanie Lacour, a bioengineer at École Polytechnique Fédérale de Lausanne in Geneva.','Post_1127card4.jpg','InActive',0,'2023-05-17 10:21:22','2023-05-20 11:36:02'),
(20,6,'Education is the booster','fsdlks','DKLFJSLKDFJLKSD ASLDK','Post_1127card4.jpg','InActive',0,'2023-05-17 14:32:32','2023-05-17 02:51:38'),
(21,6,'Not my circus not my monkeys','Keep doing, whatever.','DKLFJSLKDFJLKSD ASLDK','card3.jpg','InActive',1,'2023-05-17 12:57:31','2023-05-17 02:52:54'),
(22,3,'Why Community Spaces are Important?','Community spaces seem like they are fast becoming sparse, and realistically, the world needs them more than ever. While many are socializing behind their screens and are feeling lonelier for it,','Community spaces provide a chance for social interaction that would be difficult or might not even happen otherwise. When you go somewhere like the park, a fate, or attend any community event, you can meet new people and interact with your neighbors. These spontaneous interactions that are facilitated by community areas can lead to new friendships and connections, which can be invaluable to both the individuals and also the local area as a whole too. \r\n\r\nCrucially, community spaces can also be a catalyst for civic engagement. When someone is able to attend a town hall meeting at their local community center, volunteer at a neighborhood clean-up event, or create a fundraiser for the benefit of locals, they are able to take an active role in shaping their community. If you are someone who wants to build a place where people can contribute to a greater cause for the community, then make sure to hire professionals who can help you ensure everything is in place, such as site survey and construction, and go from there. ','Post_1578card4.jpg','Active',1,'2023-05-17 10:21:51','2023-05-17 02:45:05'),
(23,4,'Visa rules in Saudi Arabia are being revised significantly','a recent initiative allows Saudis and expatriates to receive Sudanese pilgrims as guests by converting their Umrah visas into visitor visas.','The Jawazat has started extending visas for Sudanese Umrah pilgrims who are unable to return home due to the conflict there. In addition, they have made it simpler for Saudis and ex-pats to welcome them by launching a service called “Hosting Sudanese Pilgrims” on the electronic platform Absher Individuals (Absher Afrad) run by the Ministry of Interior.\r\n\r\nWith the advent of this new service, Saudi nationals and residents who are acquainted with or related to Sudanese pilgrims may host them. Depending on the terms and restrictions on the Absher platform, the service converts the Umrah visa to a visit visa (either family or personal).','Post_1127card4.jpg','InActive',1,'2023-05-17 10:21:54','2023-05-17 02:41:42'),
(24,5,'Elon Musk Announces New Boss for Twitter','Mr. Musk’s decision to appoint a new boss at Twitter follows calls from shareholders and Twitter users alike for him to step down as CEO.','The announcement of a new chief executive for Twitter has been welcomed by investors, with Tesla shares rising following the news. Mr. Musk has previously been criticized for neglecting Tesla after his takeover of Twitter, damaging the car company’s brand. “We at last view this as a significant forward-moving step with Musk at long last perusing the room that has been around this Twitter bad dream,” said Dan Ives from the venture company Wedbush Securities. “Trying to balance Twitter, Tesla, and SpaceX as CEOs [is] an impossible task that needed to change”.','card3.jpg','InActive',1,'2023-05-17 10:46:30','2023-05-17 02:42:15'),
(25,3,'Exploring the Power of Generative AI: Google’s Search Lab Tests Unveiled','The achievements of OpenAI have solidly brought generative artificial intelligence technology into the spotlight of the promoting business, similar to the far-reaching reconciliation of the internet during the 1990s and the rise of cell phones and social media in the last part of the 2000s and mid-2010s.','The popularity of ChatGPT, which is thought to have reached 100 million users in January of this year, has also appeared to give Microsoft power over the industry narrative. Recently, Microsoft divulged a chat API that offers a platform for outsider distributors to adapt their substance with ads.\r\n\r\nThe industry leader Google, which will follow up this week’s developer conference Google I/O with its YouTube upfront (named Brandcast) and Google Marketing Live in the following weeks, was foreclosed by Bing’s chat API.\r\n\r\nThe online juggernaut debuted its Search Labs experiments at Google I/O, culminating in the Search Generative Experience, or “SGE,” which aims to imitate the recent success of the Microsoft camp by employing a chat interface in a similar way.','Post_1578card4.jpg','InActive',1,'2023-05-17 10:21:58','2023-05-17 02:53:14'),
(26,6,'Not my circus not my monkeys','Keep doing, whatever.','DKLFJSLKDFJLKSD ASLDK','Post_1357card4.jpg','InActive',1,'2023-05-17 10:22:00','2023-05-17 02:40:16'),
(28,2,'A request to the government of Pakistan to unblock social media across the country','We, the freelance community, would like to address a humble request regarding the availability of Internet and social media platforms in Pakistan. As individuals relying heavily on online work opportunities, we believe that unrestricted internet and social media access is crucial for our livelihood and economic well-being.\"','By opening up the internet and social media platforms, the Government of Pakistan would not only empower the freelance community but also contribute to the country’s overall economic growth. This is not affecting only the freelance community but also online businesses like food panda, Indriver, etc. Freelancers possess diverse skill sets and can provide a wide range of services such as web development, graphic design, content writing, and digital marketing. With an unrestricted internet and social media environment, freelancers would have the opportunity to connect with clients worldwide, secure projects, and generate income. This would not only reduce unemployment but also create a positive impact on Pakistan’s economy.\r\n\r\nWe kindly urge the Government of Pakistan to consider our request to open the internet and social media (Facebook, Twitter, YouTube, Instagram, Tiktok), providing freelancers with the platform they need to work online and make a sustainable living.\r\n\r\nWe believe that to                            ','Post_3251post.jpg','InActive',1,'2023-05-18 09:25:32','2023-05-20 04:08:21');

/*Table structure for table `post_atachment` */

DROP TABLE IF EXISTS `post_atachment`;

CREATE TABLE `post_atachment` (
  `post_atachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `post_attachment_title` varchar(200) DEFAULT NULL,
  `post_attachment_path` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`post_atachment_id`),
  KEY `fk1` (`post_id`),
  CONSTRAINT `fk1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_atachment` */

insert  into `post_atachment`(`post_atachment_id`,`post_id`,`post_attachment_title`,`post_attachment_path`,`is_active`,`created_at`,`updated_at`) values 
(1,1,'attachment_2262post-create.php.pdf','attachment_2262C:xamppMorning	mpphp63E1.tmp',NULL,'2023-05-16 11:32:44','2023-05-16 11:32:44'),
(2,1,'attachment_2492post-create.php.pdf','attachment_2492C:xamppMorning	mpphp199.tmp',NULL,'2023-05-16 11:33:24','2023-05-16 11:33:24'),
(3,1,'attachment_3505post-create.php.pdf','attachment_3505C:xamppMorning	mpphp26D5.tmp',NULL,'2023-05-16 11:33:34','2023-05-16 11:33:34'),
(4,1,'post-create.php.pdf','C:xamppMorning	mpphpAEED.tmp',NULL,'2023-05-16 11:35:14','2023-05-16 11:35:14'),
(5,1,'post-create.php.pdf','C:xamppMorning	mpphp7F1F.tmp',NULL,'2023-05-16 11:36:07','2023-05-16 11:36:07'),
(12,20,'post-create.php.pdf','C:xamppMorning	mpphp7A94.tmp',NULL,'2023-05-16 12:32:54','2023-05-16 12:32:54'),
(13,21,'post-create.php.pdf','C:xamppMorning	mpphpE7BF.tmp',NULL,'2023-05-16 12:38:50','2023-05-16 12:38:50'),
(14,22,'post-create.php.pdf','C:xamppMorning	mpphp684.tmp',NULL,'2023-05-16 12:38:57','2023-05-16 12:38:57'),
(15,23,'','',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
(16,24,'post-create.php.pdf','C:xamppMorning	mpphp2685.tmp',NULL,'2023-05-16 12:42:22','2023-05-16 12:42:22'),
(17,25,'post-create.php.pdf','C:xamppMorning	mpphp58F1.tmp',NULL,'2023-05-16 12:42:35','2023-05-16 12:42:35'),
(18,26,'post-create.php.pdf','C:xamppMorning	mpphp9F14.tmp',NULL,'2023-05-16 12:42:53','2023-05-16 12:42:53'),
(19,28,'Why unlock the social media?','post-create.php.pdf',NULL,'2023-05-18 09:25:32','2023-05-18 09:25:32');

/*Table structure for table `post_category` */

DROP TABLE IF EXISTS `post_category`;

CREATE TABLE `post_category` (
  `post_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`post_category_id`),
  KEY `post_id` (`post_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_category` */

insert  into `post_category`(`post_category_id`,`post_id`,`category_id`,`created_at`,`updated_at`) values 
(6,1,2,'2023-05-16 10:53:29','2023-05-16 10:53:29'),
(7,1,3,'2023-05-16 10:53:29','2023-05-16 10:53:29'),
(9,11,2,'2023-05-16 12:06:21','2023-05-16 12:06:21'),
(18,9,5,'2023-05-16 12:32:54','2023-05-16 12:32:54'),
(19,21,5,'2023-05-16 12:38:49','2023-05-16 12:38:49'),
(20,22,5,'2023-05-16 12:38:57','2023-05-16 12:38:57'),
(21,23,5,'2023-05-16 12:39:48','2023-05-16 12:39:48'),
(22,24,5,'2023-05-16 12:42:22','2023-05-16 12:42:22'),
(23,25,5,'2023-05-16 12:42:35','2023-05-16 12:42:35'),
(24,26,5,'2023-05-16 12:42:53','2023-05-16 12:42:53'),
(25,28,2,'2023-05-18 09:25:32','2023-05-18 09:25:32'),
(26,28,5,'2023-05-18 11:08:27','2023-05-18 11:08:27');

/*Table structure for table `post_comment` */

DROP TABLE IF EXISTS `post_comment`;

CREATE TABLE `post_comment` (
  `post_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT 'InActive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`post_comment_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_comment` */

insert  into `post_comment`(`post_comment_id`,`post_id`,`user_id`,`comment`,`is_active`,`created_at`) values 
(1,28,53,'Social media is essential. #unblockSocialMedia #openSocialMedia','InActive','2023-05-20 10:30:23'),
(2,28,53,'Unblock social media...!','Active','2023-05-20 10:32:47'),
(3,28,53,'No words','Active','0000-00-00 00:00:00'),
(4,28,56,'Go for twitter trends it will work definetly ','Active','2023-05-20 11:15:58'),
(6,25,56,'AI is the future.','Active','2023-06-08 09:21:10');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(50) NOT NULL,
  `is_active` enum('Active','InActive') DEFAULT 'Active',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `role` */

insert  into `role`(`role_id`,`role_type`,`is_active`) values 
(1,'Admin','Active'),
(2,'User','Active');

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `setting_key` varchar(100) DEFAULT NULL,
  `setting_value` varchar(100) DEFAULT NULL,
  `setting_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`setting_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `setting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `setting` */

insert  into `setting`(`setting_id`,`user_id`,`setting_key`,`setting_value`,`setting_status`,`created_at`,`updated_at`) values 
(1,44,'color;background-color;font-size;font-family','#6e6e6e;#eeeeee;14;monospace',NULL,'2023-05-23 09:14:49','2023-05-23 03:33:33'),
(2,53,'color;background-color;font-size;font-family','#1b1b1b;#d0cfbf;;',NULL,'2023-05-23 09:15:48','2023-05-23 09:15:48');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT 2,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `user_image` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_approved` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `is_active` enum('Active','InActive') DEFAULT 'InActive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`user_id`,`role_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`user_image`,`address`,`is_approved`,`is_active`,`created_at`,`updated_at`) values 
(1,2,'Cally','Whitfield','lujigow@mailinator.com','123','Female','2022-11-16','Image_3212user2.jpg','Labore iste qui fugi','Approved','InActive','2023-05-12 21:52:57','2023-05-09 23:19:52'),
(44,1,'Ahmed Ali','Baloch','admin@gmail.com','admin','Male','1998-11-11','Image_3212user2.jpg','djsdhajk','Approved','Active','2023-05-12 20:37:11','2023-05-10 05:38:51'),
(45,1,'ABC','john','hyder@gmail.com','12345','Female','1996-01-18','Image_2563user1.png','Random address of user.......','Approved','InActive','2023-05-12 21:30:36','2023-05-10 05:39:05'),
(53,2,'Shezor','Ali','s@gmail.com','123','Male','2001-09-19','updated_Image_1248updated_Image_1405card8.jpg','Karachi','Approved','Active','2023-05-12 21:44:01','2023-05-23 10:33:48'),
(54,2,'Alexander','Valdez','wejocefe@mailinator.com','Pa$$w0rd!','Male','2000-06-15','Image_3212user2.jpg','Adipisicing lorem cu','Rejected','Active','2023-05-12 10:54:00','2023-05-11 09:34:31'),
(55,2,'Samson','Todd','hiliqe@mailinator.com','Pa$$w0rd!','Female','2020-06-14','Image_2563user1.png','Non Nam omnis dolore','Approved','InActive','2023-05-12 21:01:55','2023-06-07 09:15:12'),
(56,2,'Abrar','Ahmed','ab@gmail.com','abrar123','Male','1996-03-10','Image_3212user2.jpg','Abrar ahmed house number 04004','Pending','InActive','2023-05-12 22:09:18','2023-05-11 09:39:14'),
(57,2,'Abra','Ashley','nuvomujom@mailinator.com','abra','Female','1992-03-04','Image_3212user2.jpg','Europe','Pending','InActive','2023-05-12 22:01:28','2023-06-07 09:16:25'),
(59,2,'Vance','Coffey','sexene@mailinator.com','Pa$$w0rd!','Male','2003-12-21','user3.jpg','Labore dolor aliqua','Pending','InActive','2023-05-15 09:28:53','2023-05-15 09:28:53'),
(61,2,'Daquan','Hood boy','disozuh@mailinator.com','Pa$$w0rd!','Female','1993-07-13','Image_1952user3.png','Nihil eius dolores l','Pending','InActive','2023-05-15 09:31:20','2023-06-07 02:29:34');

/*Table structure for table `user_feedback` */

DROP TABLE IF EXISTS `user_feedback`;

CREATE TABLE `user_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`feedback_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_feedback` */

insert  into `user_feedback`(`feedback_id`,`user_id`,`user_name`,`user_email`,`feedback`,`created_at`,`updated_at`) values 
(1,NULL,NULL,'asha@gmail.com',NULL,'2023-05-15 10:39:23','2023-05-15 10:39:23'),
(2,53,NULL,'s@gmail.com','Website is stateless...','2023-05-15 10:50:19',NULL),
(3,NULL,'Devin','fixihim@mailinator.com','Nam laboriosam adip','2023-05-15 11:00:52','2023-05-15 11:00:52'),
(4,44,NULL,'admin@gmail.com','sjashdkjsahdksajh','2023-05-15 11:25:00','2023-05-15 11:25:00'),
(5,44,NULL,'admin@gmail.com','sjashdkjsahdksajh','2023-05-15 11:27:52','2023-05-15 11:27:52'),
(6,44,NULL,'admin@gmail.com','smndbmndbasmndbasmndb','2023-05-15 11:28:07','2023-05-15 11:28:07'),
(7,44,NULL,'admin@gmail.com','dlkjd aljasldaslkdjalj amasdlakdalk ewqij...','2023-05-15 11:28:33','2023-05-15 11:28:33'),
(8,NULL,'Muzamil','m@gmail.com','This feeback is from unknown user...','2023-05-15 11:29:55','2023-05-15 11:29:55'),
(9,NULL,'Asadullah','asad@gmail.com','Asad an unknown user...','2023-05-15 11:30:52','2023-05-15 11:30:52'),
(10,53,NULL,'s@gmail.com','Can I become a part of your website? I also write blogs.','2023-05-21 15:51:59','2023-05-21 15:51:59');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
