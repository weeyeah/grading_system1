CREATE TABLE `tblstudent` (
  `S_ID` int(11) NOT NULL,
  `FNAME` varchar(40) NOT NULL,
  `LNAME` varchar(40) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `ADDRESS` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `tblstudent` (`S_ID`, `FNAME`, `LNAME`, `BIRTHDATE`,  `EMAIL`, `ADDRESS`) VALUES
(1, 'RAYMON', 'TORQUILLO', '1985-09-09', 'rtoquillo@gmail.com', 'Kabankalan City');




CREATE TABLE `course` (
  `COURSE_ID` int(11) NOT NULL,
  `COURSE_NAME` varchar(30) NOT NULL,
  `COURSEDESC` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `course` (`COURSE_ID`, `COURSE_NAME`, `COURSEDESC`) VALUES
(12, 'BSIT', 'COLLEGE'),
(13, 'BSBA-MM', 'COLLEGE'),
(14, 'BSBA-FM', 'COLLEGE'),
(15, 'BSA', 'COLLEGE'),
(18, 'BSCRIM', 'COLLEGE'),
(19, 'BPED', 'COLLEGE'),
(21, 'BSED-MATH', 'COLLEGE'),
(22, 'BSED-ENGLISH', 'COLLEGE'),
(23, 'BSED-PILIPINO', 'COLLEGE'),
(24, 'BSED-SCIENCE', 'COLLEGE'),
(25, 'BEED', 'COLLEGE');



CREATE TABLE `instructor` (
  `INST_ID` int(30) NOT NULL,
  `FIRSTNAME` varchar(50) NOT NULL,
  `LASTNAME` varchar(50) NOT NULL,
  `INST_EMAIL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `instructor` (`INST_ID`, `FIRSTNAME`, `LASTNAME`, `INST_EMAIL`) VALUES
(1, 'JOHN', 'CAÑETE', 'johncanete@gmail.com');



CREATE TABLE `enrollment` (
  `ENROLLMENTID` int(11) NOT NULL,
  `STUDID` int(11) NOT NULL,
  `COURSEID` int(11) NOT NULL,
  `DATE_ENROLLED` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `enrollment` (`ENROLLMENTID`, `STUDID`, `COURSEID`, `DATE_ENROLLED`) VALUES
(1, 2019527008, 1, '2019-08-09');



CREATE TABLE `assignment` (
  `ASSIGN_ID` int(11) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `ASSIGNNAME` varchar(50) NOT NULL,
  `TOTAL_POINTS` varchar(20) NOT NULL,
  `DUE_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `assignment` (`ASSIGN_ID`, `COURSE_ID`, `ASSIGNNAME`, `TOTAL_POINTS`, `DUE_DATE`) VALUES
(1, 1, 'Programming', 30, '2023-11-17');



CREATE TABLE `tblgrade` (
  `GRADE_ID` int(11) NOT NULL,
  `STUD_ID` int(11) NOT NULL,
  `ASSIGN_ID` int(11) NOT NULL,
  `POINTS_RECEIVED` varchar(150) NOT NULL,
  `DATE_GRADED` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `tblgrade` (`GRADE_ID`, `STUD_ID`, `ASSIGNMENT_ID`, `POINTS_RECEIVED`, `DATE_GRADED`) VALUES
(1, 1, 1, 25, '2023-11-21');



CREATE TABLE `courseInstructor` (
  `COURSE_INSTID` int(11) NOT NULL,
  `COURSEID` int(11) NOT NULL,
  `INST_ID` int(11) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `courseInstructor` (`COURSE_INSTID`, `COURSEID`, `INST_ID`, `START_DATE`, `END_DATE`) VALUES
(1, 2, 1, '2019-03-18', '2019-08-15');




CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'student', '12345'),
(2, 'admin', 'admin123'),
(3, 'instructor', '123');

