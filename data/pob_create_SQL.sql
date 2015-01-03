-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 21, 2011 at 01:57 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `xth_8767702_inmosys_db`
--
DROP DATABASE IF EXISTS `xth_8767702_inmosys_db`;
CREATE DATABASE `xth_8767702_inmosys_db` DEFAULT CHARACTER SET utf8;
USE `xth_8767702_inmosys_db`;

-- --------------------------------------------------------

--
-- Table structure for table `cambios_contrato`
--

DROP TABLE IF EXISTS `cambios_contrato`;
CREATE TABLE IF NOT EXISTS `cambios_contrato` (
  `camb_con_num` int(11) NOT NULL AUTO_INCREMENT,
  `camb_con_fec` datetime NOT NULL,
  `camb_con_ant_cli` varchar(15) NOT NULL,
  `camb_con_new_cli` varchar(15) NOT NULL,
  `camb_con_est_ant` tinyint(1) NOT NULL,
  `camb_con_est_new` tinyint(1) NOT NULL,
  `fk_contrato_con_num` int(10) unsigned NOT NULL,
  PRIMARY KEY (`camb_con_num`),
  KEY `fk_Cambios_Contrato_contrato1` (`fk_contrato_con_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cambios_contrato`
--

INSERT INTO `cambios_contrato` (`camb_con_num`, `camb_con_fec`, `camb_con_ant_cli`, `camb_con_new_cli`, `camb_con_est_ant`, `camb_con_est_new`, `fk_contrato_con_num`) VALUES
(1, '2011-11-10 23:49:19', '1234567891', '1072639455', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cambios_inmueble`
--

DROP TABLE IF EXISTS `cambios_inmueble`;
CREATE TABLE IF NOT EXISTS `cambios_inmueble` (
  `camb_inm_num` int(11) NOT NULL AUTO_INCREMENT,
  `camb_inm_tip` tinyint(1) NOT NULL,
  `camb_inm_fec` datetime NOT NULL,
  `camb_inm_est_new` tinyint(1) NOT NULL,
  `camb_inm_est_old` tinyint(1) NOT NULL,
  `fk_camb_inm_num` int(11) NOT NULL,
  PRIMARY KEY (`camb_inm_num`),
  KEY `fk_cambios_inmueble_inmueble1` (`fk_camb_inm_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cambios_inmueble`
--

INSERT INTO `cambios_inmueble` (`camb_inm_num`, `camb_inm_tip`, `camb_inm_fec`, `camb_inm_est_new`, `camb_inm_est_old`, `fk_camb_inm_num`) VALUES
(1, 1, '2011-11-10 23:01:22', 0, 1, 3),
(2, 0, '2011-11-10 23:53:23', 0, 0, 3),
(3, 1, '2011-11-10 23:55:10', 1, 0, 3),
(4, 1, '2011-11-14 14:45:08', 0, 1, 3),
(5, 1, '2011-11-14 16:48:15', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE IF NOT EXISTS `ciudad` (
  `ciu_num` int(10) unsigned NOT NULL,
  `ciu_nom` varchar(25) NOT NULL,
  `fk_dep_num` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ciu_num`),
  KEY `fk_ciudad_departamento1` (`fk_dep_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ciudad`
--

INSERT INTO `ciudad` (`ciu_num`, `ciu_nom`, `fk_dep_num`) VALUES
(1, 'Bogota, D.', 1),
(2, 'Medellin', 2),
(3, 'Bello', 2),
(4, 'Itagui', 2),
(5, 'Envigado', 2),
(6, 'Apartado', 2),
(7, 'Turbo', 2),
(8, 'Rionegro', 2),
(9, 'Caucasia', 2),
(10, 'Caldas', 2),
(11, 'Copacabana', 2),
(12, 'Chigorodo', 2),
(13, 'La Estrell', 2),
(14, 'Necocli', 2),
(15, 'La Ceja', 2),
(16, 'El Bagre', 2),
(17, 'Marinilla', 2),
(18, 'Sabaneta', 2),
(19, 'Carepa', 2),
(20, 'Girardota', 2),
(21, 'Barbosa', 2),
(22, 'Andes', 2),
(23, 'Yarumal', 2),
(24, 'El Carmen ', 2),
(25, 'Guarne', 2),
(26, 'Puerto Ber', 2),
(27, 'Urrao', 2),
(28, 'Sonson', 2),
(29, 'Segovia', 2),
(30, 'Taraza', 2),
(31, 'Santa Rosa', 2),
(32, 'Arboletes', 2),
(33, 'Caceres', 2),
(34, 'San Pedro ', 2),
(35, 'Ciudad Bol', 2),
(36, 'Amaga', 2),
(37, 'Zaragoza', 2),
(38, 'El Santuar', 2),
(39, 'Ituango', 2),
(40, 'Dabeiba', 2),
(41, 'Santa Barb', 2),
(42, 'Santafe de', 2),
(43, 'Remedios', 2),
(44, 'Fredonia', 2),
(45, 'San Pedro', 2),
(46, 'Concordia', 2),
(47, 'San Juan d', 2),
(48, 'Nechi', 2),
(49, 'Amalfi', 2),
(50, 'Abejorral', 2),
(51, 'Frontino', 2),
(52, 'Yolombo', 2),
(53, 'San Vicent', 2),
(54, 'Salgar', 2),
(55, 'San Roque', 2),
(56, 'La Union', 2),
(57, 'Don Matias', 2),
(58, 'Valdivia', 2),
(59, 'Retiro', 2),
(60, 'Cañasgorda', 2),
(61, 'Betulia', 2),
(62, 'Puerto Nar', 2),
(63, 'Mutata1', 2),
(64, 'Tamesis', 2),
(65, 'Puerto Tri', 2),
(66, 'Peñol', 2),
(67, 'San Carlos', 2),
(68, 'Nariño', 2),
(69, 'Cocorna', 2),
(70, 'Yondo', 2),
(71, 'Anori', 2),
(72, 'Jardin', 2),
(73, 'San Rafael', 2),
(74, 'Venecia', 2),
(75, 'Sopetran', 2),
(76, 'Titiribi', 2),
(77, 'Jerico', 2),
(78, 'Angostura', 2),
(79, 'Ebejico', 2),
(80, 'San Jeroni', 2),
(81, 'Santo Domi', 2),
(82, 'Vegachi', 2),
(83, 'Gomez Plat', 2),
(84, 'San Luis', 2),
(85, 'Betania', 2),
(86, 'Argelia', 2),
(87, 'Granada', 2),
(88, 'Campamento', 2),
(89, 'Cisneros', 2),
(90, 'Peque', 2),
(91, 'Liborina', 2),
(92, 'Briceño', 2),
(93, 'Entrerrios', 2),
(94, 'Uramita', 2),
(95, 'Pueblorric', 2),
(96, 'Sabanalarg', 2),
(97, 'Yali', 2),
(98, 'Caicedo', 2),
(99, 'Angelopoli', 2),
(100, 'Maceo', 2),
(101, 'Montebello', 2),
(102, 'Anza', 2),
(103, 'San Andres', 2),
(104, 'Tarso', 2),
(105, 'La Pintada', 2),
(106, 'Buritica', 2),
(107, 'Heliconia', 2),
(108, 'San Franci', 2),
(109, 'Valparaiso', 2),
(110, 'Guadalupe', 2),
(111, 'Belmira', 2),
(112, 'Guatape', 2),
(113, 'Toledo', 2),
(114, 'Caramanta', 2),
(115, 'Vigia del ', 2),
(116, 'Armenia', 2),
(117, 'Caracoli', 2),
(118, 'Hispania', 2),
(119, 'Concepcion', 2),
(120, 'Giraldo', 2),
(121, 'Carolina', 2),
(122, 'Alejandria', 2),
(123, 'Murindo', 2),
(124, 'San Jose d', 2),
(125, 'Olaya', 2),
(126, 'Abriaqui', 2),
(127, 'Cali', 3),
(128, 'Buenaventu', 3),
(129, 'Palmira', 3),
(130, 'Tulua', 3),
(131, 'Cartago', 3),
(132, 'Guadalajar', 3),
(133, 'Jamundi', 3),
(134, 'Yumbo', 3),
(135, 'Candelaria', 3),
(136, 'Florida', 3),
(137, 'El Cerrito', 3),
(138, 'Pradera', 3),
(139, 'Sevilla', 3),
(140, 'Zarzal', 3),
(141, 'Dagua', 3),
(142, 'Roldanillo', 3),
(143, 'Guacari', 3),
(144, 'La Union', 3),
(145, 'Caicedonia', 3),
(146, 'Bugalagran', 3),
(147, 'Ansermanue', 3),
(148, 'Ginebra', 3),
(149, 'Trujillo', 3),
(150, 'Andalucia', 3),
(151, 'Alcala', 3),
(152, 'Riofrio', 3),
(153, 'Toro', 3),
(154, 'Restrepo', 3),
(155, 'San Pedro', 3),
(156, 'Yotoco', 3),
(157, 'Calima', 3),
(158, 'Bolivar', 3),
(159, 'Obando', 3),
(160, 'La Victori', 3),
(161, 'La Cumbre', 3),
(162, 'El aguila', 3),
(163, 'Vijes', 3),
(164, 'El Dovio', 3),
(165, 'El Cairo', 3),
(166, 'Versalles', 3),
(167, 'Argelia', 3),
(168, 'Ulloa', 3),
(169, 'Soacha', 4),
(170, 'Fusagasuga', 4),
(171, 'Facatativa', 4),
(172, 'Zipaquira', 4),
(173, 'Chia', 4),
(174, 'Girardot', 4),
(175, 'Mosquera', 4),
(176, 'Madrid', 4),
(177, 'Funza', 4),
(178, 'Cajica', 4),
(179, 'Villa de S', 4),
(180, 'Guaduas', 4),
(181, 'Sibate', 4),
(182, 'La Mesa', 4),
(183, 'Pacho', 4),
(184, 'Villeta', 4),
(185, 'Tocancipa', 4),
(186, 'La Calera', 4),
(187, 'Silvania', 4),
(188, 'Sopo', 4),
(189, 'Tabio', 4),
(190, 'El Colegio', 4),
(191, 'Cota', 4),
(192, 'Choconta', 4),
(193, 'Tenjo', 4),
(194, 'Cogua', 4),
(195, 'Tocaima', 4),
(196, 'Villapinzo', 4),
(197, 'Caparrapi', 4),
(198, 'Caqueza', 4),
(199, 'Yacopi', 4),
(200, 'Puerto Sal', 4),
(201, 'Suesca', 4),
(202, 'Nilo', 4),
(203, 'Viota', 4),
(204, 'El Rosal', 4),
(205, 'Anolaima', 4),
(206, 'La Vega', 4),
(207, 'Subachoque', 4),
(208, 'Guasca', 4),
(209, 'San Antoni', 4),
(210, 'Fomeque', 4),
(211, 'Ubala', 4),
(212, 'Agua de Di', 4),
(213, 'Arbelaez', 4),
(214, 'Guacheta', 4),
(215, 'Anapoima', 4),
(216, 'Nemocon', 4),
(217, 'Choachi', 4),
(218, 'Pasca', 4),
(219, 'Simijaca', 4),
(220, 'Gachancipa', 4),
(221, 'Gacheta', 4),
(222, 'San Bernar', 4),
(223, 'Sasaima', 4),
(224, 'Cachipay', 4),
(225, 'La Palma', 4),
(226, 'Medina', 4),
(227, 'Sesquile', 4),
(228, 'San Juan d', 4),
(229, 'Susa', 4),
(230, 'Lenguazaqu', 4),
(231, 'Bojaca', 4),
(232, 'Carmen de ', 4),
(233, 'Junin', 4),
(234, 'Chipaque', 4),
(235, 'San Franci', 4),
(236, 'Quipile', 4),
(237, 'Ricaurte', 4),
(238, 'Une', 4),
(239, 'Apulo', 4),
(240, 'Nocaima', 4),
(241, 'Vergara', 4),
(242, 'Tausa', 4),
(243, 'Tena', 4),
(244, 'Paratebuen', 4),
(245, 'Cucunuba', 4),
(246, 'La Peña', 4),
(247, 'Ubaque', 4),
(248, 'Granada', 4),
(249, 'Macheta', 4),
(250, 'Guatavita', 4),
(251, 'Fosca', 4),
(252, 'Quetame', 4),
(253, 'Alban', 4),
(254, 'Gachala', 4),
(255, 'Nimaima', 4),
(256, 'Paime', 4),
(257, 'Pandi', 4),
(258, 'San Cayeta', 4),
(259, 'Fuquene', 4),
(260, 'Zipacon', 4),
(261, 'El Peñon', 4),
(262, 'Supata', 4),
(263, 'utica', 4),
(264, 'Tibacuy', 4),
(265, 'Topaipi', 4),
(266, 'Guayabetal', 4),
(267, 'Sutatausa', 4),
(268, 'Quebradane', 4),
(269, 'Cabrera', 4),
(270, 'Manta', 4),
(271, 'Viani', 4),
(272, 'Chaguani', 4),
(273, 'Venecia', 4),
(274, 'Gama', 4),
(275, 'Guayabal d', 4),
(276, 'Gutierrez', 4),
(277, 'Tibirita', 4),
(278, 'Puli', 4),
(279, 'Jerusalen', 4),
(280, 'Bituima', 4),
(281, 'Guataqui', 4),
(282, 'Villagomez', 4),
(283, 'Nariño', 4),
(284, 'Beltran', 4),
(285, 'Barranquil', 5),
(286, 'Soledad', 5),
(287, 'Malambo', 5),
(288, 'Sabanalarg', 5),
(289, 'Baranoa', 5),
(290, 'Galapa', 5),
(291, 'Puerto Col', 5),
(292, 'Sabanagran', 5),
(293, 'Santo Toma', 5),
(294, 'Palmar de ', 5),
(295, 'Luruaco', 5),
(296, 'Repelon', 5),
(297, 'Campo de L', 5),
(298, 'Ponedera', 5),
(299, 'Juan de Ac', 5),
(300, 'Polonuevo', 5),
(301, 'Manati', 5),
(302, 'Santa Luci', 5),
(303, 'Candelaria', 5),
(304, 'Tubara', 5),
(305, 'Suan', 5),
(306, 'Usiacuri', 5),
(307, 'Piojo', 5),
(308, 'Bucaramang', 6),
(309, 'Floridabla', 6),
(310, 'Barrancabe', 6),
(311, 'Giron', 6),
(312, 'Piedecuest', 6),
(313, 'San Gil', 6),
(314, 'Cimitarra', 6),
(315, 'San Vicent', 6),
(316, 'Puerto Wil', 6),
(317, 'Lebrija', 6),
(318, 'Rionegro', 6),
(319, 'Socorro', 6),
(320, 'Barbosa', 6),
(321, 'Sabana de ', 6),
(322, 'Velez', 6),
(323, 'Malaga', 6),
(324, 'El Carmen ', 6),
(325, 'Landazuri', 6),
(326, 'Puente Nac', 6),
(327, 'Bolivar', 6),
(328, 'El Playon', 6),
(329, 'Curiti', 6),
(330, 'Charala', 6),
(331, 'Oiba', 6),
(332, 'Los Santos', 6),
(333, 'Suaita', 6),
(334, 'Mogotes', 6),
(335, 'San Andres', 6),
(336, 'Zapatoca', 6),
(337, 'Sucre', 6),
(338, 'Simacota', 6),
(339, 'La Belleza', 6),
(340, 'Aratoca', 6),
(341, 'Barichara', 6),
(342, 'Coromoro', 6),
(343, 'Villanueva', 6),
(344, 'Guaca', 6),
(345, 'Tona', 6),
(346, 'Puerto Par', 6),
(347, 'Florian', 6),
(348, 'Cerrito', 6),
(349, 'Capitanejo', 6),
(350, 'Concepcion', 6),
(351, 'Matanza', 6),
(352, 'Molagavita', 6),
(353, 'Onzaga', 6),
(354, 'La Paz', 6),
(355, 'El Peñon', 6),
(356, 'Guadalupe', 6),
(357, 'Betulia', 6),
(358, 'Valle de S', 6),
(359, 'Carcasi', 6),
(360, 'Gambita', 6),
(361, 'Chipata', 6),
(362, 'Ocamonte', 6),
(363, 'San Jose d', 6),
(364, 'Albania', 6),
(365, 'Santa Hele', 6),
(366, 'Pinchote', 6),
(367, 'Guavata', 6),
(368, 'Güepsa', 6),
(369, 'Contrataci', 6),
(370, 'Enciso', 6),
(371, 'San Benito', 6),
(372, 'Paramo', 6),
(373, 'Surata', 6),
(374, 'Jesus Mari', 6),
(375, 'Chima', 6),
(376, 'Charta', 6),
(377, 'Galan', 6),
(378, 'San Joaqui', 6),
(379, 'Palmar', 6),
(380, 'Confines', 6),
(381, 'Macaravita', 6),
(382, 'Encino', 6),
(383, 'San Miguel', 6),
(384, 'Palmas del', 6),
(385, 'Hato', 6),
(386, 'Vetas', 6),
(387, 'Santa Barb', 6),
(388, 'El Guacama', 6),
(389, 'Guapota', 6),
(390, 'Aguada', 6),
(391, 'Cepita', 6),
(392, 'Cabrera', 6),
(393, 'California', 6),
(394, 'Jordan', 6),
(395, 'Cartagena', 7),
(396, 'Magangue', 7),
(397, 'El Carmen ', 7),
(398, 'Turbaco', 7),
(399, 'Arjona', 7),
(400, 'Maria La B', 7),
(401, 'Mompos', 7),
(402, 'Santa Rosa', 7),
(403, 'San Juan N', 7),
(404, 'San Pablo', 7),
(405, 'Mahates', 7),
(406, 'Pinillos', 7),
(407, 'San Jacint', 7),
(408, 'Rio Viejo', 7),
(409, 'Calamar', 7),
(410, 'Achi', 7),
(411, 'Tiquisio', 7),
(412, 'Morales', 7),
(413, 'Simiti', 7),
(414, 'Santa Rosa', 7),
(415, 'Villanueva', 7),
(416, 'Montecrist', 7),
(417, 'Arenal', 7),
(418, 'San Estani', 7),
(419, 'Barranco d', 7),
(420, 'San Martin', 7),
(421, 'Turbana', 7),
(422, 'Cordoba', 7),
(423, 'San Fernan', 7),
(424, 'Santa Cata', 7),
(425, 'Clemencia', 7),
(426, 'Hatillo de', 7),
(427, 'Altos del ', 7),
(428, 'Zambrano', 7),
(429, 'Cicuco', 7),
(430, 'Talaigua N', 7),
(431, 'San Jacint', 7),
(432, 'Margarita', 7),
(433, 'Arroyohond', 7),
(434, 'Regidor', 7),
(435, 'Soplavient', 7),
(436, 'El Guamo', 7),
(437, 'Cantagallo', 7),
(438, 'El Peñon', 7),
(439, 'San Cristo', 7),
(440, 'Pasto', 8),
(441, 'San Andres', 8),
(442, 'Ipiales', 8),
(443, 'Samaniego', 8),
(444, 'Tuquerres', 8),
(445, 'Cumbal', 8),
(446, 'Barbacoas', 8),
(447, 'La Union', 8),
(448, 'Olaya Herr', 8),
(449, 'El Charco', 8),
(450, 'Sandona', 8),
(451, 'Buesaco', 8),
(452, 'Santacruz', 8),
(453, 'Alban', 8),
(454, 'Pupiales', 8),
(455, 'San Lorenz', 8),
(456, 'San Pablo', 8),
(457, 'La Cruz', 8),
(458, 'Taminango', 8),
(459, 'Roberto Pa', 8),
(460, 'Guachucal', 8),
(461, 'Magüi', 8),
(462, 'Los Andes', 8),
(463, 'Santa Barb', 8),
(464, 'Ricaurte', 8),
(465, 'San Bernar', 8),
(466, 'El Tambo', 8),
(467, 'El Tablon ', 8),
(468, 'Policarpa', 8),
(469, 'Guaitarill', 8),
(470, 'Cordoba', 8),
(471, 'Potosi', 8),
(472, 'Chachagüi', 8),
(473, 'Mosquera', 8),
(474, 'Linares', 8),
(475, 'Leiva', 8),
(476, 'Providenci', 8),
(477, 'Cumbitara', 8),
(478, 'La Florida', 8),
(479, 'El Rosario', 8),
(480, 'Francisco ', 8),
(481, 'Tangua', 8),
(482, 'Consaca', 8),
(483, 'Yacuanquer', 8),
(484, 'Colon', 8),
(485, 'Mallama', 8),
(486, 'Ancuya', 8),
(487, 'Puerres', 8),
(488, 'La Tola', 8),
(489, 'Ospina', 8),
(490, 'Cuaspud', 8),
(491, 'Iles', 8),
(492, 'Imues', 8),
(493, 'Sapuyes', 8),
(494, 'Arboleda', 8),
(495, 'San Pedro ', 8),
(496, 'Funes', 8),
(497, 'El Peñol', 8),
(498, 'Aldana', 8),
(499, 'Contadero', 8),
(500, 'Belen', 8),
(501, 'La Llanada', 8),
(502, 'Gualmatan', 8),
(503, 'Nariño', 8),
(504, 'Monteria', 9),
(505, 'Lorica', 9),
(506, 'Sahagun', 9),
(507, 'Cerete', 9),
(508, 'Tierralta', 9),
(509, 'Monteliban', 9),
(510, 'San Andres', 9),
(511, 'Planeta Ri', 9),
(512, 'Cienaga de', 9),
(513, 'Chinu', 9),
(514, 'Ayapel', 9),
(515, 'San Pelayo', 9),
(516, 'Puerto Lib', 9),
(517, 'Valencia', 9),
(518, 'Pueblo Nue', 9),
(519, 'San Bernar', 9),
(520, 'San Antero', 9),
(521, 'San Carlos', 9),
(522, 'Moñitos', 9),
(523, 'Puerto Esc', 9),
(524, 'Buenavista', 9),
(525, 'Los Cordob', 9),
(526, 'Canalete', 9),
(527, 'Cotorra', 9),
(528, 'Purisima', 9),
(529, 'Momil', 9),
(530, 'Chima', 9),
(531, 'La Apartad', 9),
(532, 'Ibague', 10),
(533, 'Espinal', 10),
(534, 'Chaparral', 10),
(535, 'Libano', 10),
(536, 'Guamo', 10),
(537, 'Ortega', 10),
(538, 'Mariquita', 10),
(539, 'Melgar', 10),
(540, 'Fresno', 10),
(541, 'Planadas', 10),
(542, 'Coyaima', 10),
(543, 'Flandes', 10),
(544, 'Purificaci', 10),
(545, 'Honda', 10),
(546, 'Rioblanco', 10),
(547, 'Natagaima', 10),
(548, 'Ataco', 10),
(549, 'Rovira', 10),
(550, 'Cajamarca', 10),
(551, 'Lerida', 10),
(552, 'San Luis', 10),
(553, 'Venadillo', 10),
(554, 'Anzoategui', 10),
(555, 'San Antoni', 10),
(556, 'Saldaña', 10),
(557, 'Armero', 10),
(558, 'Icononzo', 10),
(559, 'Villahermo', 10),
(560, 'Cunday', 10),
(561, 'Palocabild', 10),
(562, 'Falan', 10),
(563, 'Dolores', 10),
(564, 'Herveo', 10),
(565, 'Coello', 10),
(566, 'Alvarado', 10),
(567, 'Prado', 10),
(568, 'Carmen de ', 10),
(569, 'Ambalema', 10),
(570, 'Casabianca', 10),
(571, 'Santa Isab', 10),
(572, 'Roncesvall', 10),
(573, 'Villarrica', 10),
(574, 'Valle de S', 10),
(575, 'Piedras', 10),
(576, 'Alpujarra', 10),
(577, 'Murillo', 10),
(578, 'Suarez', 10),
(579, 'Popayan', 11),
(580, 'Santander ', 11),
(581, 'El Tambo', 11),
(582, 'Puerto Tej', 11),
(583, 'Bolivar', 11),
(584, 'La Vega', 11),
(585, 'Caloto', 11),
(586, 'Piendamo', 11),
(587, 'Cajibio', 11),
(588, 'Miranda', 11),
(589, 'Patia', 11),
(590, 'Paez', 11),
(591, 'Silvia', 11),
(592, 'Caldono', 11),
(593, 'Timbio', 11),
(594, 'Guapi', 11),
(595, 'Corinto', 11),
(596, 'Inza', 11),
(597, 'Buenos Air', 11),
(598, 'Toribio', 11),
(599, 'Argelia', 11),
(600, 'Morales', 11),
(601, 'Balboa', 11),
(602, 'Timbiqui', 11),
(603, 'Almaguer', 11),
(604, 'Lopez', 11),
(605, 'Suarez', 11),
(606, 'Mercaderes', 11),
(607, 'Totoro', 11),
(608, 'Sotara', 11),
(609, 'Purace', 11),
(610, 'Jambalo', 11),
(611, 'Villa Rica', 11),
(612, 'San Sebast', 11),
(613, 'Rosas', 11),
(614, 'La Sierra', 11),
(615, 'Santa Rosa', 11),
(616, 'Sucre', 11),
(617, 'Padilla', 11),
(618, 'Piamonte', 11),
(619, 'Florencia', 11),
(620, 'Tunja', 12),
(621, 'Sogamoso', 12),
(622, 'Duitama', 12),
(623, 'Chiquinqui', 12),
(624, 'Puerto Boy', 12),
(625, 'Paipa', 12),
(626, 'Moniquira', 12),
(627, 'Samaca', 12),
(628, 'Aquitania', 12),
(629, 'Garagoa', 12),
(630, 'Nobsa', 12),
(631, 'Ventaquema', 12),
(632, 'Santa Rosa', 12),
(633, 'Combita', 12),
(634, 'Saboya', 12),
(635, 'Tibasosa', 12),
(636, 'Raquira', 12),
(637, 'Villa de L', 12),
(638, 'San Pablo ', 12),
(639, 'Chita', 12),
(640, 'Ramiriqui', 12),
(641, 'Toca', 12),
(642, 'Otanche', 12),
(643, 'Pauna', 12),
(644, 'Socota', 12),
(645, 'Muzo', 12),
(646, 'Guateque', 12),
(647, 'Umbita', 12),
(648, 'Pesca', 12),
(649, 'Tibana', 12),
(650, 'Miraflores', 12),
(651, 'Soata', 12),
(652, 'Belen', 12),
(653, 'Tuta', 12),
(654, 'Sotaquira', 12),
(655, 'Siachoque', 12),
(656, 'Boavita', 12),
(657, 'Quipama', 12),
(658, 'Maripi', 12),
(659, 'Güican', 12),
(660, 'Santana', 12),
(661, 'Socha', 12),
(662, 'Turmeque', 12),
(663, 'Jenesano', 12),
(664, 'Tasco', 12),
(665, 'Motavita', 12),
(666, 'Chitaraque', 12),
(667, 'Cubara', 12),
(668, 'San Luis d', 12),
(669, 'Guayata', 12),
(670, 'Firavitoba', 12),
(671, 'Sutamarcha', 12),
(672, 'Nuevo Colo', 12),
(673, 'Chiquiza', 12),
(674, 'Soraca', 12),
(675, 'Buenavista', 12),
(676, 'San Jose d', 12),
(677, 'Tota', 12),
(678, 'Gameza', 12),
(679, 'El Cocuy', 12),
(680, 'Chiscas', 12),
(681, 'Labranzagr', 12),
(682, 'Mongua', 12),
(683, 'Paz de Rio', 12),
(684, 'Cienega', 12),
(685, 'Togüi', 12),
(686, 'Arcabuco', 12),
(687, 'Zetaquira', 12),
(688, 'Boyaca', 12),
(689, 'Chivata', 12),
(690, 'Mongui', 12),
(691, 'Floresta', 12),
(692, 'San Mateo', 12),
(693, 'Jerico', 12),
(694, 'Macanal', 12),
(695, 'Tenza', 12),
(696, 'Santa Mari', 12),
(697, 'San Miguel', 12),
(698, 'Cucaita', 12),
(699, 'Sutatenza', 12),
(700, 'Somondoco', 12),
(701, 'Cerinza', 12),
(702, 'Coper', 12),
(703, 'Campohermo', 12),
(704, 'Caldas', 12),
(705, 'El Espino', 12),
(706, 'Sachica', 12),
(707, 'Tipacoque', 12),
(708, 'Chinavita', 12),
(709, 'Susacon', 12),
(710, 'Topaga', 12),
(711, 'La Uvita', 12),
(712, 'Viracacha', 12),
(713, 'Paez', 12),
(714, 'Covarachia', 12),
(715, 'La Capilla', 12),
(716, 'Santa Sofi', 12),
(717, 'Pachavita', 12),
(718, 'Gachantiva', 12),
(719, 'Rondon', 12),
(720, 'Sora', 12),
(721, 'Tinjaca', 12),
(722, 'Oicata', 12),
(723, 'Sativanort', 12),
(724, 'Briceño', 12),
(725, 'Paya', 12),
(726, 'Corrales', 12),
(727, 'Beteitiva', 12),
(728, 'Pajarito', 12),
(729, 'Almeida', 12),
(730, 'Tutaza', 12),
(731, 'Chivor', 12),
(732, 'Guacamayas', 12),
(733, 'Iza', 12),
(734, 'Cuitiva', 12),
(735, 'San Eduard', 12),
(736, 'Berbeo', 12),
(737, 'Panqueba', 12),
(738, 'La Victori', 12),
(739, 'Tunungua', 12),
(740, 'Pisba', 12),
(741, 'Sativasur', 12),
(742, 'Busbanza', 12),
(743, 'Cucuta', 13),
(744, 'Ocaña', 13),
(745, 'Villa del ', 13),
(746, 'Los Patios', 13),
(747, 'Pamplona', 13),
(748, 'Tibu', 13),
(749, 'Abrego', 13),
(750, 'Sardinata', 13),
(751, 'El Zulia', 13),
(752, 'Teorama', 13),
(753, 'Toledo', 13),
(754, 'Convencion', 13),
(755, 'El Carmen', 13),
(756, 'Chinacota', 13),
(757, 'San Calixt', 13),
(758, 'La Esperan', 13),
(759, 'El Tarra', 13),
(760, 'Cachira', 13),
(761, 'Chitaga', 13),
(762, 'Hacari', 13),
(763, 'Salazar', 13),
(764, 'Arboledas', 13),
(765, 'Puerto San', 13),
(766, 'Cucutilla', 13),
(767, 'La Playa', 13),
(768, 'Ragonvalia', 13),
(769, 'Bochalema', 13),
(770, 'Gramalote', 13),
(771, 'Labateca', 13),
(772, 'Silos', 13),
(773, 'Villa Caro', 13),
(774, 'Pamplonita', 13),
(775, 'Bucarasica', 13),
(776, 'Herran', 13),
(777, 'San Cayeta', 13),
(778, 'Durania', 13),
(779, 'Mutiscua', 13),
(780, 'Lourdes', 13),
(781, 'Santiago', 13),
(782, 'Cacota', 13),
(783, 'Santa Mart', 14),
(784, 'Cienaga', 14),
(785, 'Zona Banan', 14),
(786, 'Fundacion', 14),
(787, 'El Banco', 14),
(788, 'Plato', 14),
(789, 'Pivijay', 14),
(790, 'Aracataca', 14),
(791, 'Ariguani', 14),
(792, 'Sitionuevo', 14),
(793, 'Guamal', 14),
(794, 'Puebloviej', 14),
(795, 'Santa Ana', 14),
(796, 'El Reten', 14),
(797, 'San Sebast', 14),
(798, 'El Piñon', 14),
(799, 'Chibolo', 14),
(800, 'Nueva Gran', 14),
(801, 'Sabanas de', 14),
(802, 'Pijiño del', 14),
(803, 'Tenerife', 14),
(804, 'Algarrobo', 14),
(805, 'Santa Barb', 14),
(806, 'Concordia', 14),
(807, 'San Zenon', 14),
(808, 'Remolino', 14),
(809, 'Zapayan', 14),
(810, 'Salamina', 14),
(811, 'Cerro San ', 14),
(812, 'Pedraza', 14),
(813, 'Neiva', 15),
(814, 'Pitalito', 15),
(815, 'Garzon', 15),
(816, 'La Plata', 15),
(817, 'Campoalegr', 15),
(818, 'San Agusti', 15),
(819, 'Gigante', 15),
(820, 'Palermo', 15),
(821, 'Acevedo', 15),
(822, 'Isnos', 15),
(823, 'Algeciras', 15),
(824, 'Timana', 15),
(825, 'Aipe', 15),
(826, 'Guadalupe', 15),
(827, 'Rivera', 15),
(828, 'Tarqui', 15),
(829, 'Suaza', 15),
(830, 'Tello', 15),
(831, 'Pital', 15),
(832, 'La Argenti', 15),
(833, 'Colombia', 15),
(834, 'Oporapa', 15),
(835, 'Iquira', 15),
(836, 'Palestina', 15),
(837, 'Saladoblan', 15),
(838, 'Santa Mari', 15),
(839, 'Baraya', 15),
(840, 'Tesalia', 15),
(841, 'Agrado', 15),
(842, 'Teruel', 15),
(843, 'Yaguara', 15),
(844, 'Villavieja', 15),
(845, 'Hobo', 15),
(846, 'Nataga', 15),
(847, 'Paicol', 15),
(848, 'Altamira', 15),
(849, 'Elias', 15),
(850, 'Manizales', 16),
(851, 'La Dorada', 16),
(852, 'Riosucio', 16),
(853, 'Chinchina', 16),
(854, 'Villamaria', 16),
(855, 'Anserma', 16),
(856, 'Neira', 16),
(857, 'Pensilvani', 16),
(858, 'Samana', 16),
(859, 'Manzanares', 16),
(860, 'Supia', 16),
(861, 'Aguadas', 16),
(862, 'Salamina', 16),
(863, 'Palestina', 16),
(864, 'Pacora', 16),
(865, 'Marquetali', 16),
(866, 'Viterbo', 16),
(867, 'Aranzazu', 16),
(868, 'Filadelfia', 16),
(869, 'Belalcazar', 16),
(870, 'Risaralda', 16),
(871, 'Victoria', 16),
(872, 'Marmato', 16),
(873, 'San Jose', 16),
(874, 'Norcasia', 16),
(875, 'La Merced', 16),
(876, 'Marulanda', 16),
(877, 'Valledupar', 17),
(878, 'Aguachica', 17),
(879, 'Agustin Co', 17),
(880, 'Chimichagu', 17),
(881, 'Bosconia', 17),
(882, 'Curumani', 17),
(883, 'El Copey', 17),
(884, 'Chiriguana', 17),
(885, 'La Jagua d', 17),
(886, 'La Paz', 17),
(887, 'El Paso', 17),
(888, 'San Albert', 17),
(889, 'Astrea', 17),
(890, 'San Martin', 17),
(891, 'Pueblo Bel', 17),
(892, 'Pelaya', 17),
(893, 'Pailitas', 17),
(894, 'La Gloria', 17),
(895, 'Gamarra', 17),
(896, 'Rio de Oro', 17),
(897, 'Tamalamequ', 17),
(898, 'Becerril', 17),
(899, 'San Diego', 17),
(900, 'Manaure', 17),
(901, 'Gonzalez', 17),
(902, 'Pereira', 18),
(903, 'Dosquebrad', 18),
(904, 'Santa Rosa', 18),
(905, 'Quinchia', 18),
(906, 'La Virgini', 18),
(907, 'Belen de U', 18),
(908, 'Marsella', 18),
(909, 'Apia', 18),
(910, 'Guatica', 18),
(911, 'Santuario', 18),
(912, 'Mistrato', 18),
(913, 'Pueblo Ric', 18),
(914, 'La Celia', 18),
(915, 'Balboa', 18),
(916, 'Villavicen', 19),
(917, 'Acacias', 19),
(918, 'Granada', 19),
(919, 'Puerto Lop', 19),
(920, 'La Macaren', 19),
(921, 'San Martin', 19),
(922, 'Vistahermo', 19),
(923, 'Puerto Ric', 19),
(924, 'Puerto Gai', 19),
(925, 'Cumaral', 19),
(926, 'Puerto Con', 19),
(927, 'Mapiripan', 19),
(928, 'Uribe', 19),
(929, 'Fuente de ', 19),
(930, 'Mesetas', 19),
(931, 'Puerto Lle', 19),
(932, 'Restrepo', 19),
(933, 'Lejanias', 19),
(934, 'San Juan d', 19),
(935, 'Guamal', 19),
(936, 'Castilla l', 19),
(937, 'El Castill', 19),
(938, 'San Carlos', 19),
(939, 'Cubarral', 19),
(940, 'Cabuyaro', 19),
(941, 'El Dorado', 19),
(942, 'Barranca d', 19),
(943, 'El Calvari', 19),
(944, 'San Juanit', 19),
(945, 'Sincelejo', 20),
(946, 'Corozal', 20),
(947, 'San Marcos', 20),
(948, 'San Onofre', 20),
(949, 'Sampues', 20),
(950, 'Majagual', 20),
(951, 'San Luis d', 20),
(952, 'Santiago d', 20),
(953, 'San Benito', 20),
(954, 'Sucre', 20),
(955, 'Ovejas', 20),
(956, 'Los Palmit', 20),
(957, 'Tolu Viejo', 20),
(958, 'Galeras', 20),
(959, 'San Pedro', 20),
(960, 'Guaranda', 20),
(961, 'Morroa', 20),
(962, 'San Juan d', 20),
(963, 'Palmito', 20),
(964, 'Coveñas', 20),
(965, 'Caimito', 20),
(966, 'La Union', 20),
(967, 'El Roble', 20),
(968, 'Buenavista', 20),
(969, 'Coloso', 20),
(970, 'Chalan', 20),
(971, 'Riohacha', 21),
(972, 'Maicao', 21),
(973, 'Uribia', 21),
(974, 'Manaure', 21),
(975, 'San Juan d', 21),
(976, 'Fonseca', 21),
(977, 'Barrancas', 21),
(978, 'Villanueva', 21),
(979, 'Dibulla', 21),
(980, 'Albania', 21),
(981, 'Hatonuevo', 21),
(982, 'Urumita', 21),
(983, 'Distraccio', 21),
(984, 'El Molino', 21),
(985, 'La Jagua d', 21),
(986, 'Armenia', 22),
(987, 'Calarca', 22),
(988, 'Montenegro', 22),
(989, 'Quimbaya', 22),
(990, 'La Tebaida', 22),
(991, 'Circasia', 22),
(992, 'Filandia', 22),
(993, 'Genova', 22),
(994, 'Salento', 22),
(995, 'Pijao', 22),
(996, 'Cordoba', 22),
(997, 'Buenavista', 22),
(998, 'Quibdo', 23),
(999, 'Alto Baudo', 23),
(1000, 'Istmina', 23),
(1001, 'Medio Atra', 23),
(1002, 'Tado', 23),
(1003, 'Bajo Baudo', 23),
(1004, 'Unguia', 23),
(1005, 'Riosucio1', 23),
(1006, 'Belen de B', 23),
(1007, 'Condoto', 23),
(1008, 'Medio San ', 23),
(1009, 'El Litoral', 23),
(1010, 'El Carmen ', 23),
(1011, 'Medio Baud', 23),
(1012, 'Acandi', 23),
(1013, 'Lloro', 23),
(1014, 'Bojaya', 23),
(1015, 'Certegui', 23),
(1016, 'Bahia Sola', 23),
(1017, 'Bagado', 23),
(1018, 'Union Pana', 23),
(1019, 'Rio Iro', 23),
(1020, 'Rio Quito2', 23),
(1021, 'Novita', 23),
(1022, 'Nuqui', 23),
(1023, 'Atrato', 23),
(1024, 'El Canton ', 23),
(1025, 'Carmen del', 23),
(1026, 'San Jose d', 23),
(1027, 'Jurado', 23),
(1028, 'Sipi', 23),
(1029, 'Florencia', 24),
(1030, 'San Vicent', 24),
(1031, 'Puerto Ric', 24),
(1032, 'Cartagena ', 24),
(1033, 'La Montañi', 24),
(1034, 'El Doncell', 24),
(1035, 'Solano', 24),
(1036, 'El Paujil', 24),
(1037, 'San Jose d', 24),
(1038, 'Milan', 24),
(1039, 'Curillo', 24),
(1040, 'Valparaiso', 24),
(1041, 'Belen de L', 24),
(1042, 'Solita', 24),
(1043, 'Albania', 24),
(1044, 'Morelia', 24),
(1045, 'Puerto Asi', 25),
(1046, 'Valle del ', 25),
(1047, 'Orito', 25),
(1048, 'Mocoa', 25),
(1049, 'Puerto Guz', 25),
(1050, 'San Miguel', 25),
(1051, 'Villagarzo', 25),
(1052, 'Leguizamo', 25),
(1053, 'Puerto Cai', 25),
(1054, 'Sibundoy', 25),
(1055, 'Santiago', 25),
(1056, 'San Franci', 25),
(1057, 'Colon', 25),
(1058, 'Yopal', 26),
(1059, 'Aguazul', 26),
(1060, 'Paz de Ari', 26),
(1061, 'Villanueva', 26),
(1062, 'Tauramena', 26),
(1063, 'Monterrey', 26),
(1064, 'Trinidad', 26),
(1065, 'Mani', 26),
(1066, 'Hato Coroz', 26),
(1067, 'Nunchia', 26),
(1068, 'Pore', 26),
(1069, 'Orocue', 26),
(1070, 'San Luis d', 26),
(1071, 'Tamara', 26),
(1072, 'Sabanalarg', 26),
(1073, 'Recetor', 26),
(1074, 'Chameza', 26),
(1075, 'Sacama', 26),
(1076, 'La Salina', 26),
(1077, 'Arauca', 27),
(1078, 'Tame', 27),
(1079, 'Saravena', 27),
(1080, 'Arauquita', 27),
(1081, 'Fortul', 27),
(1082, 'Puerto Ron', 27),
(1083, 'Cravo Nort', 27),
(1084, 'San Jose d', 28),
(1085, 'El Retorno', 28),
(1086, 'Miraflores', 28),
(1087, 'Calamar', 28),
(1088, 'San Andres', 29),
(1089, 'Providenci', 29),
(1090, 'Leticia', 30),
(1091, 'Puerto Nar', 30),
(1092, 'El Encanto', 30),
(1093, 'Tarapaca', 30),
(1094, 'La Pedrera', 30),
(1095, 'La Chorrer', 30),
(1096, 'Puerto San', 30),
(1097, 'Miriti - P', 30),
(1098, 'Puerto Ari', 30),
(1099, 'Puerto Ale', 30),
(1100, 'La Victori', 30),
(1101, 'Cumaribo', 31),
(1102, 'Puerto Car', 31),
(1103, 'La Primave', 31),
(1104, 'Santa Rosa', 31),
(1105, 'Mitu', 32),
(1106, 'Pacoa', 32),
(1107, 'Caruru', 32),
(1108, 'Yavarate', 32),
(1109, 'Taraira', 32),
(1110, 'Papunaua', 32),
(1111, 'Inirida', 33),
(1112, 'Barranco M', 33),
(1113, 'Puerto Col', 33),
(1114, 'Mapiripana', 33),
(1115, 'Pana Pana', 33),
(1116, 'Cacahual', 33),
(1117, 'San Felipe', 33),
(1118, 'Morichal', 33),
(1119, 'La Guadalu', 33),
(665541, 'SAO PABLO', 655),
(6622001, 'SALVADOR', 622);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `cli_ide` varchar(15) NOT NULL,
  `cli_nom` varchar(15) NOT NULL,
  `cli_tel` tinytext NOT NULL,
  `cli_cel` tinytext NOT NULL,
  `cli_cor_ele` varchar(40) NOT NULL,
  PRIMARY KEY (`cli_ide`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`cli_ide`, `cli_nom`, `cli_tel`, `cli_cel`, `cli_cor_ele`) VALUES
('1072639455', 'JUANITO', '4444444', '3134443322', 'acabra@optimizeit.co'),
('1234567891', 'PGC', '2958686', '3105847218', 'rramirez@pgc.edu.co'),
('830945930', 'INMOSYS S.A.S.', '3468800', '3153468800', 'info@inmosys.com'),
('85120753926', 'JUANCHITO', '8630909', '3134364735', 'jdavi.es@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cnatural`
--

DROP TABLE IF EXISTS `cnatural`;
CREATE TABLE IF NOT EXISTS `cnatural` (
  `nat_ape` varchar(15) NOT NULL,
  `nat_sex` char(1) NOT NULL,
  `nat_fec_nac` date NOT NULL,
  `fk_cli_ide` varchar(15) NOT NULL,
  KEY `fk_natural_cliente1` (`fk_cli_ide`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cnatural`
--

INSERT INTO `cnatural` (`nat_ape`, `nat_sex`, `nat_fec_nac`, `fk_cli_ide`) VALUES
('CASUAL', 'M', '1984-11-06', '1072639455'),
('PEREZ', 'M', '1986-11-06', '85120753926');

-- --------------------------------------------------------

--
-- Table structure for table `contrato`
--

DROP TABLE IF EXISTS `contrato`;
CREATE TABLE IF NOT EXISTS `contrato` (
  `con_num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `con_fec_ini_con` date NOT NULL,
  `con_fec_fin_con` date NOT NULL,
  `con_tip` tinyint(1) unsigned NOT NULL,
  `con_val` decimal(10,2) NOT NULL,
  `con_est` tinyint(1) NOT NULL DEFAULT '1',
  `fk_inm_num` int(11) NOT NULL,
  `fk_cli_ide` varchar(15) NOT NULL,
  `fk_con_usu_ide` varchar(15) DEFAULT '0',
  PRIMARY KEY (`con_num`),
  KEY `fk_contrato_inmueble1` (`fk_inm_num`),
  KEY `fk_contrato_cliente1` (`fk_cli_ide`),
  KEY `fk_contrato_usuario1` (`fk_con_usu_ide`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Triggers `contrato`
--
DROP TRIGGER IF EXISTS `xth_8767702_inmosys_db`.`contrato_actualizacion`;
DELIMITER //
CREATE TRIGGER `xth_8767702_inmosys_db`.`contrato_actualizacion` AFTER UPDATE ON `xth_8767702_inmosys_db`.`contrato`
 FOR EACH ROW BEGIN

		IF OLD.fk_cli_ide != NEW.fk_cli_ide THEN

			INSERT INTO cambios_contrato

			(camb_con_fec,camb_con_ant_cli,camb_con_new_cli,camb_con_est_ant,camb_con_est_new,fk_contrato_con_num)

			VALUES

			(NOW(), OLD.fk_cli_ide, NEW.fk_cli_ide,OLD.con_est,NEW.con_est, OLD.con_num);

		END IF;

	END
//
DELIMITER ;

--
-- Dumping data for table `contrato`
--

INSERT INTO `contrato` (`con_num`, `con_fec_ini_con`, `con_fec_fin_con`, `con_tip`, `con_val`, `con_est`, `fk_inm_num`, `fk_cli_ide`, `fk_con_usu_ide`) VALUES
(1, '2011-11-10', '2012-08-16', 2, '850.00', 0, 3, '1072639455', '0'),
(2, '2011-11-10', '2011-11-10', 1, '850.00', 0, 3, '85120753926', '0'),
(3, '2011-11-15', '2012-08-15', 2, '850.00', 1, 3, '1072639455', '0'),
(4, '2011-11-14', '2012-08-15', 2, '760.00', 1, 1, '1234567891', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `dep_num` int(10) unsigned NOT NULL,
  `dep_nom` varchar(25) NOT NULL,
  `fk_pai_num` int(10) unsigned NOT NULL,
  PRIMARY KEY (`dep_num`),
  KEY `fk_departamento_pais1` (`fk_pai_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departamento`
--

INSERT INTO `departamento` (`dep_num`, `dep_nom`, `fk_pai_num`) VALUES
(1, 'Bogota, D.C.', 8),
(2, 'Antioquia', 8),
(3, 'Valle Del Cauca', 8),
(4, 'Cundinamarca', 8),
(5, 'Atlantico', 8),
(6, 'Santander', 8),
(7, 'Bolivar', 8),
(8, 'Nariño', 8),
(9, 'Cordoba', 8),
(10, 'Tolima', 8),
(11, 'Cauca', 8),
(12, 'Boyaca', 8),
(13, 'Norte De Santan', 8),
(14, 'Magdalena', 8),
(15, 'Huila', 8),
(16, 'Caldas', 8),
(17, 'Cesar', 8),
(18, 'Risaralda', 8),
(19, 'Meta', 8),
(20, 'Sucre', 8),
(21, 'La Guajira', 8),
(22, 'Quindio', 8),
(23, 'Choco', 8),
(24, 'Caqueta', 8),
(25, 'Putumayo', 8),
(26, 'Casanare', 8),
(27, 'Arauca', 8),
(28, 'Guaviare', 8),
(29, 'Archipielago De', 8),
(30, 'Amazonas', 8),
(31, 'Vichada', 8),
(32, 'Vaupes', 8),
(33, 'Guainia', 8),
(622, 'BAHIA', 6),
(655, 'SAO PABLO', 6);

-- --------------------------------------------------------

--
-- Table structure for table `inmueble`
--

DROP TABLE IF EXISTS `inmueble`;
CREATE TABLE IF NOT EXISTS `inmueble` (
  `inm_num` int(11) NOT NULL AUTO_INCREMENT,
  `inm_num_mat` varchar(25) NOT NULL,
  `inm_mts_tot` decimal(7,2) NOT NULL,
  `inm_dir` varchar(45) NOT NULL,
  `inm_est` int(11) NOT NULL,
  `inm_num_ban` int(10) unsigned NOT NULL DEFAULT '0',
  `inm_num_pisos` int(10) unsigned NOT NULL DEFAULT '0',
  `inm_num_parq` int(2) unsigned NOT NULL DEFAULT '0',
  `inm_val_imp` decimal(10,2) NOT NULL,
  `inm_val_adm` decimal(10,2) NOT NULL,
  `inm_dis` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `inm_num_ven` int(10) unsigned NOT NULL DEFAULT '0',
  `inm_dat_adi` varchar(255) NOT NULL,
  `fk_id_tip_inm` int(10) unsigned NOT NULL,
  `fk_ciu_num` int(10) unsigned NOT NULL,
  PRIMARY KEY (`inm_num`),
  KEY `inm_num_mat_UNIQUE` (`inm_num_mat`),
  KEY `fk_inmueble_ciudad1` (`fk_ciu_num`),
  KEY `fk_inmueble_tipo_inmueble1` (`fk_id_tip_inm`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>' AUTO_INCREMENT=4 ;

--
-- Triggers `inmueble`
--
DROP TRIGGER IF EXISTS `xth_8767702_inmosys_db`.`inmueble_actualizacion`;
DELIMITER //
CREATE TRIGGER `xth_8767702_inmosys_db`.`inmueble_actualizacion` AFTER UPDATE ON `xth_8767702_inmosys_db`.`inmueble`
 FOR EACH ROW BEGIN

		IF OLD.inm_dis != NEW.inm_dis  THEN

			INSERT INTO cambios_inmueble

			(camb_inm_fec,camb_inm_tip,camb_inm_est_new,camb_inm_est_old,fk_camb_inm_num)

			VALUES

			(NOW(), 1,NEW.inm_dis, OLD.inm_dis, OLD.inm_num);

    ELSE

			INSERT INTO cambios_inmueble

			(camb_inm_fec,camb_inm_tip,camb_inm_est_new,camb_inm_est_old,fk_camb_inm_num)

			VALUES

			(NOW(), 0,NEW.inm_dis, OLD.inm_dis, OLD.inm_num);

		END IF;

	END
//
DELIMITER ;

--
-- Dumping data for table `inmueble`
--

INSERT INTO `inmueble` (`inm_num`, `inm_num_mat`, `inm_mts_tot`, `inm_dir`, `inm_est`, `inm_num_ban`, `inm_num_pisos`, `inm_num_parq`, `inm_val_imp`, `inm_val_adm`, `inm_dis`, `inm_num_ven`, `inm_dat_adi`, `fk_id_tip_inm`, `fk_ciu_num`) VALUES
(1, 'AAA000', '22.00', 'CL 17 NO. 3 -70 CA 52', 4, 2, 1, 1, '1500000.00', '120000.00', 0, 0, 'Casa en perfecto estado', 2, 173),
(2, 'AAA001', '100.25', 'AV. CARACAS NO. 14-13', 3, 0, 0, 0, '100000.00', '0.00', 1, 0, 'Lote en buen estado para construccion con cerca', 3, 1),
(3, 'A00E30212', '85.00', 'CL 21 NO. 4-85 E', 4, 4, 3, 2, '120000.00', '100000.00', 0, 1, 'Casa completa con todo para recreacion', 2, 173);

-- --------------------------------------------------------

--
-- Table structure for table `juridico`
--

DROP TABLE IF EXISTS `juridico`;
CREATE TABLE IF NOT EXISTS `juridico` (
  `jur_pag_web` varchar(50) DEFAULT NULL,
  `fk_cli_ide` varchar(15) NOT NULL,
  KEY `fk_juridico_cliente1` (`fk_cli_ide`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `juridico`
--

INSERT INTO `juridico` (`jur_pag_web`, `fk_cli_ide`) VALUES
('www.pgc.edu.co', '1234567891'),
('WWW.INMOSYS.COM', '830945930');

-- --------------------------------------------------------

--
-- Table structure for table `logusuarios`
--

DROP TABLE IF EXISTS `logusuarios`;
CREATE TABLE IF NOT EXISTS `logusuarios` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `nomusr_log` varchar(15) NOT NULL,
  `pwd_log` varchar(15) NOT NULL,
  `fecha_log` date NOT NULL,
  `hora_log` time NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `logusuarios`
--


-- --------------------------------------------------------

--
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
CREATE TABLE IF NOT EXISTS `pago` (
  `pag_num` int(11) NOT NULL AUTO_INCREMENT,
  `pag_tip_ser` tinyint(1) NOT NULL,
  `pag_val` decimal(10,2) NOT NULL,
  `pag_fec` datetime NOT NULL,
  `pag_num_cuo` int(11) NOT NULL COMMENT '	',
  `pag_desc` varchar(255) DEFAULT NULL,
  `fk_con_num` int(10) unsigned NOT NULL,
  `fk_cli_ide` varchar(15) NOT NULL,
  PRIMARY KEY (`pag_num`),
  KEY `fk_pagos_contrato1` (`fk_con_num`),
  KEY `fk_pagos_cliente1` (`fk_cli_ide`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pago`
--

INSERT INTO `pago` (`pag_num`, `pag_tip_ser`, `pag_val`, `pag_fec`, `pag_num_cuo`, `pag_desc`, `fk_con_num`, `fk_cli_ide`) VALUES
(1, 2, '850.00', '2011-11-15 01:31:28', 1, 'Se realiza pago', 3, '1072639455'),
(2, 2, '850.00', '2011-11-15 01:32:17', 2, 'Ejemplo', 3, '1072639455'),
(3, 2, '850.00', '2011-11-15 01:32:33', 3, 'Pago', 3, '1072639455'),
(5, 2, '760.00', '2011-11-15 01:44:26', 1, 'se realiza pago', 4, '1234567891');

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `pai_num` int(10) unsigned NOT NULL,
  `pai_nom` varchar(25) NOT NULL,
  PRIMARY KEY (`pai_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pais`
--

INSERT INTO `pais` (`pai_num`, `pai_nom`) VALUES
(1, 'Canada'),
(2, 'Estados Un'),
(3, 'Mexico'),
(4, 'Argentina'),
(5, 'Bolivia'),
(6, 'Brasil'),
(7, 'Chile'),
(8, 'Colombia'),
(9, 'Ecuador'),
(10, 'Guyana'),
(11, 'Paraguay'),
(12, 'Peru'),
(13, 'Surinam'),
(14, 'Uruguay'),
(15, 'Venezuela'),
(16, 'Afganistan'),
(17, 'Arabia Sau'),
(18, 'Armenia'),
(19, 'Azerbaiyan'),
(20, 'Barein'),
(21, 'Banglades'),
(22, 'Birmania'),
(23, 'Butan'),
(24, 'Brunei'),
(25, 'Camboya'),
(26, 'China'),
(27, 'Chipre'),
(28, 'Corea del '),
(29, 'Corea del '),
(30, 'Emiratos a'),
(31, 'Filipinas'),
(32, 'Georgia'),
(33, 'Indonesia'),
(34, 'India'),
(35, 'Iran'),
(36, 'Irak'),
(37, 'Israel'),
(38, 'Japon'),
(39, 'Jordania'),
(40, 'Kazajistan'),
(41, 'Kirguistan'),
(42, 'Kuwait'),
(43, 'Laos'),
(44, 'Libano'),
(45, 'Malasia'),
(46, 'Maldivas'),
(47, 'Mongolia'),
(48, 'Nepal'),
(49, 'Oman'),
(50, 'Pakistan'),
(51, 'Catar'),
(52, 'Rusia'),
(53, 'Singapur'),
(54, 'Siria'),
(55, 'Sri Lanka'),
(56, 'Tailandia'),
(57, 'Tayikistan'),
(58, 'Timor Orie'),
(59, 'Turkmenist'),
(60, 'Turquia'),
(61, 'Uzbekistan'),
(62, 'Vietnam'),
(63, 'Yemen'),
(64, 'Albania'),
(65, 'Alemania'),
(66, 'Andorra'),
(67, 'Armenia'),
(68, 'Austria'),
(69, 'Azerbaiyan'),
(70, 'Belgica'),
(71, 'Bielorrusi'),
(72, 'Bosnia y H'),
(73, 'Bulgaria'),
(74, 'Republica '),
(75, 'Chipre'),
(76, 'Ciudad del'),
(77, 'Croacia'),
(78, 'Dinamarca'),
(79, 'Eslovaquia'),
(80, 'Eslovenia'),
(81, 'España'),
(82, 'Estonia'),
(83, 'Finlandia'),
(84, 'Francia'),
(85, 'Georgia'),
(86, 'Grecia'),
(87, 'Hungria'),
(88, 'Irlanda'),
(89, 'Islandia'),
(90, 'Italia'),
(91, 'Letonia'),
(92, 'Liechtenst'),
(93, 'Lituania'),
(94, 'Luxemburgo'),
(95, 'Republica '),
(96, 'Malta'),
(97, 'Moldavia'),
(98, 'Monaco'),
(99, 'Montenegro'),
(100, 'Noruega'),
(101, 'Paises Baj'),
(102, 'Polonia'),
(103, 'Portugal'),
(104, 'Reino Unid'),
(105, 'Rumania'),
(106, 'Rusia'),
(107, 'San Marino'),
(108, 'Serbia'),
(109, 'Suecia'),
(110, 'Suiza'),
(111, 'Turquia'),
(112, 'Ucrania'),
(113, 'Angola'),
(114, 'Argelia'),
(115, 'Benin'),
(116, 'Botsuana'),
(117, 'Burkina Fa'),
(118, 'Burundi'),
(119, 'Cabo Verde'),
(120, 'Camerun'),
(121, 'Chad'),
(122, 'Comoras'),
(123, 'Congo'),
(124, 'Costa de M'),
(125, 'Egipto'),
(126, 'Eritrea'),
(127, 'Etiopia'),
(128, 'Gabon'),
(129, 'Gambia'),
(130, 'Ghana'),
(131, 'Guinea'),
(132, 'Guinea-Bis'),
(133, 'Guinea Ecu'),
(134, 'Kenia'),
(135, 'Lesoto'),
(136, 'Liberia'),
(137, 'Libia'),
(138, 'Madagascar'),
(139, 'Malaui'),
(140, 'Mali'),
(141, 'Marruecos'),
(142, 'Mauricio'),
(143, 'Mauritania'),
(144, 'Mozambique'),
(145, 'Namibia'),
(146, 'Niger'),
(147, 'Nigeria'),
(148, 'Republica '),
(149, 'Republica '),
(150, 'Republica '),
(151, 'Ruanda'),
(152, 'Santo Tome'),
(153, 'Senegal'),
(154, 'Seychelles'),
(155, 'Sierra Leo'),
(156, 'Somalia'),
(157, 'Somaliland'),
(158, 'Suazilandi'),
(159, 'Sudan del '),
(160, 'Sudafrica'),
(161, 'Sudan'),
(162, 'Tanzania'),
(163, 'Territorio'),
(164, 'Togo'),
(165, 'Tunez'),
(166, 'Uganda'),
(167, 'Yibuti'),
(168, 'Zambia'),
(169, 'Zimbabue'),
(170, 'Australia'),
(171, 'Fiyi'),
(172, 'Kiribati'),
(173, 'Islas Mars'),
(174, 'Micronesia'),
(175, 'Nauru'),
(176, 'Nueva Zela'),
(177, 'Palaos'),
(178, 'Papua Nuev'),
(179, 'Samoa'),
(180, 'Islas Salo'),
(181, 'Tonga'),
(182, 'Tuvalu'),
(183, 'Vanuatu'),
(184, 'Islas Geor'),
(185, 'Isla Bouve'),
(186, 'Islas Hear');

-- --------------------------------------------------------

--
-- Table structure for table `phpjobscheduler`
--

DROP TABLE IF EXISTS `phpjobscheduler`;
CREATE TABLE IF NOT EXISTS `phpjobscheduler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scriptpath` varchar(255) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `time_interval` int(11) DEFAULT NULL,
  `fire_time` int(11) NOT NULL DEFAULT '0',
  `time_last_fired` int(11) DEFAULT NULL,
  `run_only_once` tinyint(1) NOT NULL DEFAULT '0',
  `currently_running` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `phpjobscheduler`
--


-- --------------------------------------------------------

--
-- Table structure for table `phpjobscheduler_logs`
--

DROP TABLE IF EXISTS `phpjobscheduler_logs`;
CREATE TABLE IF NOT EXISTS `phpjobscheduler_logs` (
  `id` int(11) NOT NULL,
  `script` varchar(128) DEFAULT NULL,
  `output` text,
  `execution_time` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phpjobscheduler_logs`
--


-- --------------------------------------------------------

--
-- Table structure for table `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE IF NOT EXISTS `sucursal` (
  `suc_num` int(10) unsigned NOT NULL,
  `suc_nom` varchar(25) NOT NULL,
  `suc_dir` varchar(45) NOT NULL,
  `suc_tel` varchar(10) NOT NULL,
  `fk_ciu_num` int(10) unsigned NOT NULL,
  PRIMARY KEY (`suc_num`),
  KEY `fk_sucursal_ciudad1` (`fk_ciu_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sucursal`
--

INSERT INTO `sucursal` (`suc_num`, `suc_nom`, `suc_dir`, `suc_tel`, `fk_ciu_num`) VALUES
(1, 'Usaquen', 'Cll 142 f # 129 a 41', '6871897', 1),
(2, 'Chapinero', 'Cll. 16 n. 4-62', '2864266', 1),
(3, 'Santa Fe', 'Av. Caracas no 39-50', '2320106', 1),
(4, 'San Cristo', 'Calle 13 No 8a 30', '2320106', 1),
(5, 'Usme', 'Carrera 8 No. 17-30 ', '6051313', 1),
(6, 'Tunjuelito', 'Cll 122 # 15-21', '6203300 ', 1),
(7, 'Bosa', 'Cra 9 # 69 - 31', '3170100', 1),
(8, 'Kennedy', 'Carrera 7 con calle 24', '', 1),
(9, 'Fontibon', 'Cll 118 # 15-15', '4810587', 1),
(10, 'Engativa', 'Calle 63 No 10-83, piso 2', '2569600', 1),
(11, 'Suba', 'Cra. 14 n. 98-60', '6111185', 1),
(12, 'Barrios Un', 'Cra. 13 n. 63-39 locales 8 y 10', '6401338', 1),
(13, 'Teusaquill', 'Carrera 8a. No.17-30 piso 3 y 4', '2175570', 1),
(14, 'Los Martir', 'Cra. 11 b n. 98-48', '6167806', 1),
(15, 'Antonio Na', 'Cra 9 no 69a-81', '3106636', 1),
(16, 'Puente Ara', 'Cll. 13 n. 8-66 int. 12 y 13', '2825394', 1),
(17, 'La Candela', 'Cra 13 # 64-29', '6401313', 1),
(18, 'Rafael Uri', 'Carrera 13 # 60- 53 ', '2117616 ', 1),
(19, 'Ciudad Bol', 'Cra 13 # 27-94', '6067999', 1),
(20, 'Sumapaz', 'Calle 70 no. 8-27', '2102616 ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_inmueble`
--

DROP TABLE IF EXISTS `tipo_inmueble`;
CREATE TABLE IF NOT EXISTS `tipo_inmueble` (
  `id_tip_inm` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_tip_inm` varchar(15) NOT NULL,
  `desc_tip_inm` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tip_inm`),
  UNIQUE KEY `id_tipo_inm_UNIQUE` (`id_tip_inm`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tipo_inmueble`
--

INSERT INTO `tipo_inmueble` (`id_tip_inm`, `nom_tip_inm`, `desc_tip_inm`) VALUES
(2, 'Vivienda', 'Tipo vivienda en conjunto cerrado'),
(3, 'Lote', 'Lote destinado para construccion'),
(4, 'Bodega', 'Bodega tipo almacenamiento');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usrName` varchar(25) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usrName`, `pwd`) VALUES
(1, 'jzambrano', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'sromero', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'carlosetejada', '81dc9bdb52d04dc20036dbd8313ed055'),
(4, 'jrengifo', '81dc9bdb52d04dc20036dbd8313ed055'),
(5, 'arodriguez', '81dc9bdb52d04dc20036dbd8313ed055'),
(6, 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `usu_ide` varchar(15) NOT NULL,
  `usu_con` varchar(10) NOT NULL,
  `usu_est` bit(1) NOT NULL,
  `usu_nom` varchar(45) NOT NULL,
  `usu_ape` varchar(45) NOT NULL,
  `usu_sex` char(1) NOT NULL,
  `usu_fec_nac` date NOT NULL,
  `usu_fec_ing` date NOT NULL,
  `usu_tra_fin` int(10) unsigned NOT NULL,
  `usu_tip` int(10) unsigned NOT NULL,
  `usu_jef` varchar(15) DEFAULT NULL,
  `fk_suc_num` int(10) unsigned NOT NULL,
  PRIMARY KEY (`usu_ide`),
  KEY `usu_CC` (`usu_ide`),
  KEY `fk_usuario_sucursal1` (`fk_suc_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`usu_ide`, `usu_con`, `usu_est`, `usu_nom`, `usu_ape`, `usu_sex`, `usu_fec_nac`, `usu_fec_ing`, `usu_tra_fin`, `usu_tip`, `usu_jef`, `fk_suc_num`) VALUES
('0', '1234', b'1', 'INMOBILIARIA', 'INMOSYS', 'M', '1960-06-08', '2011-08-15', 3, 2, NULL, 1),
('1234567889', '1234', b'1', 'Pedrito', 'Perez', 'M', '1960-06-08', '2011-08-15', 0, 2, '1234567890', 1),
('1234567890', '1234', b'1', 'Pedro', 'Perez', 'M', '1960-06-09', '2011-08-15', 1, 2, NULL, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cambios_contrato`
--
ALTER TABLE `cambios_contrato`
  ADD CONSTRAINT `fk_Cambios_Contrato_contrato1` FOREIGN KEY (`fk_contrato_con_num`) REFERENCES `contrato` (`con_num`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cambios_inmueble`
--
ALTER TABLE `cambios_inmueble`
  ADD CONSTRAINT `fk_cambios_inmueble_inmueble1` FOREIGN KEY (`fk_camb_inm_num`) REFERENCES `inmueble` (`inm_num`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_ciudad_departamento1` FOREIGN KEY (`fk_dep_num`) REFERENCES `departamento` (`dep_num`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cnatural`
--
ALTER TABLE `cnatural`
  ADD CONSTRAINT `fk_natural_cliente1` FOREIGN KEY (`fk_cli_ide`) REFERENCES `cliente` (`cli_ide`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `fk_contrato_cliente1` FOREIGN KEY (`fk_cli_ide`) REFERENCES `cliente` (`cli_ide`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contrato_inmueble1` FOREIGN KEY (`fk_inm_num`) REFERENCES `inmueble` (`inm_num`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contrato_usuario1` FOREIGN KEY (`fk_con_usu_ide`) REFERENCES `usuario` (`usu_ide`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `fk_departamento_pais1` FOREIGN KEY (`fk_pai_num`) REFERENCES `pais` (`pai_num`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inmueble`
--
ALTER TABLE `inmueble`
  ADD CONSTRAINT `fk_inmueble_ciudad1` FOREIGN KEY (`fk_ciu_num`) REFERENCES `ciudad` (`ciu_num`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inmueble_tipo_inmueble1` FOREIGN KEY (`fk_id_tip_inm`) REFERENCES `tipo_inmueble` (`id_tip_inm`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `juridico`
--
ALTER TABLE `juridico`
  ADD CONSTRAINT `fk_juridico_cliente1` FOREIGN KEY (`fk_cli_ide`) REFERENCES `cliente` (`cli_ide`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_pagos_cliente1` FOREIGN KEY (`fk_cli_ide`) REFERENCES `cliente` (`cli_ide`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pagos_contrato1` FOREIGN KEY (`fk_con_num`) REFERENCES `contrato` (`con_num`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `fk_sucursal_ciudad1` FOREIGN KEY (`fk_ciu_num`) REFERENCES `ciudad` (`ciu_num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_sucursal1` FOREIGN KEY (`fk_suc_num`) REFERENCES `sucursal` (`suc_num`) ON DELETE NO ACTION ON UPDATE NO ACTION;
