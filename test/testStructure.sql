
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scyyh4`
--

-- --------------------------------------------------------


--

CREATE TABLE IF NOT EXISTS `log` (
  `Id` int(11) NOT NULL,
  `operation` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `dateTime` datetime NOT NULL,
  `IsNormal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--

CREATE TABLE IF NOT EXISTS `managers` (
  `realname` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------


--

CREATE TABLE IF NOT EXISTS `masks` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `Price` decimal(10,2) NOT NULL COMMENT 'dollar',
  `Description` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Cost` decimal(10,2) NOT NULL COMMENT 'dollar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------


--

CREATE TABLE IF NOT EXISTS `orders` (
  `Id` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `OrderNumber_1` int(11) NOT NULL,
  `OrderNumber_2` int(11) NOT NULL,
  `OrderNumber_3` int(11) NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `IsFinished` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------


--

CREATE TABLE IF NOT EXISTS `reps` (
  `realname` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Id` int(11) NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `region` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `quota_1` int(11) NOT NULL,
  `quota_2` int(11) NOT NULL,
  `quota_3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--

CREATE TABLE IF NOT EXISTS `rep_order_relation` (
  `OrderId` int(11) NOT NULL,
  `RepId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--

CREATE TABLE IF NOT EXISTS `users` (
  `realname` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `Id` int(11) NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `region` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `passport` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--

CREATE TABLE IF NOT EXISTS `user_order_relation` (
  `UserId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`Id`) USING BTREE;

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`Id`) USING BTREE;

--
-- Indexes for table `masks`
--
ALTER TABLE `masks`
  ADD PRIMARY KEY (`Id`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`) USING BTREE;

--
-- Indexes for table `reps`
--
ALTER TABLE `reps`
  ADD PRIMARY KEY (`Id`) USING BTREE;

--
-- Indexes for table `rep_order_relation`
--
ALTER TABLE `rep_order_relation`
  ADD PRIMARY KEY (`OrderId`,`RepId`) USING BTREE,
  ADD KEY `RepId` (`RepId`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`) USING BTREE;

--
-- Indexes for table `user_order_relation`
--
ALTER TABLE `user_order_relation`
  ADD PRIMARY KEY (`UserId`,`OrderId`) USING BTREE,
  ADD KEY `fk_User_Order_Relation_Orders_1` (`OrderId`) USING BTREE,
  ADD KEY `UserId` (`UserId`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `masks`
--
ALTER TABLE `masks`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reps`
--
ALTER TABLE `reps`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
