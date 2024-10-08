-- Create the compsci store database. Customer and Countries layout taken from assignments two and three, products based on content from a2/3. 
DROP DATABASE IF EXISTS compsci_store_database;
CREATE DATABASE compsci_store_database;
USE compsci_store_database;

CREATE TABLE products (
    productCode varchar(10) NOT NULL,
    name varchar(50) NOT NULL,
    description varchar(1000) NOT NULL,
    price decimal(10,2) NOT NULL,
    image varchar(50) NOT NULL,
    PRIMARY KEY (productCode)
);

INSERT INTO products VALUES 
('BIGCOFF', 'Industrial Strength Coffee Machine', 
    'This is an industrial-strength coffee machine, designed by Dwarvish mechanics from Finland using magical steel and special 
    tungsten-reinforced carbon nanotube components capable of withstanding the coffee consumption needs of the average computer 
    science student. Please not that students with especially high coffee consumption needs may need to purchase extra internal 
    reinforcement components in order to get through their degree.',
    1999.99, 'coffeeMachine.png'),
('COFFUPGR', 'Coffee Machine Reinforcement', 
    'For students with higher than average coffee consumption. These components will allow your extra-large industrial strength 
    coffee machine to stand up to heavier use than normal, and are made from dragon scales and genuine necron skin. Please do not 
    allow these components to come into contact with ichor or fall into the hands of skaven or orks.',
    550.99, 'upgrades.png'),
('COFFBEAN', 'Extra-Strength Coffee Beans', 
    'Please do not ask what makes them extra strength. Side effects may include racing heart, laser eyes, sore feet, and spontaneous
    atomic disintegration. Please do not consume before attempting to cast magic spells or utilize alien archaeotech.',
    9.99, 'beans.png'),
('LMTLSS', 'Limitless Pill', 
    'I did not watch the movie but I think this pill makes you smart or something. Idk.',
    99.99, 'limitless.png'),
('DEODOR', 'Personal Hygeine Kit', 
    'There is a stereotype that computer science students do not smell nice. Please help fight this stereotype by washing yourself. 
    Includes Toothpaste, Soap, Shampoo, Toothbrush, Floss, Deodorant, and a Haircomb.',
    19.99, 'deodorant.png'),
('RBRDCK', 'Rubber Duck', 
    'A Rubber Duck. For use in Rubber Duck Debugging, a debugging technique where you talk to your plastic toy and pretend computer 
    programming has not driven you insane. Also doubles as a fun bath buddy for use with our hygeine kit.',
    3.99, 'duckie.png'),
('SPCMLG', 'The Spice Melange', 
    '25g container of the spice melange. Do not ask us where we got it. Side affects may include blue eyes, hallucinations, and visions of 
    the future. May attract sandworms.',
    99.99, 'spice.png'),
('WTRLFE', 'The Water of Life', 
    'Fresh taken from a sandworm submerged in a cool, fresh Arrakeen qanat. Consumption may be dangerous, please consult local Bene Gesserit
    Reverend Mother before consumption. DO NOT consume while pregnant or breastfeeding. Side effects may include posession by evil ancestors, 
    godlike prescient abilities, and death.',
    999.99, 'spicewater.png'),
('TPROBE', 'T-Probe', 
    'If you read far enough into the dune novels, this gives a old guy named Miles some super crazy speed powers. Also increases appetite.',
    99.99, 'tprobe.png'),
('ADVIL', 'Extra-Strength Advil', 
    'Extra-strength advil. Is sitting in a chair all day making your back sore? No way, humans were TOTALLY meant to work like this :) ',
    9.99, 'advil.png'),
('CMPNDV', 'Compound V', 
    'The stuff that gives you super powers in the tv show the boys. Lots of superpower drugs on this website eh? Good thing this is not 
    a real website or this would be highly unethical and probably SUPER illegal :)',
    9.99, 'compoundv.png');

CREATE TABLE customers (
    customerID int NOT NULL AUTO_INCREMENT,
    email varchar(50) NOT NULL UNIQUE,
    firstName varchar(50) NOT NULL,
    lastName varchar(50) NOT NULL,
    address varchar(50) NOT NULL,
    city varchar(50) NOT NULL,
    state varchar(50) NOT NULL,
    postalCode varchar(20) NOT NULL,
    countryCode char(2) NOT NULL,
    phone varchar(20) NOT NULL,
    password varchar(20) NOT NULL,
    PRIMARY KEY (customerID)
);

INSERT INTO customers VALUES 
(1001, 'examplo@example.com', 'Examplo', 'Exampleson', '123 Fake Street', 'Toronto', 'ON', '123ABC', 'CA', '(123) 456-7890', 'sesame'),
(1002, 'exampelle@example.com', 'Exampelle', 'Exampleson', '123 Fake Street', 'Toronto', 'ON', '123ABC', 'CA', '(123) 456-7890', 'sesame');

-- Deleted customer table 
CREATE TABLE deletedCustomers (
    customerID int NOT NULL,
    email varchar(50) NOT NULL,
    firstName varchar(50) NOT NULL,
    lastName varchar(50) NOT NULL,
    address varchar(50) NOT NULL,
    city varchar(50) NOT NULL,
    state varchar(50) NOT NULL,
    postalCode varchar(20) NOT NULL,
    countryCode char(2) NOT NULL,
    phone varchar(20) NOT NULL,
    password varchar(20) NOT NULL,
    PRIMARY KEY (customerID)
);

-- Past orders table 
CREATE TABLE orders(
    orderID int NOT NULL AUTO_INCREMENT,
    customerID int NOT NULL,
    contents varchar (100000) NOT NULL,
    price decimal (65,2) NOT NULL,
    taxedPrice decimal (65,2) NOT NULL,
    orderDate datetime NOT NULL,
    address varchar(50) NOT NULL,
    city varchar(50) NOT NULL,
    state varchar(50) NOT NULL,
    postalCode varchar(20) NOT NULL,
    countryCode char(2) NOT NULL,
    name varchar(100) NOT NULL,
    PRIMARY KEY (orderID)
);

INSERT INTO orders VALUES
(101, 1001, "1 x The Spice Melange <br>", 99.99 , 112.99 , '2012-12-12 11:23:32' ,'123 Fake Street', 'Toronto', 'ON', '123ABC', 'CA', 'Examplo Exampleson'),
(102, 1001, "1 x Industrial Strength Coffee Machine <br> 1 x Coffee Machine Reinforcement", 2550.98 , 2882.61 , '2013-10-12 11:23:32' ,'123 Fake Street', 'Toronto', 'ON', '123ABC', 'CA', 'Examplo Exampleson');

-- Countries list, borrowed from the files given in assignments two and three.
CREATE TABLE countries (
    countryCode char(2) NOT NULL,
    countryName varchar(20) NOT NULL,
    PRIMARY KEY (countryCode)
);
INSERT INTO countries VALUES
('AF', 'Afghanistan'), 
('AX', 'Aland Islands'), 
('AL', 'Albania'), 
('DZ', 'Algeria'), 
('AS', 'American Samoa'), 
('AD', 'Andorra'), 
('AO', 'Angola'), 
('AI', 'Anguilla'), 
('AQ', 'Antarctica'), 
('AG', 'Antigua and Barbuda'), 
('AR', 'Argentina'), 
('AM', 'Armenia'), 
('AW', 'Aruba'), 
('AU', 'Australia'), 
('AT', 'Austria'), 
('AZ', 'Azerbaijan'), 
('BS', 'Bahamas, The'), 
('BH', 'Bahrain'), 
('BD', 'Bangladesh'), 
('BB', 'Barbados'), 
('BY', 'Belarus'), 
('BE', 'Belgium'), 
('BZ', 'Belize'), 
('BJ', 'Benin'), 
('BM', 'Bermuda'), 
('BT', 'Bhutan'), 
('BO', 'Bolivia'), 
('BA', 'Bosnia and Herzegovina'), 
('BW', 'Botswana'), 
('BV', 'Bouvet Island'), 
('BR', 'Brazil'), 
('IO', 'British Indian Ocean Territory'), 
('BN', 'Brunei Darussalam'), 
('BG', 'Bulgaria'), 
('BF', 'Burkina Faso'), 
('BI', 'Burundi'), 
('KH', 'Cambodia'), 
('CM', 'Cameroon'), 
('CA', 'Canada'), 
('CV', 'Cape Verde'), 
('KY', 'Cayman Islands'), 
('CF', 'Central African Republic'), 
('TD', 'Chad'), 
('CL', 'Chile'), 
('CN', 'China'), 
('CX', 'Christmas Island'), 
('CC', 'Cocos (Keeling) Islands'), 
('CO', 'Colombia'), 
('KM', 'Comoros'), 
('CG', 'Congo'), 
('CD', 'Congo, The Democratic Republic Of The'), 
('CK', 'Cook Islands'), 
('CR', 'Costa Rica'), 
('CI', 'Cote D''ivoire'), 
('HR', 'Croatia'), 
('CY', 'Cyprus'), 
('CZ', 'Czech Republic'), 
('DK', 'Denmark'), 
('DJ', 'Djibouti'), 
('DM', 'Dominica'), 
('DO', 'Dominican Republic'), 
('EC', 'Ecuador'), 
('EG', 'Egypt'), 
('SV', 'El Salvador'), 
('GQ', 'Equatorial Guinea'), 
('ER', 'Eritrea'), 
('EE', 'Estonia'), 
('ET', 'Ethiopia'), 
('FK', 'Falkland Islands - Malvinas'), 
('FO', 'Faroe Islands'), 
('FJ', 'Fiji'), 
('FI', 'Finland'), 
('FR', 'France'), 
('GF', 'French Guiana'), 
('PF', 'French Polynesia'), 
('TF', 'French Southern Territories'), 
('GA', 'Gabon'), 
('GM', 'Gambia, The'), 
('GE', 'Georgia'), 
('DE', 'Germany'), 
('GH', 'Ghana'), 
('GI', 'Gibraltar'), 
('GR', 'Greece'), 
('GL', 'Greenland'), 
('GD', 'Grenada'), 
('GP', 'Guadeloupe'), 
('GU', 'Guam'), 
('GT', 'Guatemala'), 
('GG', 'Guernsey'), 
('GN', 'Guinea'), 
('GW', 'Guinea-Bissau'), 
('GY', 'Guyana'), 
('HT', 'Haiti'), 
('HM', 'Heard Island and the McDonald Islands'), 
('VA', 'Holy See'), 
('HN', 'Honduras'), 
('HK', 'Hong Kong'), 
('HU', 'Hungary'), 
('IS', 'Iceland'), 
('IN', 'India'), 
('ID', 'Indonesia'), 
('IQ', 'Iraq'), 
('IE', 'Ireland'), 
('IM', 'Isle Of Man'), 
('IL', 'Israel'), 
('IT', 'Italy'), 
('JM', 'Jamaica'), 
('JP', 'Japan'), 
('JE', 'Jersey'), 
('JO', 'Jordan'), 
('KZ', 'Kazakhstan'), 
('KE', 'Kenya'), 
('KI', 'Kiribati'), 
('KR', 'Korea, Republic Of'), 
('KW', 'Kuwait'), 
('KG', 'Kyrgyzstan'), 
('LA', 'Lao People''s Democratic Republic'), 
('LV', 'Latvia'), 
('LB', 'Lebanon'), 
('LS', 'Lesotho'), 
('LR', 'Liberia'), 
('LY', 'Libya'), 
('LI', 'Liechtenstein'), 
('LT', 'Lithuania'), 
('LU', 'Luxembourg'), 
('MO', 'Macao'), 
('MK', 'Macedonia, The Former Yugoslav Republic Of'), 
('MG', 'Madagascar'), 
('MW', 'Malawi'), 
('MY', 'Malaysia'), 
('MV', 'Maldives'), 
('ML', 'Mali'), 
('MT', 'Malta'), 
('MH', 'Marshall Islands'), 
('MQ', 'Martinique'), 
('MR', 'Mauritania'), 
('MU', 'Mauritius'), 
('YT', 'Mayotte'), 
('MX', 'Mexico'), 
('FM', 'Micronesia, Federated States Of'), 
('MD', 'Moldova, Republic Of'), 
('MC', 'Monaco'), 
('MN', 'Mongolia'), 
('ME', 'Montenegro'), 
('MS', 'Montserrat'), 
('MA', 'Morocco'), 
('MZ', 'Mozambique'), 
('MM', 'Myanmar'), 
('NA', 'Namibia'), 
('NR', 'Nauru'), 
('NP', 'Nepal'), 
('NL', 'Netherlands'), 
('AN', 'Netherlands Antilles'), 
('NC', 'New Caledonia'), 
('NZ', 'New Zealand'), 
('NI', 'Nicaragua'), 
('NE', 'Niger'), 
('NG', 'Nigeria'), 
('NU', 'Niue'), 
('NF', 'Norfolk Island'), 
('MP', 'Northern Mariana Islands'), 
('NO', 'Norway'), 
('OM', 'Oman'), 
('PK', 'Pakistan'), 
('PW', 'Palau'), 
('PS', 'Palestinian Territories'), 
('PA', 'Panama'), 
('PG', 'Papua New Guinea'), 
('PY', 'Paraguay'), 
('PE', 'Peru'), 
('PH', 'Philippines'), 
('PN', 'Pitcairn'), 
('PL', 'Poland'), 
('PT', 'Portugal'), 
('PR', 'Puerto Rico'), 
('QA', 'Qatar'), 
('RE', 'Reunion'), 
('RO', 'Romania'), 
('RU', 'Russian Federation'), 
('RW', 'Rwanda'), 
('BL', 'Saint Barthelemy'), 
('SH', 'Saint Helena'), 
('KN', 'Saint Kitts and Nevis'), 
('LC', 'Saint Lucia'), 
('MF', 'Saint Martin'), 
('PM', 'Saint Pierre and Miquelon'), 
('VC', 'Saint Vincent and The Grenadines'), 
('WS', 'Samoa'), 
('SM', 'San Marino'), 
('ST', 'Sao Tome and Principe'), 
('SA', 'Saudi Arabia'), 
('SN', 'Senegal'), 
('RS', 'Serbia'), 
('SC', 'Seychelles'), 
('SL', 'Sierra Leone'), 
('SG', 'Singapore'), 
('SK', 'Slovakia'), 
('SI', 'Slovenia'), 
('SB', 'Solomon Islands'), 
('SO', 'Somalia'), 
('ZA', 'South Africa'), 
('GS', 'South Georgia and the South Sandwich Islands'), 
('ES', 'Spain'), 
('LK', 'Sri Lanka'), 
('SR', 'Suriname'), 
('SJ', 'Svalbard and Jan Mayen'), 
('SZ', 'Swaziland'), 
('SE', 'Sweden'), 
('CH', 'Switzerland'), 
('TW', 'Taiwan'), 
('TJ', 'Tajikistan'), 
('TZ', 'Tanzania, United Republic Of'), 
('TH', 'Thailand'), 
('TL', 'Timor-leste'), 
('TG', 'Togo'), 
('TK', 'Tokelau'), 
('TO', 'Tonga'), 
('TT', 'Trinidad and Tobago'), 
('TN', 'Tunisia'), 
('TR', 'Turkey'), 
('TM', 'Turkmenistan'), 
('TC', 'Turks and Caicos Islands'), 
('TV', 'Tuvalu'), 
('UG', 'Uganda'), 
('UA', 'Ukraine'), 
('AE', 'United Arab Emirates'), 
('GB', 'United Kingdom'), 
('US', 'United States'), 
('UM', 'United States Minor Outlying Islands'), 
('UY', 'Uruguay'), 
('UZ', 'Uzbekistan'), 
('VU', 'Vanuatu'), 
('VE', 'Venezuela'), 
('VN', 'Vietnam'), 
('VG', 'Virgin Islands, British'), 
('VI', 'Virgin Islands, U.S.'), 
('WF', 'Wallis and Futuna'), 
('EH', 'Western Sahara'), 
('YE', 'Yemen'), 
('ZM', 'Zambia'), 
('ZW', 'Zimbabwe');

-- Create a user named ts_user
GRANT SELECT, INSERT, UPDATE, DELETE
ON *
TO css_internal@localhost
IDENTIFIED BY 'PaulAtreides1998';