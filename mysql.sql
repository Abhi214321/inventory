-- Create the 'inventory' database
CREATE DATABASE inventory;

-- Use the 'inventory' database
USE inventory;

-- Create the 'audit' table
CREATE TABLE audittable (
    Audit_id INT ,
    Audit_date DATE NOT NULL, 
    furniture_id INT,
    furniture_name VARCHAR(255) NOT NULL,
    from_delivery VARCHAR(255) NOT NULL,
    Audit_quantity INT NOT NULL,
    Audit_amountpp DECIMAL(10,2) ,
    Audit_amount DECIMAL(10,2) 
);

-- Create the 'furniture' table
CREATE TABLE furnituretable (
    furniture_id INT PRIMARY KEY,
    furniture_name VARCHAR(255) NOT NULL,
    furniture_quantity INT NOT NULL
);

-- Create the 'teachers' table
CREATE TABLE teacherstable (
    kg_id VARCHAR(20) PRIMARY KEY,
    teachers_name VARCHAR(255) NOT NULL,
    department_name VARCHAR(255) NOT NULL
);

-- Create the 'usage' table
CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `fullname`, `password`, `email`) VALUES
(101, 'Abhishek', 'Abhi2143', 'abhishek.hr.ssmrvpu@gmail.com');
COMMIT;

-- Insert random values into 'audit' table
INSERT INTO audittable VALUES
(449, '2011-1-17', 201, 'steel dual desk','karakushala kaigarika kendra bengaluru-022',11,'6999.00','89693.00'),
(441, '2011-1-14', 201, 'steel dual desk','karakushala kaigarika kendra bengaluru-022',11,'6999.00','89693.00'),
(450, '2011-2-08', 201, 'steel dual desk','karakushala kaigarika kendra bengaluru-022',11,'6999.00','89693.00'),
(441, '2011-2-05', 201, 'steel dual desk','karakushala kaigarika kendra bengaluru-022',11,'6999.00','89693.00'),
(346, '2011-2-11', 201, 'steel dual desk','karakushala kaigarika kendra bengaluru-022',11,'6999.00','89693.00'),
(347, '2011-2-11', 202, 'Green board Big','manjushree engineering bengaluru-054',03,'8999.00','26997.00'),
(347, '2011-2-11', 203, 'White board','manjushree engineering bengaluru-054',03,'8999.00','20997.00'),
(347, '2011-2-11', 218, 'Green board','manjushree engineering bengaluru-054',03,'3999.00','11997.00'),
(347, '2011-2-11', 204, 'pin up board','manjushree engineering bengaluru-054',03,'4999.00','14997.00'),
(348, '2011-2-11', 205, 'Executive table','manjushree engineering bengaluru-054',01,'8580.00','8580.00'),
(348, '2011-2-11', 205, 'Executive table','manjushree engineering bengaluru-054',05,'7450.00','37250.00'),
(348, '2011-2-11', 206, 'staff table','manjushree engineering bengaluru-054',06,'4999.00','29994.00'),
(1150, '2012-3-10', 206, 'staff table','karakushala kaigarika kendra bengaluru-022',12,'5999.00','84225.00'),
(345, '2011-2-11', 207, 'executive hitech revolving chair ','manjushree engineering bengaluru-054',01,'6999.00','6999.00'),
(345, '2011-2-11', 208, 'Revolving low back chair','manjushree engineering bengaluru-054',07,'5999.00','41993.00'),
(345, '2011-3-11', 209, 'S-type chairs','manjushree engineering bengaluru-054',14,'1999.00','27986.00'),
(1149, '2012-3-10', 201, 'steel dual desk','karakushala kaigarika kendra bengaluru-022',10,'7675.00','89798.00'),
(1151, '2012-3-10', 201, 'steel dual desk','karakushala kaigarika kendra bengaluru-022',10,'7675.00','89798.00'),
(1146, '2012-3-10', 201, 'steel dual desk','karakushala kaigarika kendra bengaluru-022',10,'7675.00','89798.00'),
(1147, '2012-3-10', 201, 'steel dual desk','karakushala kaigarika kendra bengaluru-022',10,'7675.00','89798.00'),
(1153, '2012-3-10', 210, 'Drawing table','karakushala kaigarika kendra bengaluru-022',10,'7690.00','89973.00'),
(1155, '2012-3-10', 210, 'Drawing table','karakushala kaigarika kendra bengaluru-022',10,'7690.00','89973.00'),
(1152, '2012-3-10', 210, 'Drawing table','karakushala kaigarika kendra bengaluru-022',10,'7690.00','89973.00'),
(1154, '2012-3-10', 210, 'Drawing table','karakushala kaigarika kendra bengaluru-022',10,'7690.00','89973.00'),
(1148, '2012-3-10', 211, 'steel almirah','karakushala kaigarika kendra bengaluru-022',07,'9999.00','82092.00'),
(097, '2012-3-12', 212, 'wooden stool','venkateshwara enterprises bengaluru',40,'1950.00','88920.00'),
(098, '2012-3-12', 212, 'wooden stool','venkateshwara enterprises bengaluru',40,'1950.00','88920.00'),
(099, '2012-3-12', 212, 'wooden stool','venkateshwara enterprises bengaluru',40,'1950.00','88920.00'),
(099, '2012-3-14', 213, 'book racks m.s','venkateshwara enterprises bengaluru',09,'8000.00','72000.00'),
(061, '2013-3-19', 214, 'Library chair / visitors chair','venkateshwara enterprises bengaluru',30,'2400.00','82080.00'),
(063, '2013-3-19', 215, 'Library table','venkateshwara enterprises bengaluru',05,'1500.00','85500.00'),
(1395, '2013-3-05', 201, 'steel dual desk','karakushala kaigarika kendra bengaluru-022',10,'7675.00','89798.00'),
(1396, '2013-3-13', 216, 'steel Almirah(with single locker)','karakushala kaigarika kendra bengaluru-022',07,'10199.00','83520.00'),
(1420, '2013-3-13', 216, 'steel Almirah(with single locker)','karakushala kaigarika kendra bengaluru-022',07,'10999.00','90465.00'),
(1420, '2015-4-13', 217, '4 seater Steel Dual Desk','I.C india pvt.ltd banashankari bengaluru-85',78,'11021.00','984360.00');
-- Insert random values into 'furniture' table
INSERT INTO furnituretable VALUES
(201, 'Steel Dual Desk', 105),
(202, 'Green Board Big',03),
(203, 'White Board', 03),
(204, 'Pin Up Board', 03),
(205, 'Executive Table',06),
(206, 'Staff Table', 18),
(207, 'Executive Hitech Revolving Chair', 01),
(208, 'Revolving Low back Chair',07),
(209, 'S-Type Chairs', 14),
(210, 'Drawing Table', 40),
(211, 'Steel Almirah',07),
(212, 'Wooden Stool', 120),
(213, 'Book Racks M.S', 09),
(214, 'Library Chair',30),
(215, 'Library Table', 05),
(216, 'Steel Almirah(with single lock)', 14),
(217, '4 Seater Steel Dual Desk',78),
(218, 'Green Board', 03);

-- Insert random values into 'teachers' table
INSERT INTO teacherstable VALUES
('C01', 'Dr.Shabeen Taj.G.A', 'CSE'),
('C02', 'Dr.Vasanth G', 'CSE'),
('C03', 'Harsharani K S', 'CSE'),
('C04', 'Prathibha t', 'CSE'),
('C05', 'Chethan K C', 'CSE'),
('C06', 'Komala KV', 'CSE'),
('M01', 'Dr.Madhu', 'ME'),
('M02', 'Dr.Mahendra Mani G', 'ME'),
('M03', 'Dr.Irappa Hunagund', 'ME'),
('M04', 'Mahesh A', 'ME'),
('M05', 'Sadananda Mageri', 'ME'),
('M06', 'Dr.H.N Girish', 'ME'),
('M07', 'Muniraju', 'ME'),
('M08', 'Santhosh Gonagunaki', 'ME'),
('M09', 'Usha R', 'ME'),
('M10', 'Dr.Bharath L', 'ME'),
('M11', 'Sunitha V', 'ME'),
('CV01','Mahesh Prabhu K', 'CV'),
('CV02','PK Ravindra', 'CV'),
('CV03','Venkatramaiah G', 'CV'),
('CV04','Sathyanarayana', 'CV'),
('CV05','Dr.Jyothi TK', 'CV'),
('CV06','Shanmukha NT', 'CV'),
('CV07','Tejaswini G', 'CV'),
('CV08','Bhagyashree P', 'CV'),
('CV09','Kavitha V', 'CV'),
('CV10','Jayasimha N', 'CV'),
('CV11','Shwetha J', 'CV'),
('E01','Imran Khan', 'ECE'),
('E02','Sumithra CV', 'ECE'),
('E03','Hemanth Kumar CS', 'ECE'),
('E04','Prathibha S', 'ECE'),
('E05','Nagaraju TA', 'ECE'),
('E06','Umesha HS', 'ECE'),
('E07','Ambika N', 'ECE'),
('E08','Channegowda', 'ECE'),
('E09','Deepa VP', 'ECE'),
('E10','Noor Fathima', 'ECE'),
('E11','Jai Prakash', 'ECE'),
('E12','KV Manjunath', 'ECE'),
('N01','Veena HM', 'NES'),
('N02','Dr.Chandrappa KG', 'NES'),
('N03','Dr.G Pundarika', 'NES'),
('N04','Kiran Kumar BE', 'NES'),
('N05','Venkatesh Murthy', 'NES'),
('N06','KT Prasanna Kumar', 'NES'),
('N07','BK Nirmala', 'NES'),
('N08','Mohammed Abrar Shah', 'NES'),
('N09','Siddaraju NG', 'NES'),
('N10','Manju M', 'NES'),
('N11','DS Honnamma', 'NES'),
('N12','Mallikarjun l', 'NES'),
('N13','Prasad Saliyan', 'NES');


-- Insert random values into 'usage' table
BEGIN;

CREATE TABLE usagetable (
    kg_id VARCHAR(10),
    teachers_name VARCHAR(255),
    Department_name VARCHAR(255),
    furniture_id INT,
    furniture_name VARCHAR(255),
    furniture_quantity INT
);

INSERT INTO usagetable VALUES
('C02', 'Dr.Vasanth', 'CSE', 206, 'Staff Table', 3),
('C02', 'Dr.Vasanth', 'CSE', 212, 'Wooden Stool', 1),
('C02', 'Dr.Vasanth', 'CSE', 210, 'Computer Table', 1),
('C02', 'Dr.Vasanth', 'CSE', 214, 'Plastic Chair', 4),
('C02', 'Dr.Vasanth', 'CSE', 214, 'Metal Chair', 1),
('C02', 'Dr.Vasanth', 'CSE', 216, 'Almirah', 3),
('C02', 'Dr.Vasanth', 'CSE', 209, 'Computer Chair', 1),
('C06', 'Komala KV', 'CSE', 206, 'Staff Table', 3),
('C06', 'Komala KV', 'CSE', 214, 'Plastic Chair', 1),
('C06', 'Komala KV', 'CSE', 214, 'Metal Chair', 3),
('C06', 'Komala KV', 'CSE', 216, 'Almirah', 2),
('C06', 'Komala KV', 'CSE', 212, 'Wooden Stool', 2),
('C05', 'Chethan K C', 'CSE', 206, 'Staff Table', 3),
('C05', 'Chethan K C', 'CSE', 210, 'Computer Table', 2),
('C05', 'Chethan K C', 'CSE', 212, 'Wooden Stool', 5),
('C05', 'Chethan K C', 'CSE', 214, 'Plastic Chair', 2),
('C05', 'Chethan K C', 'CSE', 209, 'Computer Chair', 1),
('C05', 'Chethan K C', 'CSE', 216, 'Almirah', 1),
('C05', 'Chethan K C', 'CSE', 201, 'Steel Dual Desk', 1),
('M05', 'Sadhananda Mageri', 'ME', 206, 'Staff Table', 3),
('M05', 'Sadhananda Mageri', 'ME', 212, 'Wooden Stool', 2),
('M05', 'Sadhananda Mageri', 'ME', 214, 'Metal Chair', 2),
('M05', 'Sadhananda Mageri', 'ME', 216, 'Almirah', 1),
('M05', 'Sadhananda Mageri', 'ME', 209, 'Computer Chair', 1),
('M04', 'Mahesha A', 'ME', 210, 'Computer Table', 2),
('M04', 'Mahesha A', 'ME', 201, 'Steel Dual Desk', 2),
('M04', 'Mahesha A', 'ME', 210, 'Computer Table', 2),
('M04', 'Mahesha A', 'ME', 212, 'Wooden Stool', 1),
('M04', 'Mahesha A', 'ME', 210, 'Computer Table', 2),
('M04', 'Mahesha A', 'ME', 214, 'Metal Chair', 1),
('M04', 'Mahesha A', 'ME', 216, 'Almirah', 1), 
('CV02', 'PK Ravindra', 'CV', 206, 'Staff Table', 1),
('CV02', 'PK Ravindra', 'CV', 214, 'Metal Chair', 1),
('CV02', 'PK Ravindra', 'CV', 216, 'Almirah', 1),
('CV02', 'PK Ravindra', 'CV', 206, 'Plastic Chair', 1),
('CV02', 'PK Ravindra', 'CV', 214, 'Computer Chair', 1),
('CV01', 'Mahesh Prabhu K', 'CV', 206, 'Staff Table', 1),
('CV01', 'Mahesh Prabhu K', 'CV', 210, 'Computer Table', 1),
('CV01', 'Mahesh Prabhu K', 'CV', 212, 'Wooden Stool', 2),
('E01', 'Dr.Imran Khan', 'ECE', 206, 'Staff Table', 1),
('E01', 'Dr.Imran Khan', 'ECE', 212, 'Wooden Stool', 3),
('E01', 'Dr.Imran Khan', 'ECE', 201, 'Steel Dual Desk', 1),
('E01', 'Dr.Imran Khan', 'ECE', 216, 'Almirah', 3),
('E01', 'Dr.Imran Khan', 'ECE', 215, 'Library Table', 1),
('E01', 'Dr.Imran Khan', 'ECE', 213, 'Book Rack MS', 1),
('E01', 'Dr.Imran Khan', 'ECE', 214, 'Computer Chair', 1),
('E05', 'Nagaraju TA', 'ECE', 206, 'Staff Table', 2),
('E05', 'Nagaraju TA', 'ECE', 210, 'Computer Table', 1),
('E05', 'Nagaraju TA', 'ECE', 217, '4 Seater Steel Dual Desk', 3),
('E05', 'Nagaraju TA', 'ECE', 201, 'Steel Dual Desk', 2),
('E05', 'Nagaraju TA', 'ECE', 214, 'Metal Chair', 1),
('E05', 'Nagaraju TA', 'ECE', 214, 'Plastic Chair', 1),
('E05', 'Nagaraju TA', 'ECE', 216, 'Almirah', 1),
('N13', 'Prasad Saliyan', 'NES', 206, 'Staff Table', 1),
('N13', 'Prasad Saliyan', 'NES', 210, 'Computer Table', 1),
('N13', 'Prasad Saliyan', 'NES', 212, 'Wooden Stool', 2),
('N13', 'Prasad Saliyan', 'NES', 214, 'Plastic Chair', 1),
('N13', 'Prasad Saliyan', 'NES', 214, 'Metal Chair', 2),
('N13', 'Prasad Saliyan', 'NES', 216, 'Almirah', 1),
('N13', 'Prasad Saliyan', 'NES', 201, 'Steel Dual Desk', 1);

COMMIT;

