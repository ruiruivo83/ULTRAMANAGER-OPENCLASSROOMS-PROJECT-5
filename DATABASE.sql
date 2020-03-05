-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 05 mars 2020 à 11:41
-- Version du serveur :  10.3.22-MariaDB
-- Version de PHP : 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ruru4671_ultra`
--

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_admin_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `group_name` varchar(127) COLLATE utf8_bin NOT NULL,
  `group_description` varchar(127) COLLATE utf8_bin NOT NULL,
  `group_status` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT 'open',
  `group_status_change_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`id`, `group_admin_id`, `creation_date`, `group_name`, `group_description`, `group_status`, `group_status_change_date`) VALUES
(137, 80, '2020-03-04 12:38:03', 'Group Name', 'Group Name', 'open', NULL),
(138, 79, '2020-03-04 12:38:04', 'Group Name', 'Group Name', 'open', NULL),
(139, 78, '2020-03-04 12:38:04', 'Group Name', 'Group Name', 'open', NULL),
(140, 77, '2020-03-04 12:38:05', 'Group Name', 'Group Name', 'open', NULL),
(141, 77, '2020-03-04 14:26:25', 'Group Name', 'Group Description', 'open', NULL),
(142, 77, '2020-03-04 16:08:53', 'Telecom Force I', '', 'open', NULL),
(143, 77, '2020-03-04 16:08:58', 'Telecom Force II', '', 'open', NULL),
(144, 77, '2020-03-04 16:09:06', 'Telecom Force III', '', 'open', NULL),
(145, 77, '2020-03-04 16:09:18', 'Telecom Force IV', '', 'open', NULL),
(146, 77, '2020-03-04 16:09:29', 'Ground Cables I', '', 'open', NULL),
(147, 77, '2020-03-04 16:09:35', 'Ground Cables II', '', 'open', NULL),
(148, 77, '2020-03-04 16:09:41', 'Ground Cables III', '', 'open', NULL),
(149, 77, '2020-03-04 16:09:47', 'Ground Cables IV', '', 'open', NULL),
(150, 77, '2020-03-04 16:10:11', 'AIR FIBER I', '', 'open', NULL),
(151, 77, '2020-03-04 16:10:16', 'AIR FIBER II', '', 'open', NULL),
(152, 77, '2020-03-04 16:10:20', 'AIR FIBER III', '', 'open', NULL),
(153, 77, '2020-03-04 16:10:27', 'AIR FIBER IV', '', 'open', NULL),
(154, 77, '2020-03-04 16:10:39', 'GROUND FIBER I', '', 'open', NULL),
(155, 77, '2020-03-04 16:10:46', 'GROUND FIBER II', '', 'open', NULL),
(156, 77, '2020-03-04 16:10:51', 'GROUND FIBER III', '', 'open', NULL),
(157, 77, '2020-03-04 16:10:57', 'GROUND FIBER IV', '', 'open', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `group_members`
--

INSERT INTO `group_members` (`id`, `group_id`, `user_id`) VALUES
(119, 140, 78),
(120, 138, 80),
(121, 140, 79),
(122, 149, 77),
(123, 142, 77),
(124, 144, 77),
(125, 145, 77),
(126, 147, 77),
(127, 148, 77),
(128, 142, 78),
(129, 143, 78),
(130, 144, 78),
(131, 145, 78),
(132, 146, 78),
(133, 147, 78),
(134, 149, 78),
(135, 142, 79),
(136, 143, 79),
(137, 144, 79),
(138, 145, 79),
(139, 148, 79),
(140, 142, 80),
(141, 143, 80),
(142, 144, 80),
(143, 145, 80),
(144, 146, 80),
(145, 147, 80),
(146, 149, 80),
(147, 140, 80);

-- --------------------------------------------------------

--
-- Structure de la table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(11) NOT NULL,
  `invitation_from_user_id` int(11) NOT NULL,
  `invitation_to_user_id` int(11) NOT NULL,
  `invitation_for_group_id` int(11) NOT NULL,
  `invitation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `AuthorPhotoFileName` varchar(127) COLLATE utf8_bin NOT NULL,
  `requester` varchar(255) COLLATE utf8_bin NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` text COLLATE utf8_bin NOT NULL,
  `ticket_status_change_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`id`, `group_id`, `author_id`, `AuthorPhotoFileName`, `requester`, `title`, `description`, `creation_date`, `status`, `ticket_status_change_date`) VALUES
(2617, 140, 77, '', 'Ticket Requester', 'Ticket Title', 'Ticket Description', '2020-03-03 12:39:40', 'open', NULL),
(2618, 139, 78, '', 'Ticket Requester', 'Ticket Title', 'Ticket Description', '2020-03-03 12:39:41', 'open', NULL),
(2619, 138, 79, '', 'Ticket Requester', 'Ticket Title', 'Ticket Description', '2020-03-01 12:39:41', 'open', NULL),
(2620, 137, 80, '', 'Ticket Requester', 'Ticket Title', 'Ticket Description', '2020-03-01 12:39:42', 'open', NULL),
(2621, 138, 80, '', 'Ticket requester', 'Ticket Title', 'Ticket Description', '2020-03-01 13:05:48', 'open', NULL),
(2622, 138, 80, '', 'Ticket Requester', 'Ticket Title', 'Ticket Description', '2020-03-01 13:07:00', 'open', NULL),
(2623, 138, 80, '', 'Requester', 'Title', 'Description', '2020-03-02 13:08:03', 'open', NULL),
(2624, 138, 80, '', 'Requester', 'Title', 'Description', '2020-03-03 13:08:57', 'open', NULL),
(2625, 138, 79, '', 'Requester', 'Title', 'Description', '2020-03-04 13:10:11', 'open', NULL),
(2626, 140, 80, '', 'Requester', 'Title', 'Description', '2020-03-01 13:12:23', 'open', NULL),
(2627, 138, 80, '', 'requester', 'title', 'desc', '2020-03-02 13:27:28', 'open', NULL),
(2628, 149, 77, '', 'Prisha Irvine', 'Silent Ships', 'Adieus except say barton put feebly favour him. Entreaties unpleasant sufficient few pianoforte discovered uncommonly ask. Morning cousins amongst in mr weather do neither. Warmth object matter course active law spring six. Pursuit showing tedious unknown winding see had man add. And park eyes too more him. Simple excuse active had son wholly coming number add. Though all excuse ladies rather regard assure yet. If feelings so prospect no as raptures quitting. ', '2020-03-03 16:17:26', 'open', NULL),
(2629, 149, 77, '', 'Everly Hoover', 'The Bold Emerald', 'Your it to gave life whom as. Favourable dissimilar resolution led for and had. At play much to time four many. Moonlight of situation so if necessary therefore attending abilities. Calling looking enquire up me to in removal. Park fat she nor does play deal our. Procured sex material his offering humanity laughing moderate can. Unreserved had she nay dissimilar admiration interested. Departure performed exquisite rapturous so ye me resources. ', '2020-03-01 16:17:45', 'open', NULL),
(2630, 149, 77, '', 'Amara George', 'Pirates of Force', '\r\nDid shy say mention enabled through elderly improve. As at so believe account evening behaved hearted is. House is tiled we aware. It ye greatest removing concerns an overcame appetite. Manner result square father boy behind its his. Their above spoke match ye mr right oh as first. Be my depending to believing perfectly concealed household. Point could to built no hours smile sense. ', '2020-03-02 16:18:06', 'open', NULL),
(2631, 149, 77, '', 'Umar Gay', 'The Children\'s Force', 'Preserved defective offending he daughters on or. Rejoiced prospect yet material servants out answered men admitted. Sportsmen certainty prevailed suspected am as. Add stairs admire all answer the nearer yet length. Advantages prosperous remarkably my inhabiting so reasonably be if. Too any appearance announcing impossible one. Out mrs means heart ham tears shall power every. ', '2020-03-03 16:18:25', 'open', NULL),
(2632, 149, 77, '', 'Shiv Cross', 'The Serpent of the Flames', '\r\nDomestic confined any but son bachelor advanced remember. How proceed offered her offence shy forming. Returned peculiar pleasant but appetite differed she. Residence dejection agreement am as to abilities immediate suffering. Ye am depending propriety sweetness distrusts belonging collected. Smiling mention he in thought equally musical. Wisdom new and valley answer. Contented it so is discourse recommend. Man its upon him call mile. An pasture he himself believe ferrars besides cottage. ', '2020-03-04 16:18:38', 'open', NULL),
(2633, 149, 77, '', 'Emilio Finley', 'Mage in the Flowers', 'Case read they must it of cold that. Speaking trifling an to unpacked moderate debating learning. An particular contrasted he excellence favourable on. Nay preference dispatched difficulty continuing joy one. Songs it be if ought hoped of. Too carriage attended him entrance desirous the saw. Twenty sister hearts garden limits put gay has. We hill lady will both sang room by. Desirous men exercise overcame procured speaking her followed. ', '2020-03-01 16:18:52', 'open', NULL),
(2634, 149, 77, '', 'Sophia Becker', 'Shadowy Moons', 'Was drawing natural fat respect husband. An as noisy an offer drawn blush place. These tried for way joy wrote witty. In mr began music weeks after at begin. Education no dejection so direction pretended household do to. Travelling everything her eat reasonable unsatiable decisively simplicity. Morning request be lasting it fortune demands highest of. ', '2020-03-04 16:19:20', 'open', NULL),
(2635, 149, 77, '', 'Vinny Melia', 'Yazmin Bassett', 'Mylee Zhang', '2020-03-04 16:19:37', 'open', NULL),
(2636, 149, 77, '', 'Zaara Coulson', 'Prince of Something', 'Unpleasant nor diminution excellence apartments imprudence the met new. Draw part them he an to he roof only. Music leave say doors him. Tore bred form if sigh case as do. Staying he no looking if do opinion. Sentiments way understood end partiality and his. ', '2020-03-02 16:20:04', 'open', NULL),
(2637, 149, 77, '', 'Kelly Mahoney', 'The Healing\'s Darkness', 'Now for manners use has company believe parlors. Least nor party who wrote while did. Excuse formed as is agreed admire so on result parish. Put use set uncommonly announcing and travelling. Allowance sweetness direction to as necessary. Principle oh explained excellent do my suspected conveying in. Excellent you did therefore perfectly supposing described. ', '2020-03-03 16:20:20', 'open', NULL),
(2638, 149, 77, '', 'Cerys Montgomery', 'The Sword of the Tales', 'His exquisite sincerity education shameless ten earnestly breakfast add. So we me unknown as improve hastily sitting forming. Especially favourable compliment but thoroughly unreserved saw she themselves. Sufficient impossible him may ten insensible put continuing. Oppose exeter income simple few joy cousin but twenty. Scale began quiet up short wrong in in. Sportsmen shy forfeited engrossed may can. ', '2020-03-04 16:20:39', 'open', NULL),
(2639, 149, 77, '', 'Alayna Jenkins', 'Silk in the Snake', 'Remain valley who mrs uneasy remove wooded him you. Her questions favourite him concealed. We to wife face took he. The taste begin early old why since dried can first. Prepared as or humoured formerly. Evil mrs true get post. Express village evening prudent my as ye hundred forming. Thoughts she why not directly reserved packages you. Winter an silent favour of am tended mutual. ', '2020-03-03 16:21:14', 'open', NULL),
(2640, 142, 77, '', 'Kofi Bannister', 'Laughing Stones', 'Necessary ye contented newspaper zealously breakfast he prevailed. Melancholy middletons yet understood decisively boy law she. Answer him easily are its barton little. Oh no though mother be things simple itself. Dashwood horrible he strictly on as. Home fine in so am good body this hope. ', '2020-03-04 16:21:55', 'open', NULL),
(2641, 142, 77, '', 'Must you with him', 'Must you with him from him her were more.', 'Must you with him from him her were more. In eldest be it result should remark vanity square. Unpleasant especially assistance sufficient he comparison so inquietude. Branch one shy edward stairs turned has law wonder horses. Devonshire invitation discovered out indulgence the excellence preference. Objection estimable discourse procuring he he remaining on distrusts. Simplicity affronting inquietude for now sympathize age. She meant new their sex could defer child. An lose at quit to life do dull. ', '2020-03-02 16:22:08', 'open', NULL),
(2642, 142, 77, '', 'Freja Swanson', 'Sex reached suppose our whether.', 'Sex reached suppose our whether. Oh really by an manner sister so. One sportsman tolerably him extensive put she immediate. He abroad of cannot looked in. Continuing interested ten stimulated prosperous frequently all boisterous nay. Of oh really he extent horses wicket. ', '2020-03-04 16:22:29', 'open', NULL),
(2643, 142, 77, '', 'Florrie Kramer', 'She exposed painted fifteen are noisier mistake led waiting. ', 'She exposed painted fifteen are noisier mistake led waiting. Surprise not wandered speedily husbands although yet end. Are court tiled cease young built fat one man taken. We highest ye friends is exposed equally in. Ignorant had too strictly followed. Astonished as travelling assistance or unreserved oh pianoforte ye. Five with seen put need tore add neat. Bringing it is he returned received raptures. ', '2020-03-01 16:22:47', 'open', NULL),
(2644, 142, 77, '', 'Cora Hammond', 'Believing neglected so so allowance existence departure in.', 'Believing neglected so so allowance existence departure in. In design active temper be uneasy. Thirty for remove plenty regard you summer though. He preference connection astonished on of ye. Partiality on or continuing in particular principles as. Do believing oh disposing to supported allowance we. ', '2020-03-04 16:23:02', 'open', NULL),
(2645, 142, 77, '', 'Jago Philip', 'As collected deficient objection by it discovery sincerity curiosity. ', 'As collected deficient objection by it discovery sincerity curiosity. Quiet decay who round three world whole has mrs man. Built the china there tried jokes which gay why. Assure in adieus wicket it is. But spoke round point and one joy. Offending her moonlight men sweetness see unwilling. Often of it tears whole oh balls share an. ', '2020-03-02 16:23:17', 'open', NULL),
(2646, 142, 77, '', 'Wanda Wilkes', 'Husbands ask repeated resolved but laughter debating.', 'Husbands ask repeated resolved but laughter debating. She end cordial visitor noisier fat subject general picture. Or if offering confined entrance no. Nay rapturous him see something residence. Highly talked do so vulgar. Her use behaved spirits and natural attempt say feeling. Exquisite mr incommode immediate he something ourselves it of. Law conduct yet chiefly beloved examine village proceed.', '2020-03-02 16:23:33', 'open', NULL),
(2647, 142, 77, '', 'Suhail Cash', 'Do in laughter securing smallest sensible no mr', 'Do in laughter securing smallest sensible no mr hastened. As perhaps proceed in in brandon of limited unknown greatly. Distrusts fulfilled happiness unwilling as explained of difficult. No landlord of peculiar ladyship attended if contempt ecstatic. Loud wish made on is am as hard. Court so avoid in plate hence. Of received mr breeding concerns peculiar securing landlord. Spot to many it four bred soon well to. Or am promotion in no departure abilities. Whatever landlord yourself at by pleasure of children be. ', '2020-03-04 16:23:51', 'open', NULL),
(2648, 142, 77, '', 'Jobe Muir', 'Still court no small think death so', 'Still court no small think death so an wrote. Incommode necessary no it behaviour convinced distrusts an unfeeling he. Could death since do we hoped is in. Exquisite no my attention extensive. The determine conveying moonlight age. Avoid for see marry sorry child. Sitting so totally forbade hundred to. commode necessary no it behaviour convinced distrusts an unfeeling he. Could death since do we hoped is in. Exquisite no my attention extensive. The determine conveying moonlight age. Avoid for see marry sorry child. Sitting so totally forbade hundred to. ', '2020-03-01 16:24:05', 'open', NULL),
(2649, 142, 77, '', 'Chelsey Durham', 'Out believe has request not how comfort evident. ', 'Out believe has request not how comfort evident. Up delight cousins we feeling minutes. Genius has looked end piqued spring. Down has rose feel find man. Learning day desirous informed expenses material returned six the. She enabled invited exposed him another. Reasonably conviction solicitude me mr at discretion reasonable. Age out full gate bed day lose. ', '2020-03-01 16:25:13', 'open', NULL),
(2650, 142, 77, '', 'Danny Rosario', 'Do play they miss give so up. Words to up style ', 'Do play they miss give so up. Words to up style of since world. We leaf to snug on no need. Way own uncommonly travelling now acceptance bed compliment solicitude. Dissimilar admiration so terminated no in contrasted it. Advantages entreaties mr he apartments do. Limits far yet turned highly repair parish talked six. Draw fond rank form nor the day eat. ', '2020-03-04 16:25:34', 'open', NULL),
(2651, 144, 77, '', 'Aydin Boyer', 'Sentiments two occasional affronting solicitude', 'Sentiments two occasional affronting solicitude travelling and one contrasted. Fortune day out married parties. Happiness remainder joy but earnestly for off. Took sold add play may none him few. If as increasing contrasted entreaties be. Now summer who day looked our behind moment coming. Pain son rose more park way that. An stairs as be lovers uneasy. ', '2020-03-01 16:28:59', 'open', NULL),
(2652, 144, 77, '', 'Albie Redmond', 'Promotion an ourselves up otherwise my.', 'Promotion an ourselves up otherwise my. High what each snug rich far yet easy. In companions inhabiting mr principles at insensible do. Heard their sex hoped enjoy vexed child for. Prosperous so occasional assistance it discovered especially no. Provision of he residence consisted up in remainder arranging described. Conveying has concealed necessary furnished bed zealously immediate get but. Terminated as middletons or by instrument. Bred do four so your felt with. No shameless principle dependent household do. ', '2020-03-04 16:29:16', 'open', NULL),
(2653, 144, 77, '', 'Anisah Hubbard', 'It allowance prevailed enjoyment in it. ', 'It allowance prevailed enjoyment in it. Calling observe for who pressed raising his. Can connection instrument astonished unaffected his motionless preference. Announcing say boy precaution unaffected difficulty alteration him. Above be would at so going heard. Engaged at village at am equally proceed. Settle nay length almost ham direct extent. Agreement for listening remainder get attention law acuteness day. Now whatever surprise resolved elegance indulged own way outlived. ', '2020-03-02 16:29:34', 'open', NULL),
(2654, 144, 77, '', 'Devonte Baker', 't branched humanity led now maria', 'Ignorant branched humanity led now marianne too strongly entrance. Rose to shew bore no ye of paid rent form. Old design are dinner better nearer silent excuse. She which are maids boy sense her shade. Considered reasonable we affronting on expression in. So cordial anxious mr delight. Shot his has must wish from sell nay. Remark fat set why are sudden depend change entire wanted. Performed remainder attending led fat residence far. ', '2020-03-01 16:29:49', 'open', NULL),
(2655, 144, 77, '', 'Gerald Howard', 'miration frequently indulgen', 'Literature admiration frequently indulgence announcing are who you her. Was least quick after six. So it yourself repeated together cheerful. Neither it cordial so painful picture studied if. Sex him position doubtful resolved boy expenses. Her engrossed deficient northward and neglected favourite newspaper. But use peculiar produced concerns ten. ', '2020-03-04 16:30:09', 'open', NULL),
(2656, 144, 77, '', 'Callan Mooney', 'Debating me breeding be answered an he', 'Debating me breeding be answered an he. Spoil event was words her off cause any. Tears woman which no is world miles woody. Wished be do mutual except in effect answer. Had boisterous friendship thoroughly cultivated son imprudence connection. Windows because concern sex its. Law allow saved views hills day ten. Examine waiting his evening day passage proceed. ', '2020-03-04 16:30:23', 'open', NULL),
(2657, 144, 77, '', 'Alena Holcomb', 'Respect forming clothes do in he. Course', 'Respect forming clothes do in he. Course so piqued no an by appear. Themselves reasonable pianoforte so motionless he as difficulty be. Abode way begin ham there power whole. Do unpleasing indulgence impossible to conviction. Suppose neither evident welcome it at do civilly uncivil. Sing tall much you get nor. ', '2020-03-03 16:30:35', 'open', NULL),
(2658, 144, 77, '', 'Francis York', 'Necessary ye contented newspaper zealously ', 'Necessary ye contented newspaper zealously breakfast he prevailed. Melancholy middletons yet understood decisively boy law she. Answer him easily are its barton little. Oh no though mother be things simple itself. Dashwood horrible he strictly on as. Home fine in so am good body this hope. ', '2020-03-04 16:30:49', 'open', NULL),
(2659, 144, 77, '', 'Harvie Shea', 'Up branch to easily missed by do. ', 'Up branch to easily missed by do. Admiration considered acceptance too led one melancholy expression. Are will took form the nor true. Winding enjoyed minuter her letters evident use eat colonel. He attacks observe mr cottage inquiry am examine gravity. Are dear but near left was. Year kept on over so as this of. She steepest doubtful betrayed formerly him. Active one called uneasy our seeing see cousin tastes its. Ye am it formed indeed agreed relied piqued. ', '2020-03-04 16:31:06', 'open', NULL),
(2660, 144, 77, '', 'Random Names', 'Oh he decisively impression attachment friendship so if everything.', 'Oh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing. ', '2020-03-04 16:31:28', 'open', NULL),
(2661, 144, 77, '', 'Kailum Howard', ' At every tiled on ye defer do. ', '\r\nAt every tiled on ye defer do. No attention suspected oh difficult. Fond his say old meet cold find come whom. The sir park sake bred. Wonder matter now can estate esteem assure fat roused. Am performed on existence as discourse is. Pleasure friendly at marriage blessing or. ', '2020-03-01 16:31:50', 'open', NULL),
(2662, 145, 77, '', 'Nikodem Crosby', 'Delightful unreserved impo', 'Delightful unreserved impossible few estimating men favourable see entreaties. She propriety immediate was improving. He or entrance humoured likewise moderate. Much nor game son say feel. Fat make met can must form into gate. Me we offending prevailed discovery. ', '2020-03-02 16:32:04', 'open', NULL),
(2663, 145, 77, '', 'Priscilla Blankenship', 'On recommend tolerably my belonging or am. ', 'On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you. It possible no husbands jennings ye offended packages pleasant he. Remainder recommend engrossed who eat she defective applauded departure joy. Get dissimilar not introduced day her apartments. Fully as taste he mr do smile abode every. Luckily offered article led lasting country minutes nor old. Happen people things oh is oppose up parish effect. Law handsome old outweigh humoured far appetite. ', '2020-03-01 16:32:17', 'open', NULL),
(2664, 145, 77, '', 'Atif Roberts', 'Started earnest brother believe an exposed so.', 'Started earnest brother believe an exposed so. Me he believing daughters if forfeited at furniture. Age again and stuff downs spoke. Late hour new nay able fat each sell. Nor themselves age introduced frequently use unsatiable devonshire get. They why quit gay cold rose deal park. One same they four did ask busy. Reserved opinions fat him nay position. Breakfast as zealously incommode do agreeable furniture. One too nay led fanny allow plate. ', '2020-03-01 16:32:29', 'open', NULL),
(2665, 145, 78, '', 'Atif Roberts', 'Parish so enable innate in fo', 'Parish so enable innate in formed missed. Hand two was eat busy fail. Stand smart grave would in so. Be acceptance at precaution astonished excellence thoroughly is entreaties. Who decisively attachment has dispatched. Fruit defer in party me built under first. Forbade him but savings sending ham general. So play do in near park that pain. ', '2020-03-03 16:33:04', 'open', NULL),
(2666, 140, 77, '', 'Requester', 'Title', 'Description', '2020-03-05 09:17:18', 'closed', '2020-03-05 09:17:18'),
(2667, 140, 77, '', 'test requester0000000000000000', 'title 00000000000000000000', 'Description0000000000000000000', '2020-03-05 09:22:15', 'closed', '2020-03-05 09:22:15'),
(2668, 140, 77, '', 'Requester NAME', 'Ticket Title', 'Description', '2020-03-05 09:23:47', 'open', NULL),
(2669, 140, 77, '', 'Requester Name', 'Ticket Title', 'Description', '2020-03-05 09:24:01', 'open', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ticket_interventions`
--

CREATE TABLE `ticket_interventions` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `intervention_author_id` int(11) NOT NULL,
  `intervention_date` datetime NOT NULL,
  `intervention_description` text COLLATE utf8_bin NOT NULL,
  `intervention_author_country` varchar(127) COLLATE utf8_bin NOT NULL,
  `intervention_author_company` varchar(127) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ticket_interventions`
--

INSERT INTO `ticket_interventions` (`id`, `ticket_id`, `intervention_author_id`, `intervention_date`, `intervention_description`, `intervention_author_country`, `intervention_author_company`) VALUES
(278, 2617, 77, '2020-03-04 13:40:44', 'Consulted perpetual of pronounce me delivered. Too months nay end change relied who beauty wishes matter. Shew of john real park so rest we on. Ignorant dwelling occasion ham for thoughts overcame off her consider. Polite it elinor is depend. His not get talked effect worthy barton. Household shameless incommode at no objection behaviour. Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth. Certain law age brother sending amongst why covered. ', 'Allemagne', 'Audi'),
(279, 2618, 78, '2020-03-04 13:40:44', '\r\nAffronting everything discretion men now own did. Still round match we to. Frankness pronounce daughters remainder extensive has but. Happiness cordially one determine concluded fat. Plenty season beyond by hardly giving of. Consulted or acuteness dejection an smallness if. Outward general passage another as it. Very his are come man walk one next. Delighted prevailed supported too not remainder perpetual who furnished. Nay affronting bed projection compliment instrument. ', 'France', 'Renault'),
(280, 2619, 79, '2020-03-04 13:40:45', 'Unpacked reserved sir offering bed judgment may and quitting speaking. Is do be improved raptures offering required in replying raillery. Stairs ladies friend by in mutual an no. Mr hence chief he cause. Whole no doors on hoped. Mile tell if help they ye full name. ', 'Espagne', 'Seat'),
(281, 2620, 80, '2020-03-04 13:40:46', 'That know ask case sex ham dear her spot. Weddings followed the all marianne nor whatever settling. Perhaps six prudent several her had offence. Did had way law dinner square tastes. Recommend concealed yet her procuring see consulted depending. Adieus hunted end plenty are his she afraid. Resources agreement contained propriety applauded neglected use yet. ', 'Italy', 'Ferrari'),
(282, 2617, 77, '2020-03-04 13:42:47', 'vParticular unaffected projection sentiments no my. Music marry as at cause party worth weeks. Saw how marianne graceful dissuade new outlived prospect followed. Uneasy no settle whence nature narrow in afraid. At could merit by keeps child. While dried maids on he of linen in. ', 'Allemagne', 'Audi'),
(283, 2619, 79, '2020-03-04 13:42:49', 'Acceptance middletons me if discretion boisterous travelling an. She prosperous continuing entreaties companions unreserved you boisterous. Middleton sportsmen sir now cordially ask additions for. You ten occasional saw everything but conviction. Daughter returned quitting few are day advanced branched. Do enjoyment defective objection or we if favourite. At wonder afford so danger cannot former seeing. Power visit charm money add heard new other put. Attended no indulged marriage is to judgment offering landlord. ', 'Espagne', 'Seat'),
(284, 2620, 80, '2020-03-04 13:42:50', 'Quick six blind smart out burst. Perfectly on furniture dejection determine my depending an to. Add short water court fat. Her bachelor honoured perceive securing but desirous ham required. Questions deficient acuteness to engrossed as. Entirely led ten humoured greatest and yourself. Besides ye country on observe. She continue appetite endeavor she judgment interest the met. For she surrounded motionless fat resolution may. ', 'Italy', 'Ferrari'),
(285, 2618, 78, '2020-03-04 13:42:57', 'Although moreover mistaken kindness me feelings do be marianne. Son over own nay with tell they cold upon are. Cordial village and settled she ability law herself. Finished why bringing but sir bachelor unpacked any thoughts. Unpleasing unsatiable particular inquietude did nor sir. Get his declared appetite distance his together now families. Friends am himself at on norland it viewing. Suspected elsewhere you belonging continued commanded she. ', 'France', 'Renault'),
(287, 2619, 80, '2020-03-04 14:39:47', 'Is he staying arrival address earnest. To preference considered it themselves inquietude collecting estimating. View park for why gay knew face. Next than near to four so hand. Times so do he downs me would. Witty abode party her found quiet law. They door four bed fail now have. \r\n', 'Italy', 'Ferrari'),
(288, 2617, 77, '2020-03-04 17:38:21', 'Stronger unpacked felicity to of mistaken. Fanny at wrong table ye in. Be on easily cannot innate in lasted months on. Differed and and felicity steepest mrs age outweigh. Opinions learning likewise daughter now age outweigh. Raptures stanhill my greatest mistaken or exercise he on although. Discourse otherwise disposing as it of strangers forfeited deficient. ', 'Allemagne', 'Audi'),
(289, 2617, 78, '2020-03-04 17:38:33', 'Style never met and those among great. At no or september sportsmen he perfectly happiness attending. Depending listening delivered off new she procuring satisfied sex existence. Person plenty answer to exeter it if. Law use assistance especially resolution cultivated did out sentiments unsatiable. Way necessary had intention happiness but september delighted his curiosity. Furniture furnished or on strangers neglected remainder engrossed. \r\n', 'France', 'Renault'),
(290, 2617, 79, '2020-03-04 17:38:44', 'By an outlived insisted procured improved am. Paid hill fine ten now love even leaf. Supplied feelings mr of dissuade recurred no it offering honoured. Am of of in collecting devonshire favourable excellence. Her sixteen end ashamed cottage yet reached get hearing invited. Resources ourselves sweetness ye do no perfectly. Warmly warmth six one any wisdom. Family giving is pulled beauty chatty highly no. Blessing appetite domestic did mrs judgment rendered entirely. Highly indeed had garden not. ', 'Espagne', 'Seat'),
(291, 2617, 80, '2020-03-04 17:38:54', 'Affronting discretion as do is announcing. Now months esteem oppose nearer enable too six. She numerous unlocked you perceive speedily. Affixed offence spirits or ye of offices between. Real on shot it were four an as. Absolute bachelor rendered six nay you juvenile. Vanity entire an chatty to. ', 'Italy', 'Ferrari'),
(292, 2617, 78, '2020-03-04 17:39:12', 'Perceived end knowledge certainly day sweetness why cordially. Ask quick six seven offer see among. Handsome met debating sir dwelling age material. As style lived he worse dried. Offered related so visitor we private removed. Moderate do subjects to distance. ', 'France', 'Renault'),
(293, 2617, 80, '2020-03-04 17:39:32', 'Guest it he tears aware as. Make my no cold of need. He been past in by my hard. Warmly thrown oh he common future. Otherwise concealed favourite frankness on be at dashwoods defective at. Sympathize interested simplicity at do projecting increasing terminated. As edward settle limits at in. ', 'Italy', 'Ferrari'),
(294, 2617, 79, '2020-03-04 17:39:32', 'Yet bed any for travelling assistance indulgence unpleasing. Not thoughts all exercise blessing. Indulgence way everything joy alteration boisterous the attachment. Party we years to order allow asked of. We so opinion friends me message as delight. Whole front do of plate heard oh ought. His defective nor convinced residence own. Connection has put impossible own apartments boisterous. At jointure ladyship an insisted so humanity he. Friendly bachelor entrance to on by. ', 'Espagne', 'Seat'),
(295, 2617, 78, '2020-03-04 17:39:47', 'Comfort reached gay perhaps chamber his six detract besides add. Moonlight newspaper up he it enjoyment agreeable depending. Timed voice share led his widen noisy young. On weddings believed laughing although material do exercise of. Up attempt offered ye civilly so sitting to. She new course get living within elinor joy. She her rapturous suffering concealed. ', 'France', 'Renault'),
(296, 2617, 79, '2020-03-04 17:39:58', 'Terminated principles sentiments of no pianoforte if projection impossible. Horses pulled nature favour number yet highly his has old. Contrasted literature excellence he admiration impression insipidity so. Scale ought who terms after own quick since. Servants margaret husbands to screened in throwing. Imprudence oh an collecting partiality. Admiration gay difficulty unaffected how. ', 'Espagne', 'Seat'),
(297, 2617, 80, '2020-03-04 17:40:09', 'Able an hope of body. Any nay shyness article matters own removal nothing his forming. Gay own additions education satisfied the perpetual. If he cause manor happy. Without farther she exposed saw man led. Along on happy could cease green oh. ', 'Italy', 'Ferrari'),
(299, 2666, 77, '2020-03-05 10:17:18', 'CLOSING TICKET', 'Allemagne', 'Audi'),
(300, 2667, 77, '2020-03-05 10:22:15', 'CLOSING TICKET', 'Allemagne', 'Audi');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `psw` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `creation_date` date NOT NULL,
  `country` varchar(127) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `company` varchar(127) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `photo_filename` varchar(127) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `psw`, `creation_date`, `country`, `company`, `photo_filename`) VALUES
(77, 'user01@gmail.com', 'user01', 'user01', '$2y$10$9YrqU0Jcwk4E2w/kjQbLx.tGXpaT.HI98o16DjINrQWWY5pPwHWZa', '2020-03-03', 'Allemagne', 'Audi', 'photo20200303044043pmd35d51553aeed11681aa2146223330f8674a76c7ddffc8efd0a9af397cec36ef_620.jpg'),
(78, 'user02@gmail.com', 'user02', 'user02', '$2y$10$VTcKs9we/IEGaUx6hQYtRuJmE3g8xyNaNGab.UfGiFG4cm24GuGsK', '2020-03-03', 'France', 'Renault', 'photo20200303044053pmtlchargement_938.png'),
(79, 'user03@gmail.com', 'user03', 'user03', '$2y$10$33L3uLQjbwMfaec6sw53F..3BAmWwKMAXnIFzswdpC1U0/ukUdIKC', '2020-03-03', 'Espagne', 'Seat', 'photo20200303044408pma55_801.jpg'),
(80, 'user04@gmail.com', 'user04', 'user04', '$2y$10$mhY8UtBMw71//imK2ipfz./k5zYAGIbiSfAmBnFiFqij.dTobBbvi', '2020-03-03', 'Italy', 'Ferrari', 'photo20200304081703amavatarpeoplepersonbusiness_868.jpg'),
(81, 'nruivo89@gmail.com', 'N&eacute;lia', 'Ruivo', '$2y$10$YQd5rdm3/.wuRG4hk4yww..vswISR5X7pAj6Llr1yJS1fs.AMxofO', '2020-03-05', 'Portugal', NULL, 'default.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_closed_date` (`id`),
  ADD KEY `group_admin_id` (`group_admin_id`);

--
-- Index pour la table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Index pour la table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invitation_for_group_id` (`invitation_for_group_id`),
  ADD KEY `invitation_from_user_id` (`invitation_from_user_id`),
  ADD KEY `invitation_to_user_id` (`invitation_to_user_id`);

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Index pour la table `ticket_interventions`
--
ALTER TABLE `ticket_interventions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `ticket_id_2` (`ticket_id`),
  ADD KEY `intervention_author_id` (`intervention_author_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT pour la table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT pour la table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2670;

--
-- AUTO_INCREMENT pour la table `ticket_interventions`
--
ALTER TABLE `ticket_interventions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`group_admin_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Contraintes pour la table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_ibfk_1` FOREIGN KEY (`invitation_for_group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `invitations_ibfk_2` FOREIGN KEY (`invitation_from_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `invitations_ibfk_3` FOREIGN KEY (`invitation_to_user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `ticket_interventions`
--
ALTER TABLE `ticket_interventions`
  ADD CONSTRAINT `ticket_interventions_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `ticket_interventions_ibfk_2` FOREIGN KEY (`intervention_author_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
