

--
-- Database: `scyyh4`
--


--

INSERT INTO `managers` (`realname`, `username`, `Id`, `password`) VALUES
('root', 'root', 1, '5d41402abc4b2a76b9719d911017c592');


--

INSERT INTO `masks` (`Id`, `Name`, `Price`, `Description`, `Cost`) VALUES
(1, 'N95 respirators', 1.20, 'N95 respirators', 0.80),
(2, 'Surgical masks', 0.80, 'Surgical masks', 0.50),
(3, 'Surgical N95 respirators', 1.70, 'Surgical N95 respirators', 1.00);


--

INSERT INTO `orders` (`Id`, `Date`, `OrderNumber_1`, `OrderNumber_2`, `OrderNumber_3`, `Address`, `IsFinished`) VALUES
(1, '2020-05-25 08:47:59', 50, 50, 50, 'NY', 1);


--

INSERT INTO `reps` (`realname`, `username`, `Id`, `phone_number`, `region`, `email`, `password`, `quota_1`, `quota_2`, `quota_3`) VALUES
('AU1R', 'AU1', 1, '17711771', 'Australia', 'AU@AU.COM', '476021aa0d4ed9664f70f634daf3b34f', 1950, 1950, 1950),
('AU2R', 'AU2', 2, '17722772', 'Australia', 'AU@AU.COM', 'ec19f1d4706157f921877cf22c7abcde', 30, 40, 50),
('AM1', 'AM1', 3, '123123', 'United States', 'AM@AM.com', '73457a99d888ba3212977c59a189db06', 30, 2000, 30);

--

INSERT INTO `rep_order_relation` (`OrderId`, `RepId`) VALUES
(1, 1);


--

INSERT INTO `users` (`realname`, `username`, `Id`, `phone_number`, `region`, `email`, `password`, `passport`) VALUES
('John', 'test1', 1, '1331133', 'Australia', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', 'X-15159000');


--

INSERT INTO `user_order_relation` (`UserId`, `OrderId`) VALUES
(1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
