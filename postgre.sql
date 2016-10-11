--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.9
-- Dumped by pg_dump version 9.3.9
-- Started on 2016-09-08 13:44:22

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 176 (class 3079 OID 11750)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 1964 (class 0 OID 0)
-- Dependencies: 176
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 171 (class 1259 OID 118063)
-- Name: cars; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cars (
    id integer NOT NULL,
    type character varying(15),
    brand character varying(15),
    year integer NOT NULL,
    color character varying(15),
    plate character varying(15)
);


ALTER TABLE public.cars OWNER TO postgres;

--
-- TOC entry 170 (class 1259 OID 118061)
-- Name: cars_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cars_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cars_id_seq OWNER TO postgres;

--
-- TOC entry 1965 (class 0 OID 0)
-- Dependencies: 170
-- Name: cars_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cars_id_seq OWNED BY cars.id;


--
-- TOC entry 173 (class 1259 OID 118071)
-- Name: client; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE client (
    id integer NOT NULL,
    name character varying(25),
    gender character varying(15)
);


ALTER TABLE public.client OWNER TO postgres;

--
-- TOC entry 172 (class 1259 OID 118069)
-- Name: client_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE client_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.client_id_seq OWNER TO postgres;

--
-- TOC entry 1966 (class 0 OID 0)
-- Dependencies: 172
-- Name: client_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE client_id_seq OWNED BY client.id;


--
-- TOC entry 175 (class 1259 OID 118079)
-- Name: rentals; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE rentals (
    id integer NOT NULL,
    "car-id" integer NOT NULL,
    "client-id" integer NOT NULL,
    "date-from" date NOT NULL,
    "date-to" date NOT NULL
);


ALTER TABLE public.rentals OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 118077)
-- Name: rentals_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rentals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rentals_id_seq OWNER TO postgres;

--
-- TOC entry 1967 (class 0 OID 0)
-- Dependencies: 174
-- Name: rentals_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rentals_id_seq OWNED BY rentals.id;


--
-- TOC entry 1835 (class 2604 OID 118066)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cars ALTER COLUMN id SET DEFAULT nextval('cars_id_seq'::regclass);


--
-- TOC entry 1836 (class 2604 OID 118074)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY client ALTER COLUMN id SET DEFAULT nextval('client_id_seq'::regclass);


--
-- TOC entry 1837 (class 2604 OID 118082)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rentals ALTER COLUMN id SET DEFAULT nextval('rentals_id_seq'::regclass);


--
-- TOC entry 1952 (class 0 OID 118063)
-- Dependencies: 171
-- Data for Name: cars; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO cars (id, type, brand, year, color, plate) VALUES (1, 'Jazz', 'Honda', 2011, 'Red', 'D 1234 H');


--
-- TOC entry 1968 (class 0 OID 0)
-- Dependencies: 170
-- Name: cars_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cars_id_seq', 1, true);


--
-- TOC entry 1954 (class 0 OID 118071)
-- Dependencies: 173
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO client (id, name, gender) VALUES (1, 'Alimin', 'Male');


--
-- TOC entry 1969 (class 0 OID 0)
-- Dependencies: 172
-- Name: client_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('client_id_seq', 1, true);


--
-- TOC entry 1956 (class 0 OID 118079)
-- Dependencies: 175
-- Data for Name: rentals; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO rentals (id, "car-id", "client-id", "date-from", "date-to") VALUES (1, 1, 1, '2016-08-16', '2016-08-19');
INSERT INTO rentals (id, "car-id", "client-id", "date-from", "date-to") VALUES (2, 1, 1, '2016-08-14', '2016-09-16');
INSERT INTO rentals (id, "car-id", "client-id", "date-from", "date-to") VALUES (3, 1, 2, '2016-08-20', '2016-08-22');


--
-- TOC entry 1970 (class 0 OID 0)
-- Dependencies: 174
-- Name: rentals_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rentals_id_seq', 3, true);


--
-- TOC entry 1839 (class 2606 OID 118068)
-- Name: cars_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cars
    ADD CONSTRAINT cars_pkey PRIMARY KEY (id);


--
-- TOC entry 1841 (class 2606 OID 118076)
-- Name: client_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id);


--
-- TOC entry 1843 (class 2606 OID 118084)
-- Name: rentals_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rentals
    ADD CONSTRAINT rentals_pkey PRIMARY KEY (id);


--
-- TOC entry 1963 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2016-09-08 13:44:23

--
-- PostgreSQL database dump complete
--

