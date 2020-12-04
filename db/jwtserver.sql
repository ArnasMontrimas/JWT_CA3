-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 05:34 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jwtserver`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(3) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_year` int(4) DEFAULT NULL,
  `platform` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'NULL',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `genre`, `release_year`, `platform`, `description`) VALUES
(27, 'Bloodborne', 'Action,RPG', 2015, 'PS4', 'Bloodborne isn?t like most modern games. It doesn?t ease you into the experience, slowly teaching you the rules and giving you time to understand its complex systems. It doesn?t put you in the role of a super-powered hero capable of taking down dangerous beasts with ease. Instead, it casts you as a regular person and throws you into a gothic world of violence and despair. And then it kills you, over and over.\r\n\r\nBloodborne?s unforgiving nature is a large part of its appeal. The spiritual successor to the Dark Souls series, it?s a game where every victory feels hard won. The bosses are huge, grotesque monstrosities that will take every ounce of your skill to defeat, but even the standard enemies ? the plague-inflicted inhabitants of Yharnam ? can kill you. Bloodborne forces you to learn how it works, and then tests your knowledge in the most brutal ways possible. It?s a game where you will die a lot ? but that only makes your eventual victory all the more satisfying.'),
(30, 'Hearthstone', 'Strategy', 2014, 'PC,Smartphone', 'Video gamers may wonder why they would play a card game when their medium has moved beyond such limitations; tabletop gamers may bemoan the fact that people are getting excited about the wrong card game. But if you fall awkwardly between those two groups, Hearthstone will keep you hooked for some time.'),
(33, 'Dishonored', 'Action,RPG', 2012, 'PC', 'Approach each assassination with your own unique style. Use shadow and sound to your advantage to traverse silently through levels unseen by enemies, or attack foes head-on as they react to your aggression. The malleable combat system allows you to creatively synthesize your abilities, supernatural powers and gadgets as you negotiate your way through the levels and dispatch your targets. Improvise and adapt to define your modus operandi.'),
(39, 'GTA V', 'Open-World', 2013, 'PC,PS3,Xbox 360', 'Rockstar\'s record-breaking behemoth crushed everything else this year in terms of sales, its super-charged mix of ultra-violence, scattergun satire and visual beauty ensuring hundreds of millions of dollars in revenue. Los Santos is a world realised in incredible depth and the fact that this sprawling landscape is still giving up secrets to obsessive players months after release says much about the care, attention and passion lavished on the game. We\'d dearly love to have seen a female protagonist and we could have done with waaaay less bickering between Trevor and Michael in the main campaign. But for bombastic, brain-bludgeoning set-pieces, GTA V could not be beaten ? and as flawed and broken as it was, GTA Online provides an intriguing vision of where online multiplayer can go. Enhanced PC version next year? Everyone knows it makes sense.'),
(41, 'Destiny 2', 'Action,RPG', 2017, 'Xbox One,PS4,PC', 'The sequel that launched a thousand think pieces and podcast episodes, not to mention Reddit threads. To put it succinctly, developer Bungie managed to accomplish most of what it set out to do in Destiny with Destiny 2. This year?s take on the loot-based, massively multiplayer online shooter showed how rewarding that concept could be when fully realized. This time around, there was plenty to do at every level and the end-game material was challenging and ambitious (if a little buggy here and there.) Sure, most hardcore Destiny devotees blew through the game relatively quickly. (And true of those, a few Stockholm Syndrome-suffering devotees yearned for the relentless grind of the original.) But, the sequel managed to set itself up as something worth coming back to again and again as downloadable updates and expansions come out throughout the next year.'),
(42, 'Cuphead', 'Platformer', 2017, 'Xbox One,PC', 'Cuphead is Betty Boop meets a shoot ?em up meets?a design miracle. Studio MDHR?s 2D side-scroller has players do battle with giant carrots, boxing frogs, angry birds, queen bees and gambling contraptions. And all of it hand-sketched, inked and painted to resemble a 1930s Max Fleischer cartoon. This is one of those games that has to be seen in action to truly grasp the size of its achievement as a piece of visual art. It is also, as a game, incredibly difficult which, with its themes and setup, is just as it ought to be.'),
(43, 'Batman: Arkham Knigh', 'Action', 2015, 'PC,PS4,Xbox One', 'The power fantasy at the heart of Batman: Arkham Knight remains one of the most seductive in all of gaming: spend enough time brawling, blasting, and winching, and you can liberate an entire metropolis with a single tool belt and tank. (Seriously, you?re going to be doing a lot of winching.) You can spend hours soaring above Gotham?s skyline, tuning into radio dispatches from friends and foes alike. No one can touch you. If you hear a bunch of thugs wailing on a captive or daring to insult the Caped Crusader, you can swoop in and show them the cost of tempting fate. The city is your oyster.\r\n\r\nThe combo-heavy combat system that birthed a dozen action-adventure knock-offs remains fluid and physical, and the deep bench full of various Batman villains helps to liven up what would otherwise be boilerplate beat ?em up side quests. Like its predecessors in Rocksteady?s Arkham series, Arkham Knight understands that Batman?s toughest battles are mental; there?s no villain more dangerous than the darkness looming in Bruce Wayne?s mind. Arkham Knight?s treatment of that truth is heavy-handed, but that doesn?t make it any less satisfying.'),
(45, 'Rocket League', 'Sports', 2015, 'PC,PS4', 'The most exciting sports highlight clip I saw this year wasn?t shown on SportsCenter or one of its competitors. It didn?t even involve humans, not unless you count the ones operating the controllers. It was the final few minutes of MLG?s first Rocket League tournament, a contest that included both a thrilling comeback and a heartbreaking, gravity-defying gut punch of a game winner. I?ve seen it a dozen times since September, and it?s still powerful enough to give me a near-heart attack. ESPN has felt a little dry ever since.\r\n\r\nRocket League gets in the door with one of the goofiest, simplest one-line pitches you can imagine: it?s soccer, but with rocket-powered cars. It sticks in your craw because the minute-to-minute gameplay is easy to learn, tough to master, and somehow produces a handful of those heart-stopping moments every time you play. That?s why people kept coming back and revving their engines even after the game?s novelty wore off: once you?ve had the chance to play hero yourself, it?s hard not to chase that feeling.'),
(46, 'Titanfall', 'Shooter', 2014, 'Xbox One', 'Titanfall is a sort of masterpiece, so confident in itself and its identity, yet so reverent in its art direction to the science fiction visions of artists such as Sh?ji Kawamori, Kunio Okawara, Syd Mead and Chris Foss. You will play for hours, get tired, think you?re done, and switch it off, but then it nags at you and you go back. Sure, it is the pattern of compulsion that has governed the genre since Modern Warfare, but here it is tuned and perfected and ever-so-slightly evolved, and it is wonderful at times.'),
(48, 'God of War', 'Action', 2018, 'PS4', 'The first three God of War games were very dumb but kinda fun, featuring Kratos, a pissed-off Greek demigod, killing the entire pantheon while being humorless and horny (bathhouse sequences were not infrequent). The first shot of this franchise reboot establishes an entirely new tone, with Kratos wielding an axe not to chop off someone?s head, but to cut down a tree for a funeral pyre for his recently deceased wife. Kratos has grown old, moved north to the realm of Norse mythology, married, and had a son. Now he?s a widower, grieving, and unable to do much more than gruffly bark orders at his son. The pair set off to fulfill his wife?s final wish, spreading her ashes from the highest peak. In between, there?s plenty of combat and exploration, some scheming Norse gods, one very entertaining talking decapitated head, and a deftly-handled dramatic arc of a father opening up to his son. The game?s bravura camerawork is done in one long, uninterrupted shot with no loading screens in sight, and the combat has a real thunk to it thanks to weighty animations that make every axe blow feel thunderous. But it?s God of War?s delicate touch, as Kratos and his son slowly connect over the course of their journey, that makes this game truly impressive.'),
(49, 'Into the Breach', 'Strategy', 2018, 'PC,Switch', 'From the creators of indie hit FTL, Into the Breach is a turn-based strategy game in which you control three mechs protecting near-apocalyptic Earth from marauding aliens ? think Pacific Rim mixed with chess. Each turn, you can see exactly what each enemy will do, but that only helps you so much. Into the Breach is a game that will throw five or six problems your way in a turn, and you have just three mechs to try to solve all of them. You?re free to study the battlefield as long as you like: Perhaps you could launch an artillery shell at this alien here, moving it over one square to make it shoot that alien there, but then the shell will also damage a nearby city. There?s rarely an easy answer, and you can easily spend or 10 or 15 minutes trying out various combinations of potential moves before pulling the trigger. But no other game I played this year made me feel more satisfied than Into the Breach when I finally worked out a solution that saved the world ? for one more turn, at least.'),
(69, 'Mark of the Ninja', 'Platformer', 2012, 'PC', '\'Mark of the Ninja\' is a side-scrolling stealth action game from Klei Entertainment that combines fluid 2D animation with intense stealth gameplay. Observe your enemies from afar, manipulate them with your tools, and execute your plan with precision. But be careful - you\'re as fragile as you are powerful.'),
(70, 'XCOM: Enemy Unknown', 'Strategy', 2012, 'PC', 'Enemy Unknown couples tactical turn-based gameplay with action sequences and on-ground combat. Recruit, specialize and train unique soldiers and manage your personnel. Detect and interrupt the alien threat as you construct and expand your XCOM headquarters. Direct soldier squads in turn-based ground battles and deploy air units such as the Interceptor and Skyranger. The fight spreads around the world as the XCOM team engages in over 70 missions, communicating and negotiating with governments around the world.'),
(71, 'Mirror\'s Edge Cataly', 'Stealth', 2016, 'PC', 'Much like Dishonored 2, here?s another returning parkour-flavoured, open world-ish game in which the protagonist must triumph against the backcloth of a beautifully drawn dystopia. Catalyst is a reboot rather than sequel though, with notable changes including more freedom to explore the city (which is called, in a victory for nominative determinism, ?Glass?) and the removal of any player-controlled firearms. Much will depend on whether DICE has been able to get the combat to feel right, but that system has apparently been a key focus. Certainly the first gameplay trailer certainly looks promising enough, even if the inevitable deluge of Faith-based puns remains a serious misgiving.'),
(72, 'Hitman', 'Stealth', 2016, 'PC', 'Having been delayed into 2016, the PC beta of Agent 47 prequel-come-reboot will go live on February 19, followed by a full release the month after. Given the disappointment over Absolution, much will hinge on how this new Hitman?s intriguing approach to mission structure plays out. Levels are said to be more sandboxy, and much bigger than those of their predecessor. Most interesting is the suggestion that some contracts will be time limited, and the release of the complete set of missions will be staggered following the base game?s release. It?ll likely either be a bold new dawn for how action games get made, or next year?s first fan uprising.'),
(73, 'Everspace', 'Shooter', 2016, 'PC', 'A gorgeous roguelike space dogfighting game, Everspace raised hundreds of thousands of dollars on Kickstarter thanks to just a few videos. But wow, just look at it. The devs hope space mining and a non-linear story will add depth and a bit of longevity, but the focus is on pretty satisfying arcade shooting and a loot system that lets you upgrade your ship between runs. ?Every time you die you are going to be rewarded?, claims Rockfish on the Everspace site.'),
(75, 'The Last of Us', 'Survival', 2013, 'PS3', 'In Joel and Ellie\'s story of survival against the odds ? and against all reason ? Naughty Dog provided us with one of the most mature and gruelling mainstream action adventures of the decade. While some saw it as little more than a post-apocalyptic palette swap for Uncharted, this is a very different beast ? a true narrative journey in which characters and relationships eclipse all other concerns. But it is also exciting and involving, with a thuddingly violent combat mechanic and a continual sense of raw peril. So many wonderful dramatic moments too, from lovesick survivors committing suicide to giraffes wandering the sun-scorched city streets. Whatever you make of its devastating conclusions, the Last of Us was the moment that cinematic gaming started to mean something ? something that went beyond form and into feeling. It hints at amazing things for the future.'),
(76, 'Battlefield 3', 'Shooter', 2011, 'PC,PS3,Xbox 360', 'For war shooter veterans, there was quite the battle of the titans to focus on towards the end of 2011, as Battlefield 3 took Call of Duty: Modern Warfare 3 head on. But while the latter clearly came out on top in terms of sales thanks to its legions of fans, Battlefield 3 proved itself to be a worthy competitor, providing one of the deepest team-based multiplayer shooter experiences ever released.'),
(77, 'The Elder Scroll V: ', 'Open-World', 2011, 'PC,PS4,Xbox One', 'There\'s something to be said about a game where you can get lost for 30 hours, aimlessly wander the countryside, and make absolutely no progress on the main campaign. That kind of experience is plenty common in Bethesda\'s latest open-world role-playing game, which succeeds not in providing a tightly-directed thrill ride, but by letting players guide the game at their own pace.'),
(78, 'Portal 2', 'Puzzle', 2011, 'PC,PS3,Xbox 360', 'With every tough puzzle that you solve, you feel empowered to soldier forward and take on the next challenge, which usually is even more difficult than the last. The ratio of difficulty to player satisfaction is virtually perfect, and something that Valve\'s contemporaries might want to closely study.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `user_id` int(3) DEFAULT NULL,
  `usage` int(1) DEFAULT 0,
  `type` enum('free','premium') DEFAULT 'free',
  `valid_time` int(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `usage`, `type`, `valid_time`) VALUES
(26, 10, 1, 'free', 1607185795),
(27, 11, 0, 'free', 1607185863),
(28, 12, 1, 'free', 1607185877);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_user_id` (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
