-- phpMyAdmin SQL Dump
-- version 5.0.0-dev
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2019 at 06:47 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ideal11`
--

-- --------------------------------------------------------

--
-- Table structure for table `lineups`
--

CREATE TABLE `lineups` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL DEFAULT '-1',
  `team` int(11) NOT NULL,
  `style` int(11) NOT NULL,
  `code` text NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_modification_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lineups`
--

INSERT INTO `lineups` (`id`, `author`, `team`, `style`, `code`, `likes`, `dislikes`, `creation_date`, `last_modification_date`) VALUES
(1, 0, 4, 1, '[{\"id\":0,\"player\":\"Ter Stegen\",\"w\":\"126px\",\"h\":\"392px\"},{\"id\":1,\"player\":\"Semedo\",\"w\":\"246px\",\"h\":\"306px\"},{\"id\":2,\"player\":\"Jordi Alba\",\"w\":\"13px\",\"h\":\"304px\"},{\"id\":3,\"player\":\"PiquÃ©\",\"w\":\"175px\",\"h\":\"321px\"},{\"id\":4,\"player\":\"Lenglet\",\"w\":\"93px\",\"h\":\"320px\"},{\"id\":5,\"player\":\"Busquets\",\"w\":\"135px\",\"h\":\"237px\"},{\"id\":6,\"player\":\"Arthur\",\"w\":\"82px\",\"h\":\"163px\"},{\"id\":7,\"player\":\"Rakitic\",\"w\":\"190px\",\"h\":\"164px\"},{\"id\":8,\"player\":\"DembelÃ©\",\"w\":\"26px\",\"h\":\"49px\"},{\"id\":9,\"player\":\"Leo Messi\",\"w\":\"234px\",\"h\":\"47px\"},{\"id\":10,\"player\":\"Luis SuÃ¡rez\",\"w\":\"130px\",\"h\":\"25px\"}]', 0, 0, '2019-01-30 18:27:46', '0000-00-00 00:00:00'),
(2, 0, 2, 2, '[{\"id\":0,\"player\":\"Oblak\",\"w\":\"127px\",\"h\":\"397px\"},{\"id\":1,\"player\":\"Juanfran\",\"w\":\"243px\",\"h\":\"310px\"},{\"id\":2,\"player\":\"GodÃ­n\",\"w\":\"179px\",\"h\":\"330px\"},{\"id\":3,\"player\":\"Savic\",\"w\":\"94px\",\"h\":\"329px\"},{\"id\":4,\"player\":\"Filipe Luis\",\"w\":\"16px\",\"h\":\"306px\"},{\"id\":5,\"player\":\"Koke\",\"w\":\"240px\",\"h\":\"165px\"},{\"id\":6,\"player\":\"Vitolo\",\"w\":\"6px\",\"h\":\"167px\"},{\"id\":7,\"player\":\"Thomas\",\"w\":\"97px\",\"h\":\"219px\"},{\"id\":8,\"player\":\"Rodri\",\"w\":\"170px\",\"h\":\"215px\"},{\"id\":9,\"player\":\"Griezzmann\",\"w\":\"102px\",\"h\":\"69px\"},{\"id\":10,\"player\":\"Morata\",\"w\":\"172px\",\"h\":\"24px\"}]', 0, 0, '2019-01-30 18:30:06', '0000-00-00 00:00:00'),
(3, 0, 50, 1, '[{\"id\":0,\"player\":\"SzczÄ™sny\",\"w\":\"136px\",\"h\":\"382px\"},{\"id\":1,\"player\":\"De Sciglio\",\"w\":\"237px\",\"h\":\"288px\"},{\"id\":2,\"player\":\"Bonucci\",\"w\":\"169px\",\"h\":\"311px\"},{\"id\":3,\"player\":\"Rugani\",\"w\":\"93px\",\"h\":\"315px\"},{\"id\":4,\"player\":\"Alex Sandro\",\"w\":\"18px\",\"h\":\"283px\"},{\"id\":5,\"player\":\"Betancur\",\"w\":\"134px\",\"h\":\"234px\"},{\"id\":6,\"player\":\"Matuidi\",\"w\":\"55px\",\"h\":\"192px\"},{\"id\":7,\"player\":\"Emre Can\",\"w\":\"205px\",\"h\":\"184px\"},{\"id\":8,\"player\":\"Dybala\",\"w\":\"130px\",\"h\":\"23px\"},{\"id\":9,\"player\":\"Ronaldo\",\"w\":\"30px\",\"h\":\"81px\"},{\"id\":10,\"player\":\"Douglas Costa\",\"w\":\"231px\",\"h\":\"76px\"}]', 0, 0, '2019-01-30 18:32:50', '0000-00-00 00:00:00'),
(4, 0, 6, 1, '[{\"id\":0,\"player\":\"Courtois\",\"w\":\"130px\",\"h\":\"387px\"},{\"id\":1,\"player\":\"Carvajal\",\"w\":\"242px\",\"h\":\"293px\"},{\"id\":2,\"player\":\"Marcelo\",\"w\":\"14px\",\"h\":\"292px\"},{\"id\":3,\"player\":\"Ramos\",\"w\":\"182px\",\"h\":\"314px\"},{\"id\":4,\"player\":\"Varane\",\"w\":\"88px\",\"h\":\"313px\"},{\"id\":5,\"player\":\"Casemiro\",\"w\":\"132px\",\"h\":\"236px\"},{\"id\":6,\"player\":\"Kroos\",\"w\":\"68px\",\"h\":\"175px\"},{\"id\":7,\"player\":\"Modric\",\"w\":\"187px\",\"h\":\"170px\"},{\"id\":8,\"player\":\"Vinicius\",\"w\":\"28px\",\"h\":\"66px\"},{\"id\":9,\"player\":\"BenzemÃ¡\",\"w\":\"129px\",\"h\":\"20px\"},{\"id\":10,\"player\":\"Bale\",\"w\":\"235px\",\"h\":\"68px\"}]', 0, 0, '2019-01-30 18:34:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE `styles` (
  `id` int(11) NOT NULL,
  `title` varchar(8) NOT NULL,
  `code` text NOT NULL,
  `numLineUps` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `title`, `code`, `numLineUps`) VALUES
(1, '4-3-3', '[{\"id\":0,\"w\":\"105px\",\"h\":\"30px\"}, {\"id\":1,\"w\":\"189px\",\"h\":\"30px\"},{\"id\":2,\"w\":\"20px\",\"h\":\"30px\"},{\"id\":3,\"w\":\"105px\",\"h\":\"178px\"},{\"id\":4,\"w\":\"186px\",\"h\":\"140px\"},{\"id\":5,\"w\":\"20px\",\"h\":\"140px\"},{\"id\":6,\"w\":\"143px\",\"h\":\"260px\"},{\"id\":7,\"w\":\"64px\",\"h\":\"260px\"},{\"id\":8,\"w\":\"8px\",\"h\":\"260px\"},{\"id\":8,\"w\":\"202px\",\"h\":\"260px\"},{\"id\":10,\"w\":\"105px\",\"h\":\"330px\"}]', 0),
(2, '4-4-2', '[{\"id\":0,\"w\":\"105px\",\"h\":\"30px\"}, {\"id\":1,\"w\":\"189px\",\"h\":\"30px\"},{\"id\":2,\"w\":\"20px\",\"h\":\"30px\"},{\"id\":3,\"w\":\"105px\",\"h\":\"178px\"},{\"id\":4,\"w\":\"186px\",\"h\":\"140px\"},{\"id\":5,\"w\":\"20px\",\"h\":\"140px\"},{\"id\":6,\"w\":\"143px\",\"h\":\"260px\"},{\"id\":7,\"w\":\"64px\",\"h\":\"260px\"},{\"id\":8,\"w\":\"8px\",\"h\":\"260px\"},{\"id\":8,\"w\":\"202px\",\"h\":\"260px\"},{\"id\":10,\"w\":\"155px\",\"h\":\"330px\"}]', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  `logo` varchar(2083) NOT NULL,
  `shirt` varchar(2083) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `code`, `name`, `country_code`, `logo`, `shirt`) VALUES
(1, 'ATH', 'Athletic Club', 'es', 'http://upload.wikimedia.org/wikipedia/de/7/7f/Athletic_Club_Bilbao.svg', 'resources/images/kits/1.png'),
(2, 'ATM', 'Club AtlÃ©tico de Madrid', 'es', 'http://upload.wikimedia.org/wikipedia/de/c/c1/Atletico_Madrid_logo.svg', 'resources/images/kits/2.png'),
(3, 'ESP', 'RCD Espanyol de Barcelona', 'es', 'http://upload.wikimedia.org/wikipedia/de/a/a7/RCD_Espanyol_De_Barcelona.svg', 'resources/images/kits/3.png'),
(4, 'FCB', 'FC Barcelona', 'es', 'http://upload.wikimedia.org/wikipedia/de/a/aa/Fc_barcelona.svg', 'resources/images/kits/4.png'),
(5, 'GET', 'Getafe CF', 'es', 'https://upload.wikimedia.org/wikipedia/en/7/7f/Getafe_logo.png', 'resources/images/kits/5.png'),
(6, 'RMA', 'Real Madrid CF', 'es', 'http://upload.wikimedia.org/wikipedia/de/3/3f/Real_Madrid_Logo.svg', 'resources/images/kits/6.png'),
(7, 'RAY', 'Rayo Vallecano de Madrid', 'es', 'http://upload.wikimedia.org/wikipedia/de/1/12/Rayo_vallecano_madrid.svg', 'resources/images/kits/7.png'),
(8, 'LEV', 'Levante UD', 'es', 'http://upload.wikimedia.org/wikipedia/de/1/1f/Levante_ud.svg', 'resources/images/kits/8.png'),
(9, 'BET', 'Real Betis BalompiÃ©', 'es', 'http://upload.wikimedia.org/wikipedia/de/4/43/Real_Betis.svg', 'resources/images/kits/9.png'),
(10, 'RSO', 'Real Sociedad de FÃºtbol', 'es', 'http://upload.wikimedia.org/wikipedia/de/5/55/Real_Sociedad_San_Sebasti%C3%A1n.svg', 'resources/images/kits/10.png'),
(11, 'VIL', 'Villarreal CF', 'es', 'http://upload.wikimedia.org/wikipedia/de/7/70/Villarreal_CF_logo.svg', 'resources/images/kits/11.png'),
(12, 'VAL', 'Valencia CF', 'es', 'http://upload.wikimedia.org/wikipedia/de/7/75/FC_Valencia.svg', 'resources/images/kits/12.png'),
(13, 'VLD', 'Real Valladolid CF', 'es', 'http://upload.wikimedia.org/wikipedia/de/6/6e/Real_Valladolid_Logo.svg', 'resources/images/kits/13.png'),
(14, 'ALA', 'Deportivo AlavÃ©s', 'es', 'http://upload.wikimedia.org/wikipedia/en/2/2e/Deportivo_Alaves_logo.svg', 'resources/images/kits/14.png'),
(15, 'EIB', 'SD Eibar', 'es', 'http://upload.wikimedia.org/wikipedia/en/7/75/SD_Eibar_logo.svg', 'resources/images/kits/15.png'),
(16, 'GIR', 'Girona FC', 'es', 'http://upload.wikimedia.org/wikipedia/en/9/90/For_article_Girona_FC.svg', 'resources/images/kits/16.png'),
(17, 'HUE', 'SD Huesca', 'es', 'https://upload.wikimedia.org/wikipedia/en/1/11/Sd_huesca.png', 'resources/images/kits/17.png'),
(18, 'CEL', 'RC Celta de Vigo', 'es', 'http://upload.wikimedia.org/wikipedia/de/0/0c/Celta_Vigo.svg', 'resources/images/kits/18.png'),
(19, 'SEV', 'Sevilla FC', 'es', 'http://upload.wikimedia.org/wikipedia/en/8/86/Sevilla_cf_200px.png', 'resources/images/kits/19.png'),
(20, 'LEG', 'CD LeganÃ©s', 'es', 'http://upload.wikimedia.org/wikipedia/en/thumb/0/02/Club_Deportivo_Legan%C3%A9s.png/180px-Club_Deportivo_Legan%C3%A9s.png', 'resources/images/kits/20.png'),
(21, 'ARS', 'Arsenal FC', 'en', 'http://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg', 'resources/images/kits/21.png'),
(22, 'CFC', 'Chelsea FC', 'en', 'http://upload.wikimedia.org/wikipedia/de/5/5c/Chelsea_crest.svg', 'resources/images/kits/22.png'),
(23, 'EVE', 'Everton FC', 'en', 'http://upload.wikimedia.org/wikipedia/de/f/f9/Everton_FC.svg', 'resources/images/kits/23.png'),
(24, 'FUL', 'Fulham FC', 'en', 'http://upload.wikimedia.org/wikipedia/de/a/a8/Fulham_fc.svg', 'resources/images/kits/24.png'),
(25, 'LIV', 'Liverpool FC', 'en', 'http://upload.wikimedia.org/wikipedia/de/0/0a/FC_Liverpool.svg', 'resources/images/kits/25.png'),
(26, 'MNC', 'Manchester City FC', 'en', 'https://upload.wikimedia.org/wikipedia/en/e/eb/Manchester_City_FC_badge.svg', 'resources/images/kits/26.png'),
(27, 'MNU', 'Manchester United FC', 'en', 'http://upload.wikimedia.org/wikipedia/de/d/da/Manchester_United_FC.svg', 'resources/images/kits/27.png'),
(28, 'NEW', 'Newcastle United FC', 'en', 'http://upload.wikimedia.org/wikipedia/de/5/56/Newcastle_United_Logo.svg', 'resources/images/kits/28.png'),
(29, 'TOT', 'Tottenham Hotspur FC', 'en', 'http://upload.wikimedia.org/wikipedia/de/b/b4/Tottenham_Hotspur.svg', 'resources/images/kits/29.png'),
(30, 'WOL', 'Wolverhampton Wanderers FC', 'en', 'https://upload.wikimedia.org/wikipedia/en/f/fc/Wolverhampton_Wanderers.svg', 'resources/images/kits/30.png'),
(31, 'BUR', 'Burnley FC', 'en', 'https://upload.wikimedia.org/wikipedia/en/0/02/Burnley_FC_badge.png', 'resources/images/kits/31.png'),
(32, 'LEI', 'Leicester City FC', 'en', 'http://upload.wikimedia.org/wikipedia/en/6/63/Leicester02.png', 'resources/images/kits/32.png'),
(33, 'SOT', 'Southampton FC', 'en', 'http://upload.wikimedia.org/wikipedia/de/c/c9/FC_Southampton.svg', 'resources/images/kits/33.png'),
(34, 'WAT', 'Watford FC', 'en', 'https://upload.wikimedia.org/wikipedia/en/e/e2/Watford.svg', 'resources/images/kits/34.png'),
(35, 'CRY', 'Crystal Palace FC', 'en', 'http://upload.wikimedia.org/wikipedia/de/b/bf/Crystal_Palace_F.C._logo_%282013%29.png', 'resources/images/kits/35.png'),
(36, 'HUD', 'Huddersfield Town AFC', 'en', 'https://upload.wikimedia.org/wikipedia/en/5/5a/Huddersfield_Town_A.F.C._logo.svg', 'resources/images/kits/36.png'),
(37, 'BHA', 'Brighton & Hove Albion FC', 'en', 'https://upload.wikimedia.org/wikipedia/en/f/fd/Brighton_%26_Hove_Albion_logo.svg', 'resources/images/kits/37.png'),
(38, 'WHU', 'West Ham United FC', 'en', 'http://upload.wikimedia.org/wikipedia/de/e/e0/West_Ham_United_FC.svg', 'resources/images/kits/38.png'),
(39, 'CAR', 'Cardiff City FC', 'en', 'https://upload.wikimedia.org/wikipedia/en/3/3c/Cardiff_City_crest.svg', 'resources/images/kits/39.png'),
(40, 'BOR', 'AFC Bournemouth', 'en', 'https://upload.wikimedia.org/wikipedia/de/4/41/Afc_bournemouth.svg', 'resources/images/kits/40.png'),
(41, 'MIL', 'AC Milan', 'it', 'http://upload.wikimedia.org/wikipedia/de/9/9e/AC_Mailand_Logo.svg', 'resources/images/kits/41.png'),
(42, 'FIO', 'ACF Fiorentina', 'it', 'https://upload.wikimedia.org/wikipedia/en/thumb/b/ba/ACF_Fiorentina_2.svg/261px-ACF_Fiorentina_2.svg', 'resources/images/kits/42.png'),
(43, 'ROM', 'AS Roma', 'it', 'http://upload.wikimedia.org/wikipedia/de/3/32/AS_Rom.svg', 'resources/images/kits/43.png'),
(44, 'ATA', 'Atalanta BC', 'it', 'http://upload.wikimedia.org/wikipedia/de/2/28/Atalanta_BC.svg', 'resources/images/kits/44.png'),
(45, 'BOL', 'Bologna FC 1909', 'it', 'http://upload.wikimedia.org/wikipedia/de/9/92/FC_Bologna.svg', 'resources/images/kits/45.png'),
(46, 'CAG', 'Cagliari Calcio', 'it', 'http://upload.wikimedia.org/wikipedia/de/3/3d/Cagliari_Calcio.svg', 'resources/images/kits/46.png'),
(47, 'CHI', 'AC Chievo Verona', 'it', 'http://upload.wikimedia.org/wikipedia/de/3/3f/AC_Chievo_Verona.svg', 'resources/images/kits/47.png'),
(48, 'GEN', 'Genoa CFC', 'it', 'http://upload.wikimedia.org/wikipedia/de/7/76/Genoa_CFC.svg', 'resources/images/kits/48.png'),
(49, 'INT', 'FC Internazionale Milano', 'it', 'https://upload.wikimedia.org/wikipedia/en/thumb/0/0b/Inter_Milan.svg/316px-Inter_Milan.svg', 'resources/images/kits/49.png'),
(50, 'JUV', 'Juventus FC', 'it', 'http://upload.wikimedia.org/wikipedia/de/d/d2/Juventus_Turin.svg', 'resources/images/kits/50.png'),
(51, 'LAZ', 'SS Lazio', 'it', 'http://upload.wikimedia.org/wikipedia/de/thumb/4/47/Lazio_Rom.svg/500px-Lazio_Rom.svg.png', 'resources/images/kits/51.png'),
(52, 'PAR', 'Parma Calcio 1913', 'it', 'http://upload.wikimedia.org/wikipedia/de/e/e2/FC_Parma.svg', 'resources/images/kits/52.png'),
(53, 'NAP', 'SSC Napoli', 'it', 'http://upload.wikimedia.org/wikipedia/commons/2/28/S.S.C._Napoli_logo.svg', 'resources/images/kits/53.png'),
(54, 'UDI', 'Udinese Calcio', 'it', 'http://upload.wikimedia.org/wikipedia/de/b/b1/Udinese_Calcio.svg', 'resources/images/kits/54.png'),
(55, 'EMP', 'Empoli FC', 'it', 'http://upload.wikimedia.org/wikipedia/de/4/42/Logo_FC_Empoli.svg', 'resources/images/kits/55.png'),
(56, 'FRO', 'Frosinone Calcio', 'it', 'https://upload.wikimedia.org/wikipedia/it/c/c3/Frosinonestemma.png', 'resources/images/kits/56.png'),
(57, 'SAS', 'US Sassuolo Calcio', 'it', 'http://upload.wikimedia.org/wikipedia/de/a/a3/US_Sassuolo_Calcio.svg', 'resources/images/kits/57.png'),
(58, 'TOR', 'Torino FC', 'it', 'http://upload.wikimedia.org/wikipedia/de/2/2e/Torino_FC_Logo.svg', 'resources/images/kits/58.png'),
(59, 'HOF', 'TSG 1899 Hoffenheim', 'de', 'https://upload.wikimedia.org/wikipedia/commons/e/e7/Logo_TSG_Hoffenheim.svg', 'resources/images/kits/59.png'),
(60, 'LEV', 'Bayer 04 Leverkusen', 'de', 'https://upload.wikimedia.org/wikipedia/en/5/59/Bayer_04_Leverkusen_logo.svg', 'resources/images/kits/60.png'),
(61, 'BVB', 'BV Borussia 09 Dortmund', 'de', 'http://upload.wikimedia.org/wikipedia/commons/6/67/Borussia_Dortmund_logo.svg', 'resources/images/kits/61.png'),
(62, 'BAY', 'FC Bayern MÃ¼nchen', 'de', 'https://upload.wikimedia.org/wikipedia/commons/1/1b/FC_Bayern_M%C3%BCnchen_logo_%282017%29.svg', 'resources/images/kits/62.png'),
(63, 'S04', 'FC Schalke 04', 'de', 'https://upload.wikimedia.org/wikipedia/commons/6/6d/FC_Schalke_04_Logo.svg', 'resources/images/kits/63.png'),
(64, 'H96', 'Hannover 96', 'de', 'https://upload.wikimedia.org/wikipedia/commons/c/cd/Hannover_96_Logo.svg', 'resources/images/kits/64.png'),
(65, 'BER', 'Hertha BSC', 'de', 'https://upload.wikimedia.org/wikipedia/commons/8/81/Hertha_BSC_Logo_2012.svg', 'resources/images/kits/65.png'),
(66, 'STU', 'VfB Stuttgart', 'de', 'http://upload.wikimedia.org/wikipedia/commons/a/ab/VfB_Stuttgart_Logo.svg', 'resources/images/kits/66.png'),
(67, 'WOB', 'VfL Wolfsburg', 'de', 'https://upload.wikimedia.org/wikipedia/commons/f/f3/Logo-VfL-Wolfsburg.svg', 'resources/images/kits/67.png'),
(68, 'BRE', 'SV Werder Bremen', 'de', 'http://upload.wikimedia.org/wikipedia/commons/b/be/SV-Werder-Bremen-Logo.svg', 'resources/images/kits/68.png'),
(69, 'FCN', '1. FC NÃ¼rnberg', 'de', 'http://upload.wikimedia.org/wikipedia/commons/f/fa/1._FC_N%C3%BCrnberg_logo.svg', 'resources/images/kits/69.png'),
(70, 'MAI', '1. FSV Mainz 05', 'de', 'https://upload.wikimedia.org/wikipedia/commons/9/9e/Logo_Mainz_05.svg', 'resources/images/kits/70.png'),
(71, 'AUG', 'FC Augsburg', 'de', 'http://upload.wikimedia.org/wikipedia/de/b/b5/Logo_FC_Augsburg.svg', 'resources/images/kits/71.png'),
(72, 'SCF', 'SC Freiburg', 'de', 'http://upload.wikimedia.org/wikipedia/de/f/f1/SC-Freiburg_Logo-neu.svg', 'resources/images/kits/72.png'),
(73, 'BMG', 'Borussia MÃ¶nchengladbach', 'de', 'https://upload.wikimedia.org/wikipedia/commons/8/81/Borussia_M%C3%B6nchengladbach_logo.svg', 'resources/images/kits/73.png'),
(74, 'FRA', 'Eintracht Frankfurt', 'de', 'http://upload.wikimedia.org/wikipedia/commons/0/04/Eintracht_Frankfurt_Logo.svg', 'resources/images/kits/74.png'),
(75, 'DUS', 'TSV Fortuna 95 DÃ¼sseldorf', 'de', 'http://upload.wikimedia.org/wikipedia/commons/9/94/Fortuna_D%C3%BCsseldorf.svg', 'resources/images/kits/75.png'),
(76, 'RBL', 'RB Leipzig', 'de', 'https://upload.wikimedia.org/wikipedia/en/0/04/RB_Leipzig_2014_logo.svg', 'resources/images/kits/76.png'),
(77, 'TFC', 'Toulouse FC', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/8/8b/Logo_Toulouse_FC_2018.svg/600px-Logo_Toulouse_FC_2018.svg', 'resources/images/kits/77.png'),
(78, 'SMC', 'SM Caen', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/7/79/Logo_SM_Caen_2016.svg/130px-Logo_SM_Caen_2016.svg', 'resources/images/kits/78.png'),
(79, 'OMA', 'Olympique de Marseille', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/4/43/Logo_Olympique_de_Marseille.svg/130px-Logo_Olympique_de_Marseille.svg.png', 'resources/images/kits/79.png'),
(80, 'MON', 'Montpellier HSC', 'fr', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Montpellier_H%C3%A9rault_Sport_Club_%28logo%2C_2000%29.svg/130px-Montpellier_H%C3%A9rault_Sport_Club_%28logo%2C_2000%29.svg', 'resources/images/kits/80.png'),
(81, 'LIL', 'Lille OSC', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/6/62/Logo_LOSC_Lille_2018.svg/130px-Logo_LOSC_Lille_2018.svg', 'resources/images/kits/81.png'),
(82, 'NIC', 'OGC de Nice CÃ´te d\'Azur', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/b/b1/Logo_OGC_Nice_2013.svg/130px-Logo_OGC_Nice_2013.svg', 'resources/images/kits/82.png'),
(83, 'LYO', 'Olympique Lyonnais', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/e/e2/Olympique_lyonnais_%28logo%29.svg/130px-Olympique_lyonnais_%28logo%29.svg', 'resources/images/kits/83.png'),
(84, 'PSG', 'Paris Saint-Germain FC', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/8/86/Paris_Saint-Germain_Logo.svg/130px-Paris_Saint-Germain_Logo.svg', 'resources/images/kits/84.png'),
(85, 'BOR', 'FC Girondins de Bordeaux', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/7/76/Logo_des_Girondins_de_Bordeaux.svg/130px-Logo_des_Girondins_de_Bordeaux.svg', 'resources/images/kits/85.png'),
(86, 'STE', 'AS Saint-Ã‰tienne', 'fr', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Logo_AS_Saint-%C3%89tienne.svg/130px-Logo_AS_Saint-%C3%89tienne.svg.png', 'resources/images/kits/86.png'),
(87, 'DFC', 'Dijon Football CÃ´te d\'Or', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/c/c9/LogoDFCO.svg/130px-LogoDFCO.svg', 'resources/images/kits/87.png'),
(88, 'REN', 'Stade Rennais FC 1901', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/e/e9/Logo_Stade_Rennais_FC.svg/130px-Logo_Stade_Rennais_FC.svg', 'resources/images/kits/88.png'),
(89, 'ASC', 'Amiens SC', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/e/ec/Logo_Amiens_SC_1998.svg/130px-Logo_Amiens_SC_1998.svg', 'resources/images/kits/89.png'),
(90, 'ANG', 'Angers SCO', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/3/34/Logo_SCO_Angers.svg/130px-Logo_SCO_Angers.svg', 'resources/images/kits/90.png'),
(91, 'EAG', 'En Avant Guingamp', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/9/99/En_Avant_de_Guingamp_logo.svg/130px-En_Avant_de_Guingamp_logo.svg', 'resources/images/kits/91.png'),
(92, 'NAN', 'FC Nantes', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/2/21/Logo_FC_Nantes_2008.svg/130px-Logo_FC_Nantes_2008.svg', 'resources/images/kits/92.png'),
(93, 'SDR', 'Stade de Reims', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/0/0e/Stade_Reims_1999.svg/130px-Stade_Reims_1999.svg', 'resources/images/kits/93.png'),
(94, 'ASM', 'AS Monaco FC', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/b/ba/AS_Monaco_FC.svg/130px-AS_Monaco_FC.svg', 'resources/images/kits/94.png'),
(95, 'NÃŽ', 'NÃ®mes Olympique', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/f/f0/N%C3%AEmes_Olympique_logo_2018.svg/130px-N%C3%AEmes_Olympique_logo_2018.svg', 'resources/images/kits/95.png'),
(96, 'RCS', 'RC Strasbourg Alsace', 'fr', 'https://upload.wikimedia.org/wikipedia/fr/thumb/1/1a/Racing_Club_de_Strasbourg_Alsace_%28RCSA%29_logo.svg/130px-Racing_Club_de_Strasbourg_Alsace_%28RCSA%29_logo.svg', 'resources/images/kits/96.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `num_lineups` int(11) NOT NULL,
  `avatar` varchar(2083) NOT NULL,
  `vip` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `password`, `register_date`, `last_login`, `num_lineups`, `avatar`, `vip`) VALUES
(0, 'Guest', 'guest@guest.com', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 22, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lineups`
--
ALTER TABLE `lineups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lineups`
--
ALTER TABLE `lineups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `styles`
--
ALTER TABLE `styles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
