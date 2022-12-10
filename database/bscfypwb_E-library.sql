-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2022 at 11:08 PM
-- Server version: 10.6.11-MariaDB-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bscfypwb_E-library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(6) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_name`, `email`, `password`, `created_datetime`, `updated_datetime`) VALUES
(1, 'Christopher George', 'scpgelibrarycontrol@gmail.com', '$1$2FCFG7FN$F6g426H8loGI/lU23Rd1S/', '2022-11-23 10:27:42', '2022-11-23 10:27:42');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `download_ID` int(12) NOT NULL,
  `material_ID` int(6) NOT NULL,
  `student_ID` varchar(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`download_ID`, `material_ID`, `student_ID`, `datetime`) VALUES
(11, 195, 'SCPG1800369', '2022-11-23 10:52:01'),
(12, 192, 'SCPG1800369', '2022-11-23 10:55:56'),
(13, 186, 'SCPG1800369', '2022-11-23 11:02:24'),
(14, 181, 'SCPG1800369', '2022-11-23 11:02:42'),
(15, 180, 'SCPG1800369', '2022-11-23 11:03:20'),
(16, 173, 'SCPG1800369', '2022-11-23 11:03:51'),
(17, 186, 'SCPG1800366', '2022-11-23 11:38:05'),
(18, 180, 'SCPG1800366', '2022-11-23 11:41:45'),
(19, 195, 'SCPG1800369', '2022-11-24 12:49:00'),
(20, 195, 'SCPG1800369', '2022-11-29 04:37:06'),
(21, 198, 'SCPG1800369', '2022-12-01 01:25:15'),
(22, 197, 'SCPG1800368', '2022-12-01 03:00:33'),
(23, 199, 'SCPG1800368', '2022-12-01 03:16:04'),
(24, 199, 'SCPG1800368', '2022-12-01 04:04:22'),
(25, 217, 'SCPG1800368', '2022-12-02 04:22:00'),
(26, 200, 'SCPG1800369', '2022-12-04 05:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `librarian_ID` int(6) NOT NULL,
  `admin_ID` int(6) NOT NULL,
  `librarian_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`librarian_ID`, `admin_ID`, `librarian_name`, `email`, `password`, `created_datetime`, `updated_datetime`) VALUES
(1, 1, 'Tan Yao Mao', 'scpgelibrary@gmail.com', '$2y$10$iBr1w9H4JrebbslnWsf/1O.Og2BEUvRgaTKYY1J63bSR7T4zNXAti', '2022-11-23 21:00:01', '2022-12-04 11:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_ID` int(11) NOT NULL,
  `librarian_ID` int(6) NOT NULL,
  `material_title` varchar(399) NOT NULL,
  `author_name` varchar(288) NOT NULL,
  `publish_year` varchar(7) NOT NULL,
  `material_genre` varchar(21) NOT NULL,
  `page_num` int(4) NOT NULL,
  `cover_name` varchar(10) NOT NULL,
  `description` varchar(1993) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_ID`, `librarian_ID`, `material_title`, `author_name`, `publish_year`, `material_genre`, `page_num`, `cover_name`, `description`, `created_datetime`, `updated_datetime`) VALUES
(165, 1, 'The Call of Cthulhu', 'H. P. Lovecraft', '1926', 'Horror', 28, '165.jpg', 'Three independent narratives linked together by the device of a narrator discovering notes left by a deceased relative. Piecing together the whole truth and disturbing significance of the information he possesses, the narrator\'s final line is \'\'The most merciful thing in the world, I think, is the inability of the human mind to correlate all its contents.\'\'', '2022-09-24 16:49:13', '2022-11-19 05:02:29'),
(166, 1, 'Metamorphosis', 'Franz Kafka', '1912', 'Horror', 53, '166.jpg', 'lerk, while his father continued to speak through the door. \"He isn\'t well, please believe me. Why else would Gregor have missed a train! The lad only ever thinks about the business. It nearly makes me cross the way he never goes out in the evenings; he\'s been in town for a week now but stayed home every evening. He sits with us in the kitchen and just reads the paper or studies train timetables. His idea of relaxation is working with his fretsaw. He\'s made a little frame, for instance, it only took him two or three evenings, you\'ll be amazed how nice it is; it\'s hanging up in his room; you\'ll see it as soon as Gregor opens the door. Anyway, I\'m glad you\'re here; we wouldn\'t have been able to get Gregor to open the door by ourselves; he\'s so stubborn; and I\'m sure he isn\'t well, he said this morning that he is, but he isn\'t.\"', '2022-10-31 18:30:53', '2022-11-19 05:03:36'),
(167, 1, 'The Dunwich Horror', 'H. P. Lovecraft', '1929', 'Horror', 47, '167.jpg', 'The story of Wilbur Whateley, son of a deformed albino mother and an unknown father, and the strange events surrounding his birth and precocious development. Wilbur matures at an abnormal rate, reaching manhood within a decade--all the while indoctrinated him into dark rituals and witchcraft by his grandfather.', '2022-09-24 18:50:03', '2022-11-19 05:04:39'),
(168, 1, 'The Island of Doctor Moreau', 'H. G. Wells', '2013', 'Horror', 117, '168.jpg', 'Edward Prendick is shipwrecked in the Pacific. Rescued by Doctor Moreau\'s assistant he is taken to the doctor\'s island home where he discovers the doctor has been experimenting on the animal inhabitants of the island, creating bizarre proto-humans...', '2022-09-24 18:55:41', '2022-11-19 04:48:49'),
(169, 1, 'Dracula', 'Bram Stoker', 'Unknown', 'Horror', 347, '169.jpg', 'The world\'s best-known vampire story begins by following a naive young Englishman as he visits Transylvania to meet a client, the mysterious Count Dracula. Upon revealing his true nature, Dracula boards a ship for England, where chilling and gruesome disasters begin to befall the people of London...', '2022-11-19 09:58:35', '2022-11-19 04:50:26'),
(170, 1, 'At the Mountains of Madness', 'H. P. Lovecraft', '1936', 'Horror', 100, '170.jpg', 'On an expedition to Antarctica, Professor William Dyer and his colleagues discover the remains of ancient half-vegetable, half-animal life-forms. The extremely early date in the geological strata is surprising because of the highly-evolved features found in these previously unkown life-forms. Through a series of dark revelations, violent episodes, and misunderstandings, the group learns of Earth\'s secret history and legacy.', '2022-11-19 04:56:53', '2022-11-19 04:56:53'),
(171, 1, 'The Shadow Over Innsmouth', 'H. P. Lovecraft', '2022', 'Horror', 63, '171.jpg', 'The story describes a strange hybrid race, half-human and half an unknown creature that resembles a cross between a fish and a frog, that dwells in the seaside village of Innsmouth (formerly a large town, but lately fallen into disrepair).--Wikipedia', '2022-11-23 09:46:34', '2022-11-23 09:46:34'),
(172, 1, 'The Other Gods', 'H. P. Lovecraft', 'Unknown', 'Horror', 7, '172.jpg', 'Barzai the Wise, a high priest and prophet greatly learned in the lore of the \"gods of earth\", or Great Ones, attempts to scale the mountain of Hatheg-Kla in order to look upon their faces, accompanied by his young disciple Atal.', '2022-11-23 09:47:31', '2022-11-23 09:47:31'),
(173, 1, 'The Shadow Out of Time', 'H. P. Lovecraft', 'Unknown', 'Horror', 70, '173.jpg', 'An indirect explanation of the Great Race of Yith, an extraterrestrial species with the ability to travel through space and time. The Yithians accomplish this by switching bodies with hosts from the intended spatial or temporal destination. The story implies that the effect when seen from the outside is similar to spiritual possession.', '2022-11-23 09:49:33', '2022-11-23 09:49:33'),
(174, 1, 'Surviving-The-Evacuation', 'Frank Tayell', 'Unknown', 'Horror', 170, '174.jpg', 'No one is safe from the undead… The outbreak began in New York. Soon it had spread to the rest of the world. People were attacked, infected and they died. Then they came back. Nowhere is safe from the undead. As anarchy and civil war took grip across the globe, Britain was quarantined. The press was nationalised. Martial law, curfews and rationing were implemented. It wasn’t enough. An evacuation was planned. The inland towns and cities of the UK would be evacuated to defensive enclaves being built around the coast, in the Scottish Highlands and in the Irish Republic. ', '2022-11-23 09:50:09', '2022-11-23 09:50:09'),
(176, 1, 'Discriminant analysis application to understand the usage of digital channels while buying a car', 'Rekha Dahiya & Dimpy Sachar', '2021', 'High Quality Material', 21, 'N/A', 'The study validates that fact that car buying is no longer a unidirectional process and consumers use different digital channels for specific reasons while buying a car. The most used digital channels of communication while buying a car are websites, smartphones, social networking sites and YouTube. It was found in the study that there are distinguished characteristics such as compatibility, informative, easy to used and availability of reviews that account for the usage of particular digital channels of communication while buying a car. The study found the distinctive characteristics of various digital channels leading towards their usage while buying a car which provide valuable insights for the marketers. The study demonstrates the fact that entire car-buying journey has been transformed into a brand experience process with subtle digital interventions. Car marketers and dealers will have to change their customer outreach strategies as per the evolving mindset of the car buyers if they wish to remain competitive and relevant to “always connected” customers.', '2022-11-23 10:13:36', '2022-11-23 10:13:36'),
(177, 1, 'Experimental study of the boosters impact on the rocket aerodynamic characteristics', 'Andrzej Krzysiak & Dawid Cieslinski Robert Placek & Pawel Kekus', '2022', 'High Quality Material', 8, 'N/A', 'Through decades of rocket development, the pursuit of performance improvement accompanied constructors and scientists. Until the twentieth century, most of the rockets were single-stage constructions. However, it should be noted that the first concepts of multistage projectiles had been introduced by a Polish–Lithuanian pioneer Siemienowicz in the seventeenth century. The theoretical consideration led by Tsiolkovsky (Suresh and Sivan, 2015), resulting in the classical rocket equation, confirmed that a multistage rocket is necessary for space travel. The ability of a rocket to reach higher or further targets can be expressed by the delta-v budget (a direct result of the rocket equation), and on this basis, it is clearly seen that vehicle staging is the best feasible way to obtain performance improvements without the need for a technology breakthrough in propulsion.', '2022-11-23 10:16:57', '2022-11-23 10:16:57'),
(178, 1, 'Shades of blue in financing: transforming the ocean economy with blue bonds', 'Joywin Mathew & Claire Robertson', '2021', 'High Quality Material', 5, 'N/A', 'To provide an overview of how blue bonds can have a transformative impact on the blue- and ocean-based economies.', '2022-11-23 10:17:35', '2022-11-23 10:17:35'),
(179, 1, 'The Effects of COVID-19 Pandemic on International Trade and Production in the Age of Industry 4.0: New Evidence from European Countries', 'Unknown', '2022', 'High Quality Material', 12, 'N/A', 'The COVID-19 outbreak occurred in Wuhan region of China has significantly affected the exports and production of countries. Digitalization and technological developments have increased with the Industry 4.0, and COVID-19 measures accelerated this process. In this study, the impacts of COVID-19 pandemic have been investigated on international trade and production in European countries and Turkey. Accordingly, the cointegration relations between variables were examined with Westerlund panel cointegration test. As a result of the cointegration test, it is determined that there are long-term relationships between variables. The causality relationships between variables are analyzed with the Dumitrescu–Hurlin panel causality test. Causality analyses show that there is a unidirectional causality relationship from COVID-19 cases and deaths to export, while there is a unidirectional causality relationship from COVID-19 cases to production. The empirical findings demonstrate that COVID-19 outbreak has a significant impact on production and export processes in European countries and Turkey.', '2022-11-23 10:20:08', '2022-11-23 10:20:08'),
(180, 1, 'The consideration of Lut desert potential in the production of electric energy from solar energy', 'Mohammad Reza Bahrampour & Mohammad Bagher Askari & Vahid Mirzaei Mahmoud Abadi & Mohsen Mirhabibi & Mahdi Tikdari', '2016', 'High Quality Material', 6, 'N/A', 'This paper aims to study the Lut desert, also known as the Dasht–e–Lut, starting with a summary of its location as a large salt desert in southeastern Kerman, Iran, as well as its climate, being one of the world’s driest places. Next, a statistical analysis is performed based on a reasonable minimum level of 10 per cent. The computation of electric energy produced by sunlight in the studied region is, then, provided using a number of high-efficiency and suitable solar cells. Finally, the authors will compare the production of electrical energy to the consumption energy in Iran and Kerman province.', '2022-11-23 10:21:14', '2022-11-23 10:21:14'),
(181, 1, 'Emma', 'Jane Austen', '1815', 'Romance', 380, '181.jpg', 'The main character, Emma Woodhouse, is described in the opening paragraph as \'\'handsome, clever, and rich\'\' but is also rather spoiled. As a result of the recent marriage of her former governess, Emma prides herself on her ability to matchmake, and proceeds to take under her wing an illegitimate orphan, Harriet Smith, whom she hopes to marry off to the vicar, Mr Elton. So confident is she that she persuades Harriet to reject a proposal from a young farmer who is a much more suitable partner for the girl.', '2022-11-23 10:23:28', '2022-11-24 05:54:59'),
(182, 1, 'Jane-Eyre', 'Charlotte Brontë', '1847', 'Romance', 497, '182.jpg', 'A poor governess, Jane Eyre, captures the heart of her enigmatic employer, Edward Rochester. Jane discovers that he has a secret that could jeopardize any hope of happiness between them.', '2022-11-23 10:24:24', '2022-11-24 05:55:45'),
(183, 1, 'The Demon Girl', 'Penelope Fletcher', '2010', 'Romance', 208, '183.jpg', 'Rae Wilder has problems. Plunged into a world of dark magic, fierce creatures and ritual sacrifice, she is charged with a guarding a magical amulet. Rae finds herself beaten up, repeatedly, and forced to make a choice: to live and die human, or embrace her birth-right and wield magics that could turn her into something wicked, a force of nature nothing can control.', '2022-11-23 10:25:17', '2022-11-24 05:56:17'),
(184, 1, 'Pride and Prejudice', 'Jane Austen', '1813', 'Romance', 311, '184.jpg', 'Austen\'s finest comedy of manners portrays life in the genteel rural society of the early 1800s, and tells of the initial misunderstandings (and mutual enlightenment) between lively and quick witted Elizabeth Bennet and the haughty Mr. Darcy.', '2022-11-23 10:25:59', '2022-11-24 05:56:50'),
(185, 1, 'Persuasion', 'Jane Austen', '1818', 'Romance', 150, '185.jpg', 'Eight years ago, Anne Elliot fell in love with poor but ambitious naval officer Captain Frederick Wentworth -- a choice which Anne\'s family was dissatisfied with. Lady Russell, friend and mentor to Anne, persuaded the younger woman to break off the match; now, on the verge of spinsterhood, Anne re-encounters Frederick Wentworth as he courts her spirited young neighbour, Louisa Musgrove. (Published posthumously.)', '2022-11-23 10:26:31', '2022-11-24 05:57:20'),
(186, 1, 'The Lost World', 'Arthur Conan Doyle', '1912', 'Fantasy', 198, '186.jpg', 'Follow Professor Challenger on his expedition to the Tepuyes plateau in South America where prehistoric animals and other extinct creatures still roam -- side by side with prehistoric men and vicious ape-like creatures!', '2022-11-24 06:33:20', '2022-11-24 06:33:20'),
(187, 1, 'Tarzan of the Apes', 'Edgar Rice Burroughs', '1912', 'Fantasy', 270, '187.jpg', 'The novel is the coming-of-age story of John Clayton, born in the western coastal jungles of equatorial Africa to a marooned couple from England, John and Alice Clayton, Lord and Lady Greystoke. Adopted as an infant by the she-ape Kala after his parents are killed by the savage king ape Kerchak, Clayton is renamed Tarzan (\'\'White Skin\'\' in the ape language) and raised in ignorance of his human heritage.', '2022-11-24 06:34:19', '2022-11-24 06:34:19'),
(188, 1, 'She', 'Edgar Rice Burroughs', '1912', 'Fantasy', 270, '188.jpg', 'The novel is the coming-of-age story of John Clayton, born in the western coastal jungles of equatorial Africa to a marooned couple from England, John and Alice Clayton, Lord and Lady Greystoke. Adopted as an infant by the she-ape Kala after his parents are killed by the savage king ape Kerchak, Clayton is renamed Tarzan (\'\'White Skin\'\' in the ape language) and raised in ignorance of his human heritage.', '2022-11-24 06:35:00', '2022-11-24 06:35:00'),
(189, 1, 'The Wonderful Wizard of Oz', 'Lyman Frank Baum', '1901', 'Fantasy', 122, '189.jpg', 'To quote a reader, \'\'If all you know of Oz comes from the movie musical then you owe it to yourself to read the book that inspired Hollywood.\'\' Learn about Dorothy and her friends in the first of thirteen volumes by L. Frank Baum.', '2022-11-24 06:35:56', '2022-11-24 06:35:56'),
(191, 1, 'Grimms\'-Fairy-Tales', 'Wilhelm Grimm', 'Unknown', 'Fantasy', 238, '191.jpg', 'Based on translations of Kinder und Hausmarchen by Edgar Taylor and Marian Edwardes.', '2022-11-24 06:44:56', '2022-11-24 06:44:56'),
(192, 1, 'The Art of War', 'Zi Sun', 'Unknown', 'Historical', 150, '192.jpg', 'The Art of War is an ancient Chinese military treatise dating from the Late Spring and Autumn Period. The work, which is attributed to the ancient Chinese military strategist Sun Tzu (\"Master Sun\"), is composed of 13 chapters. Each one is devoted to a different set of skills or art related to warfare and how it applies to military strategy and tactics. For almost 1,500 years it was the lead text in an anthology that was formalized as the Seven Military Classics by Emperor Shenzong of Song in 1080. The Art of War remains the most influential strategy text in East Asian warfare and has influenced both Far Eastern and Western military thinking, business tactics, legal strategy, politics, sports, lifestyles and beyond.', '2022-11-24 06:46:49', '2022-11-24 06:46:49'),
(193, 1, 'A Tale of Two Cities', 'Charles Dickens', '1859', 'Historical', 355, '193.jpg', 'Sidney Carton is almost the only case in which Dickens has drawn a hero on the true heroic scale, and his famous act of self-sacrifice is unmatched in fiction. The book must be ranked very high among the great tragedies in literature.', '2022-11-24 06:48:07', '2022-11-24 06:48:07'),
(194, 1, 'Across Asia on a Bicycle', 'Thomas Gaskell Allen', '1894', 'Historical', 170, '194.jpg', 'Beginning in June, 1890, two young American students made a bicycle journey around the world--so far as they could on land--and were back in New York, whence they had sailed for Liverpool to begin their wheeling in just under three years. They regard their journey through Western China and the Desert of Gobi as the most interesting and most dangerous parts of their travels.', '2022-11-24 06:49:08', '2022-11-24 06:49:08'),
(195, 1, 'All Things Are Lights', 'Robert J. Shea', '1986', 'Historical', 617, '195.jpg', 'In the war-torn world of Louis IX\'s failed crusades, amidst the secret society called the \"Knights Templar,\" a young warrior comes of age.', '2022-11-24 06:49:56', '2022-11-24 06:49:56'),
(196, 1, 'Early Britain', 'Grant Allen', '1881', 'Historical', 167, '196.jpg', 'This little book is an attempt to give a brief sketch of Britain under the early English conquerors, rather from the social than from the political point of view. For that purpose not much has been said about the doings of kings and statesmen; but attention has been mainly directed towards the less obvious evidence afforded us by existing monuments as to the life and mode of thought of the people themselves.', '2022-11-24 06:50:45', '2022-11-24 06:50:45'),
(197, 1, 'All For Love', 'Bram Stoker', '2017', 'Romance', 123, '197.jpg', 'The world\'s best-known vampire story begins by following a naive young Englishman as he visits Transylvania to meet a client, the mysterious Count Dracula. Upon revealing his true nature, Dracula boards a ship for England, where chilling and gruesome disasters begin to befall the people of London...', '2022-11-24 08:56:19', '2022-11-24 08:57:21'),
(198, 1, 'American Indian stories 1', 'Zitkala-Sa 11', '1921', 'Historical', 1121, '198.jpg', '1A unique combination of autobiography and fiction which represents an attempt to merge cultural critique with aesthetic form, especially surrounding such fundamental matters as religion.', '2022-12-01 09:19:07', '2022-12-01 09:20:25'),
(199, 1, 'Tales of the Alhambra', 'Washington Irving', '1851', 'Historical', 286, '199.jpg', 'Rough draughts of some of the following tales and essays were actually written during a residence in the Alhambra; others were subsequently added, founded on notes and observations made there. Care was taken to maintain local coloring and verisimilitude; so that the whole might present a faithful and living picture of that microcosm, that singular little world into which I had been fortuitously thrown; and about which the external world had a very imperfect idea. It was my endeavor scrupulously to depict its half Spanish, half Oriental character; its mixture of the heroic, the poetic, and the grotesque; to revive the traces of grace and beauty fast fading from its walls; to record the regal and chivalrous traditions concerning those who once trod its courts; and the whimsical and superstitious legends of the motley race now burrowing among its ruins.', '2022-12-01 11:07:41', '2022-12-01 11:07:41'),
(200, 1, 'Anting-Anting Stories', 'Sargent Kayme', '2008', 'Historical', 127, '200.jpg', 'Pirates, half naked natives, pearls, man-apes, towering volcanoes about whose summits clouds and unearthly traditions float together, strange animals and birds, and stranger men, pythons, bejuco ropes stained with human blood, feathering palm trees now fanned by soft breezes and now crushed to the ground by tornadoes;—on no mimic stage was ever a more [VI]wonderful scene set for such a company of actors. That the truly remarkable stories written by Sargent Kayme do not exaggerate the realities of this strange life can be easily seen by any one who has read the letters from press correspondents, our soldiers, or the more formal books of travel.', '2022-12-01 11:33:17', '2022-12-01 11:33:17'),
(201, 1, 'Transformational leadership, employee self-efficacy, employee innovativeness, customer-centricity, and organizational competitiveness among insurance firms', 'Faisal Iddris & Courage Simon Kofi Dogbe & Emmanuel Mensah Kparl', '2022', 'High Quality Material', 20, 'N/A', 'This study aims to assess how employee innovativeness, employee self-efficacy and customercentricity intervene in the relationship between transformational leadership and organizational competitiveness of insurance firms.', '2022-12-02 10:08:05', '2022-12-02 10:08:05'),
(202, 1, 'An investigation of celebrity brand hate influence in the arts marketing sector of Ghana', 'Iddrisu Mohammed & Alexander Preko & Leeford Edem Kojo Ameyibor & Mawuli Feglo & George Cudjoe Agbemabiese', '2022', 'High Quality Material', 16, 'N/A', 'This study aimed at investigating negative past experience (NPE), symbolic incongruity and ideological incompatibility on celebrity brand hate (CBH) within the arts marketing sector.', '2022-12-02 10:09:04', '2022-12-02 10:09:04'),
(203, 1, 'Firm characteristics and forward-looking disclosure: the moderating role of gender diversity', 'Samir Ibrahim Abdelazim & Abdelmoneim Bahyeldin Mohamed Metwally & Saleh Aly Saleh Aly', '2022', 'High Quality Material', 27, 'N/A', 'The purpose of this study is to examine the impact of firm financial and operational characteristics on the level of forward-looking information disclosure (FLID) by Egyptian-listed non-financial companies. The present research also aims to investigate the moderating role of gender diversity on the board of directors.', '2022-12-02 10:09:47', '2022-12-02 10:09:47'),
(207, 1, 'The composition of data economy: a bibliometric approach and TCCM framework of conceptual, intellectual and social structure', 'Sunday Adewale Olaleye & Emmanuel Mogaji & Friday Joseph Agbo & Dandison Ukpabi & Akwasi Gyamerah', '2022', 'High Quality Material', 18, 'N/A', 'The data economy mainly relies on the surveillance capitalism business model, enabling companies to monetize their data. The surveillance allows for transforming private human experiences into behavioral data that can be harnessed in the marketing sphere. This study aims to focus on investigating the domain of data economy with the methodological lens of quantitative bibliometric analysis of published literature.', '2022-12-02 10:52:19', '2022-12-02 10:52:19'),
(208, 1, 'Adapting and validating global knowledge branding scales in the education services sector', 'Achutha Jois & Somnath Chakrabarti', '2022', 'High Quality Material', 39, 'N/A', 'The education services sector faces ever-changing global market dynamics with creative disruptions. Building knowledge brands can push the higher education sector beyond its geographical boundaries into the global arena. This study aims to identify key constructs, their theoretical background and dimensions that aid in building a global knowledge brand. The authors’ research focuses on adapting and validating scales for global knowledge and education services brands from well-established academic literature.', '2022-12-02 11:01:46', '2022-12-02 11:01:46'),
(209, 1, 'Gulliver\'s-Travels', 'Jonathan Swift', '1726', 'Fantasy', 254, '209.jpg', 'A satire on human nature and a parody of the ', '2022-12-02 11:04:34', '2022-12-02 11:14:31'),
(210, 1, 'At the Earth\'s Core', 'Edgar Rice Burroughs', '1914', 'Fantasy', 131, '210.jpg', '\"Edgar Rice Burroughs\' inner world evokes fantastic images of a world without time and a landscape like no other. He was not the first to utilize a hollow earth to tell a a story, but his is the best and most completely realized of all the inner world tales.\"--erblist.com', '2022-12-02 11:05:27', '2022-12-02 11:16:23'),
(211, 1, 'Worlds-Unseen', 'Rachel Starr Thomson', '2010', 'Fantasy', 251, '211.jpg', 'Maggie Sheffield\'s life has been haunted by seemingly disconnected tragedies, pieces that form a puzzle she doesn\'t understand. Her confusion about the past mirrors that of her whole world: they\'ve been taught that the empire saved them from destruction, but then why does the empire seem bent on enslaving its own people? They\'ve been taught that stories of an ancient war, a terrifying enemy, and a majestic king are all myths--but then why are those who try to learn more about them sabotaged or killed?When a dying friend shows up at Maggie\'s island home bearing proof that the ', '2022-12-02 11:06:35', '2022-12-02 11:30:08'),
(212, 1, 'Whill of Agora: Book 1', 'Michael Ploof', '2014', 'Fantasy', 302, '212.jpg', 'Every so often, an epic adventure emerges that makes the blood surge, the spine tingle, and the heart smile page after exhilarating page. Such is Whill of Agora, Michael James Ploof’s action-packed fantasy that visits strange new lands as it unveils how one exceptional young man named Whill makes full use of fierce wits, superior skills, and relentless will to help defend the land of Agora from the monstrous Draggard. With plenty of drama and action packed battle scenes, Whill of Agora will enthrall anyone on the quest for great adventure, good times, and an infectiously optimistic outlook on even the darkest and most dangerous of days.', '2022-12-02 11:07:21', '2022-12-02 11:30:54'),
(213, 1, 'The Unveiling', 'Tamara Leigh', '2013', 'Romance', 252, '213.jpg', '12th century England: Two men vie for the throne: King Stephen the usurper and young Duke Henry the rightful heir. Amid civil and private wars, alliances are forged, loyalties are betrayed, families are divided, and marriages are made. For four years, Lady Annyn Bretanne has trained at arms with one end in mind—to avenge her brother’s murder as God has not deemed it worthy to do. Disguised as a squire, she sets off to exact revenge on a man known only by his surname, Wulfrith. But when she holds his fate in her hands, her will wavers and her heart whispers that her enemy may not be an enemy after all.', '2022-12-02 11:08:46', '2022-12-02 11:31:44'),
(214, 1, 'This Side of Paradise', 'F. Scott Fitzgerald', '1920', 'Romance', 234, '214.jpg', 'Wealthy and attractive Princeton student Amory Blaine dabbles in literature and romance, and becomes disillusioned by the greed and social climbing of post-World War I American youth.', '2022-12-02 11:10:11', '2022-12-02 11:32:20'),
(215, 1, 'Cleopatra', 'H. Rider Haggard', '1889', 'Romance', 247, '215.jpg', 'Set in the Ptolemaic era the story revolves around the survival of a dynastic bloodline protected by the Priesthood of Isis. Harmachis, the last living descendent of this bloodline, is charged by the Priesthood with the overthrow of Cleopatra, the ejection of the Romans, and the restoration of Egypt to it\'s golden age.', '2022-12-02 11:11:30', '2022-12-02 11:11:30'),
(216, 1, 'Joan of Arc', 'Lucy Foster Madison', '1918', 'Historical', 282, '216.jpg', 'In presenting this story for the young the writer has endeavored to give a vivid and accurate life of Jeanne D’Arc (Joan of Arc) as simply told as possible. There has been no pretence toward keeping to the speech of the Fifteenth Century, which is too archaic to be rendered literally for young readers, although for the most part the words of the Maid have been given verbatim.', '2022-12-02 11:34:28', '2022-12-02 11:34:28'),
(217, 1, 'The Scarlet Letter', 'Nathaniel Hawthorne', '1850', 'Historical', 216, '217.jpg', 'By common consent the greatest novel that has been written this side of the Atlantic. It is, as were all Hawthorne\'s works, a study of the soul of man. There is little incident. What takes place is mostly upon the arena of the heart.', '2022-12-03 12:17:21', '2022-12-03 12:17:21');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_ID` int(6) NOT NULL,
  `student_ID` varchar(11) NOT NULL,
  `stripe_subscription_ID` varchar(50) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `payment_datetime` datetime NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_ID`, `student_ID`, `stripe_subscription_ID`, `amount`, `payment_datetime`, `status`) VALUES
(35, 'SCPG1800369', 'sub_1M7SBFEYRt4577ibQ8mP5Byn', 10.00, '2022-11-24 07:16:37', 'Suceed'),
(36, 'SCPG1800366', 'sub_1M7SVBEYRt4577ib0nUUfwQI', 10.00, '2022-11-24 07:37:14', 'Suceed'),
(37, 'SCPG1800367', 'sub_1M9KPyEYRt4577ibagsGFlm2', 10.00, '2022-11-29 11:23:34', 'Suceed'),
(39, 'SCPG1800368', 'sub_1MA2yUEYRt4577ibvmQAOMGY', 10.00, '2022-12-01 10:58:11', 'Suceed'),
(40, 'SCPG1800368', 'sub_1MA2yYEYRt4577ibRAhgs3qu', 10.00, '2022-12-01 10:58:15', 'Suceed'),
(41, 'SCPG1800370', 'sub_1MBJVSEYRt4577ibuLfcKSNl', 10.00, '2022-12-04 10:49:28', 'Suceed');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_ID` int(11) NOT NULL,
  `student_ID` varchar(11) NOT NULL,
  `material_ID` int(6) NOT NULL,
  `score` int(1) NOT NULL,
  `comment` varchar(600) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_ID`, `student_ID`, `material_ID`, `score`, `comment`, `created_datetime`, `updated_datetime`) VALUES
(67, 'SCPG1800369', 195, 4, 'Too advancess\'', '2022-11-24 12:39:41', '2022-11-24 12:39:41'),
(68, 'SCPG1800369', 181, 1, 'It\'s really interesting', '2022-11-30 02:50:42', '2022-11-30 02:50:42'),
(69, 'SCPG1800369', 198, 5, 'True story happened', '2022-12-01 01:25:40', '2022-12-01 01:25:40'),
(70, 'SCPG1800368', 198, 4, 'Love it', '2022-12-01 02:42:44', '2022-12-01 02:42:44'),
(71, 'SCPG1800368', 197, 5, 'Good story', '2022-12-01 03:01:54', '2022-12-01 03:01:54'),
(72, 'SCPG1800368', 199, 5, 'I love it', '2022-12-01 03:16:54', '2022-12-01 03:16:54'),
(73, 'SCPG1800369', 217, 3, 'The content is too much for me.', '2022-12-04 05:12:01', '2022-12-04 05:12:01'),
(74, 'SCPG1800371', 215, 5, 'This story is a bit mystery.', '2022-12-04 03:14:35', '2022-12-04 03:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_ID` varchar(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `course_name` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `subscription` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_ID`, `student_name`, `email`, `course_name`, `password`, `subscription`, `status`, `created_datetime`, `updated_datetime`) VALUES
('SCPG1800366', 'Adrian Tang', 'scpg1800366@segi4u.my', 'BSC', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'Premium', 'Frozen', '2022-10-01 14:02:03', '2022-12-04 09:25:03'),
('SCPG1800367', 'Simon Teoh', 'scpg1800367@segi4u.my', 'BSC', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'Premium', 'Active', '2022-10-01 14:02:26', '2022-11-29 11:23:34'),
('SCPG1800368', 'Jeremy', 'scpg1800368@segi4u.my', 'BSC', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-10-01 14:02:32', '2022-12-01 12:05:11'),
('SCPG1800369', 'Tan Khye Shen', 'scpg1800369@segi4u.my', 'BSC', '$2y$10$nFxfZCy2Rlpu8H0AaEezyuYEQ.whqJu/o9iBIQrVxcrL8VDUnpKJ2', 'Premium', 'Active', '2022-10-01 14:02:37', '2022-12-05 09:31:00'),
('SCPG1800370', 'Gratia Winterson', 'scpg1800370@segi4u.my', 'BSC', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'Premium', 'Active', '2022-01-23 10:27:42', '2022-12-04 10:49:28'),
('SCPG1800371', 'Jaime Falco', 'scpg1800371@segi4u.my', 'BEE', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800372', 'Florrie Chilley', 'scpgelibraryuser@gmail.com', 'BEE', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800373', 'Larine Paver', 'scpg1800373@segi4u.my', 'BEE', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800374', 'Padraig Troman', 'scpg1800374@segi4u.my', 'BEE', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800375', 'Florance McGrotty', 'scpg1800375@segi4u.my', 'BSE', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800376', 'Maddie Rowet', 'scpg1800376@segi4u.my', 'BME', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800377', 'Heidi McDaid', 'scpg1800377@segi4u.my', 'BME', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800378', 'Philis Liddiard', 'scpg1800378@segi4u.my', 'BME', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800379', 'Dorian McNeillie', 'scpg1800379@segi4u.my', 'BME', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800380', 'Farlie Hardey', 'scpg1800380@segi4u.my', 'BME', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800381', 'Milli Ebbin', 'scpg1800381@segi4u.my', 'BAMM', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800382', 'Heidi McDaid', 'scpg1800382@segi4u.my', 'BAMM', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800383', 'Philis Liddiard', 'scpg1800383@segi4u.my', 'BAMM', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800384', 'Dorian McNeillie', 'scpg1800384@segi4u.my', 'BAMM', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42'),
('SCPG1800385', 'Farlie Hardey', 'scpg1800385@segi4u.my', 'BAMM', '$1$4dCB3kYi$mFuVd9a8sMXdYp5b2AzrV/', 'None', 'Active', '2022-01-23 10:27:42', '2022-01-23 10:27:42');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `stripe_subscription_ID` varchar(50) NOT NULL,
  `student_ID` varchar(11) NOT NULL,
  `monthly_price` float(10,2) NOT NULL,
  `billing_email` varchar(320) NOT NULL,
  `plan_start` date NOT NULL,
  `plan_end` date NOT NULL,
  `status` varchar(7) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`stripe_subscription_ID`, `student_ID`, `monthly_price`, `billing_email`, `plan_start`, `plan_end`, `status`, `created_datetime`, `updated_datetime`) VALUES
('sub_1M7SBFEYRt4577ibQ8mP5Byn', 'SCPG1800369', 10.00, 'khye143914@gmail.com', '2022-11-23', '2022-12-23', 'active', '2022-11-24 07:16:37', '2022-11-29 11:20:27'),
('sub_1M7SVBEYRt4577ib0nUUfwQI', 'SCPG1800366', 10.00, 'khye143914@gmail.com', '2022-11-23', '2022-12-23', 'active', '2022-11-24 07:37:14', '2022-11-24 07:37:14'),
('sub_1M9KPyEYRt4577ibagsGFlm2', 'SCPG1800367', 10.00, 'khye143914@gmail.com', '2022-11-29', '2022-12-29', 'active', '2022-11-29 11:23:34', '2022-11-29 11:23:34'),
('sub_1MA2yUEYRt4577ibvmQAOMGY', 'SCPG1800368', 10.00, 'khye143914@gmail.com', '2022-12-01', '2023-01-01', 'active', '2022-12-01 10:58:11', '2022-12-01 12:05:11'),
('sub_1MA2yYEYRt4577ibRAhgs3qu', 'SCPG1800368', 10.00, 'khye143914@gmail.com', '2022-12-01', '2023-01-01', 'active', '2022-12-01 10:58:15', '2022-12-01 12:05:11'),
('sub_1MBJVSEYRt4577ibuLfcKSNl', 'SCPG1800370', 10.00, 'khye143914@gmail.com', '2022-12-04', '2023-01-04', 'last', '2022-12-04 10:49:28', '2022-12-04 10:57:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`download_ID`),
  ADD KEY `material_ID` (`material_ID`,`student_ID`),
  ADD KEY `student_ID` (`student_ID`);

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
  ADD PRIMARY KEY (`librarian_ID`),
  ADD KEY `admin_ID` (`admin_ID`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_ID`),
  ADD KEY `librarian_ID` (`librarian_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_ID`),
  ADD KEY `student_ID` (`student_ID`,`stripe_subscription_ID`),
  ADD KEY `stripe_subscription_ID` (`stripe_subscription_ID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_ID`),
  ADD KEY `student_ID` (`student_ID`,`material_ID`),
  ADD KEY `material_ID` (`material_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_ID`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`stripe_subscription_ID`),
  ADD KEY `student_ID` (`student_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `download`
--
ALTER TABLE `download`
  MODIFY `download_ID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `librarian`
--
ALTER TABLE `librarian`
  MODIFY `librarian_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `download`
--
ALTER TABLE `download`
  ADD CONSTRAINT `download_ibfk_1` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_ID`),
  ADD CONSTRAINT `download_ibfk_2` FOREIGN KEY (`material_ID`) REFERENCES `material` (`material_ID`);

--
-- Constraints for table `librarian`
--
ALTER TABLE `librarian`
  ADD CONSTRAINT `librarian_ibfk_1` FOREIGN KEY (`admin_ID`) REFERENCES `admin` (`admin_ID`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`librarian_ID`) REFERENCES `librarian` (`librarian_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_ID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`stripe_subscription_ID`) REFERENCES `subscription` (`stripe_subscription_ID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_ID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`material_ID`) REFERENCES `material` (`material_ID`);

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
