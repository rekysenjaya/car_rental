--
-- Database: `carrentaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE cars
(
    id serial NOT NULL,
    type character varying(15),
    brand character varying(15),
    year integer NOT NULL,
    color character varying(15),
    plate character varying(15),
    CONSTRAINT cars_pkey PRIMARY KEY (id)
);

--
-- Dumping data for table `cars`
--

INSERT INTO cars (type, brand, year, color, plate) VALUES
('Jazz', 'Honda', 2011, 'Red', 'D 1234 H');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE client
(
    id serial NOT NULL,
    name character varying(25),
    gender character varying(15),
    CONSTRAINT client_pkey PRIMARY KEY (id)
);

--
-- Dumping data for table `client`
--

INSERT INTO client (name, gender) VALUES
('Alimin', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE rentals
(
    id serial NOT NULL,
    "car-id" integer NOT NULL,
    "client-id" integer NOT NULL,
    "date-from" date NOT NULL,
    "date-to" date NOT NULL,
    CONSTRAINT rentals_pkey PRIMARY KEY (id)
);

--
-- Dumping data for table `rentals`
--

INSERT INTO rentals("car-id", "client-id", "date-from", "date-to") VALUES
(1, 1, '2016-08-16', '2016-08-19'),
(1, 1, '2016-08-14', '2016-09-16');

-- --------------------------------------------------------
