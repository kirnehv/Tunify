-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2019 at 08:25 PM
-- Server version: 10.3.12-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tunify`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'Greatest Hits', 3, 1, 'assets/images/artwork/GreatestHits.jpg'),
(2, 'Appetite for Destruction', 2, 2, 'assets/images/artwork/AppetiteforDestruction.jpg'),
(3, 'Divide', 4, 3, 'assets/images/artwork/Divide.png'),
(4, 'Head on My Shoulder', 1, 4, 'assets/images/artwork/PutHeadOnShoulder.jpg'),
(5, 'PSY Six Rules', 5, 5, 'assets/images/artwork/Gangnam.png'),
(6, 'Thriller', 6, 6, 'assets/images/artwork/mj.png'),
(7, 'Hot Ninja', 7, 7, 'assets/images/artwork/HotCover.jpg'),
(8, 'So Cold', 8, 8, 'assets/images/artwork/Gcover.jpeg'),
(9, 'Crystallize', 9, 9, 'assets/images/artwork/lindsey.jpeg'),
(10, 'In My Feelings', 10, 10, 'assets/images/artwork/drakescorp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'Paul Anka'),
(2, 'Guns N\' Roses'),
(3, '2Pac'),
(4, 'Ed Sheeran'),
(5, 'PSY'),
(6, 'Michael Jackson'),
(7, 'Bobby Shmurda'),
(8, 'G-Eazy'),
(9, 'Lindsey Stirling'),
(10, 'Drake');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Rap'),
(2, 'Rock'),
(3, 'Pop'),
(4, 'Classical'),
(5, 'K-Pop'),
(6, 'Techno'),
(7, 'Jazz'),
(8, 'Folk'),
(9, 'Country');

-- --------------------------------------------------------

--
-- Table structure for table `Songs`
--

CREATE TABLE `Songs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist` int(11) DEFAULT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Songs`
--

INSERT INTO `Songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`) VALUES
(1, 'Changes', 3, 1, 1, '4:40', 'assets/music/changes.mp3', 1, 66),
(2, 'Gangnam Style', 5, 5, 5, '4:06', 'assets/music/gangnam_style.mp3', 1, 36),
(3, 'Put Your Head On My Shoulder', 1, 4, 4, '2:36', 'assets/music/head_on_shoulder.mp3', 1, 20),
(4, 'Shape Of You', 4, 3, 3, '3:55', 'assets/music/shape_of_you.mp3', 1, 47),
(5, 'Welcome To The Jungle', 2, 2, 2, '4:31', 'assets/music/welcome_to_the_jungle.mp3', 1, 32),
(6, 'Hail Mary', 3, 1, 1, '5:15', 'assets/music/hail_mary.mp3', 2, 58),
(7, 'California Love', 3, 1, 1, '4:50', 'assets/music/california_love.mp3', 3, 61),
(9, 'Sweet Child O\' Mine', 2, 2, 2, '4:59', 'assets/music/sweet_child_o_mine.mp3', 2, 28),
(10, 'Gentleman', 5, 5, 5, '3:53', 'assets/music/gentleman.mp3', 2, 23),
(11, 'It\'s So Easy', 2, 2, 2, '3:20', 'assets/music/its_so_easy.mp3', 3, 6),
(12, 'Paradise City', 2, 2, 2, '6:47', 'assets/music/paradise_city.mp3', 4, 9),
(13, 'Night Train', 2, 2, 2, '4:30', 'assets/music/night_train.mp3', 5, 12),
(14, 'Perfect', 4, 3, 3, '4:23', 'assets/music/perfect.mp3', 2, 1),
(15, 'Thriller', 6, 6, 6, '5:58', 'assets/music/Thriller.mp3', 1, 2),
(16, 'Hot Ninja', 7, 7, 7, '3:15', 'assets/music/HotNinja.mp3', 1, 3),
(17, 'So Cold', 8, 8, 1, '', 'assets/music/G-Eazy - So Cold (Ocean Mix).mp3', 1, 4),
(18, 'Crystallize', 9, 9, 1, '', 'assets/music/Crystallize - Lindsey Stirling (Dubstep Violin Original Song).mp3', 1, 3),
(19, 'In My Feelings', 10, 10, 1, '', 'assets/music/Drake - In My Feelings (Clean).mp3', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setUpDate` datetime NOT NULL,
  `profilePic` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `setUpDate`, `profilePic`) VALUES
(8, 'hello', 'Hello', 'Hello', '123@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2018-12-08 00:00:00', 'assets/images/profile-pics/Icon.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Songs`
--
ALTER TABLE `Songs`
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
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Songs`
--
ALTER TABLE `Songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
