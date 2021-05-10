-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-07-2019 a las 12:04:32
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `valknut`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

DROP TABLE IF EXISTS `articulos`;
CREATE TABLE IF NOT EXISTS `articulos` (
  `id_art` int(11) NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `contenido` longtext NOT NULL,
  PRIMARY KEY (`id_art`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_art`, `lugar`, `titulo`, `img`, `banner`, `autor`, `fecha`, `contenido`) VALUES
(1, 'Nepal', 'Nepal, tierra de titanes', 'img/blog/himalayas.jpg', 'img/blog/himalayas.jpg', '1', '2019-06-18 16:28:35', 'For many, stepping off a plane into Kathmandu is a pupil-dilating experience, a riot of sights, sounds and smells that can quickly lead to sensory overload. Whether you’re barrelling through the traffic-jammed alleyways of the old town in a rickshaw, marvelling at the medieval temples or dodging trekking touts in the backpacker district of Thamel, Kathmandu can be an intoxicating, amazing and exhausting place.<br><br>\r\nKathmandu’s Durbar Sq was where the city’s kings were once crowned and legitimised, and from where they ruled (durbar means palace). As such, the square remains the traditional heart of the old town and Kathmandu’s most spectacular legacy of traditional architecture. The square bore the brunt of Kathmandu\'s 2015 earthquake damage. <br><br>\r\nHalf a dozen temples collapsed, as did several towers in the Hanuman Dhoka palace complex, but it\'s still a fabulous complex. Reconstruction will continue for years. Although most of the square dates from the 17th and 18th centuries (many of the original buildings are much older), a great deal of rebuilding happened after the great earthquake of 1934. <br><br>\r\nThe entire square was designated a Unesco World Heritage Site in 1979. The Durbar Sq area is actually made up of three loosely linked squares. To the south is the open Basantapur Sq area, a former royal elephant stables that now houses souvenir stalls and off which runs Freak St. <br><br>\r\nThe main Durbar Sq area is to the west. Running northeast is a second part of Durbar Sq, which contains the entrance to the Hanuman Dhoka and an assortment of temples. From this open area Makhan Tole, at one time the main road in Kathmandu and still the most interesting street to walk down, continues northeast.'),
(2, 'Bhutan', 'Bhutan, la tierra del dragon', 'img/blog/thimphu2.jpg', 'img/blog/thimphu.jpg', '1', '2019-06-18 18:35:21', 'The \'Tiger\'s Nest Monastery\' is one of the Himalaya\'s most incredible sites, miraculously perched on the side of a sheer cliff 900m above the floor of Paro valley. Visiting is the goal of every visitor to Bhutan and while getting there involves a bit of uphill legwork, it\'s well worth the effort.<br><br>\r\nThe monastery is a sacred site, so act with respect. Bags, phones and cameras have to be deposited at the entrance, where your guide will register with the army. As you enter the complex you pass underneath images of the Rigsum Goempo (Jampelyang, Chenresig and Chana Dorje). Turn to the right and look for the relic stone; Bhutanese stand on the starting line, close their eyes and try to put their thumb into a small hole in the rock as a form of karmic test.<br><br>\r\nMost groups then visit the Dubkhang (Pelphu Lhakhang), the cave where Guru Rinpoche meditated for three months. Outside the cave is a statue of Dorje Drolo, the manifestation the guru assumed to fly to Taktshang on a tigress. The inner cave is sealed off behind a spectacularly gilded door and is said to hold the phurbu (ritual dagger) of the guru. Murals of the Guru Tsengye, or eight manifestations of Guru Rinpoche, decorate the walls. Behind you, sitting above the inside of the main entrance, is a mural of Thangtong Gyalpo holding his iron chains.<br><br>\r\nFrom here ascend to the Guru Sungjonma Lhakhang, which has a central image of Pema Jungme, another of the eight manifestations of Guru Rinpoche. This statue replaced a famous \'talking\' image that was lost in the 1998 fire. Various demonic animal-headed deities and manifestations of the deity Phurba decorate the walls alongside the 25 disciples of Guru Rinpoche, while outside is an image of the long-life protector Tseringma riding a snow lion.<br><br>\r\nThe next chapel on the left has connections to Dorje Phagmo, with a rock image of the goddess\' crown hidden in a hole in the floor. The inner chorten belongs to Langchen Pelgye Sengye, a 9th-century disciple of Guru Rinpoche, who meditated in the cave. Behind the chorten is a holy spring.<br><br>\r\nFurther on inside the complex, to the left, is the Drole Lhakhang, where the monks sell blessed lockets, while to the right is the Guru Tsengye Lhakhang, which features an image of the monastery\'s 17th-century founder, Gyelse Tenzin Rabgay. Look down through the glass into the bowels of a sacred cave. Further up is a butter-lamp chapel (light one for a donation). You can climb down into the original Tiger\'s Nest cave just above the chapel but take care as it\'s a dusty path down a hairy series of wooden ladders to descend into a giant slice of the cliff face.'),
(3, 'Dubai', 'Dubai, la ciudad del futuro', 'img/blog/dubai2.jpg', 'img/blog/desierto.jpg', '1', '2019-06-18 18:48:52', 'The Burj Khalifa is a stunning feat of architecture and engineering, with two observation decks on the 124th and 148th floors and a restaurant-bar on the 122nd. The world’s tallest building pierces the sky at 828m and opened in January 2010, six years after excavations began. <br><br>\r\nTo avoid wait times or expensive fast-track admission, book tickets online as far as 30 days in advance. Note that high humidity often cloaks Dubai in a dense haze, making views less than breathtaking.<br><br>\r\nIf you\'ve bought tickets to the first observation deck (called At the Top), you\'ll walk past multimedia exhibits chronicling the construction of the Burj before squeezing into a lift that whisks you to the 124th floor (452m) at a speed of 10m per second. <br><br>\r\nTo intensify the viewing experience, you can drop a few dirhams into a high-powered telescope, which not only zeroes in on modern-day Dubai but also simulates the same view at night and in the 1980s.<br><br>\r\nThe world\'s highest observation platform, though, is called At the Top Sky and is located at 555m on the 148th floor. You\'ll feel like a VIP upon being welcomed by a Guest Ambassador and treated to soft drinks, coffee and dates in a fancy lounge. Aside from the views, a highlight on this floor is an interactive screen where you \'fly\' to different city landmarks by hovering your hands over high-tech sensors. <br><br>\r\nThis is followed by a trip down to the 125th floor where another VR experience awaits: A Falcon\'s Eye View, which lets you see Dubai from a bird\'s-eye perspective.'),
(4, 'Egipto', 'Egipto y sus monumentos ancestrales', 'img/blog/egipto2.jpg', 'img/blog/cairo2.jpg', '1', '2019-06-18 19:05:23', 'Despite its dusty reputation, springtime in Cairo unleashes bursts of warmth and colour, from puffy oleander bushes to jacaranda trees shouting with purple blossoms. Sidewalks are shaded under blooming acacia trees, and Cairenes are happily shedding their winter coats and thick scarves for sandals and t-shirts. As the city reawakens, it’s the picture-perfect time for a visit.\r\n<br><br>\r\nIn 2019, the holy month of Ramadan falls in May through to the first week of June, which can make spring the best time to avoid Cairo’s notorious crowds and traffic. During Ramadan, the streets can seem sleepy during sunlight hours, but once twilight settles, the usual hum of the city cues up, with families rushing to pick up last-minute desserts on their way to one of the ubiquitous iftars, the evening meal that breaks the day’s fast. \r\n<br><br>\r\nDuring Ramadan, iftar and suhoor, or pre-dawn, meals encompass Egyptians’ entire social calendar. Try to squeeze in at least one iftar at a fancy hotel, such as the Wust El Balad Tent at the Ritz-Carlton (roughy LE300, about US$17.30), but they book out fast, so plan ahead. You’ll find more low-key roadside iftar tables spread around the city. If you don’t mind setting a 4am alarm, you can get up before the sun to join in a suhoor meal before the day’s fasting begins.\r\n<br><br>\r\nOld Cairo is home to a trove of historic wonders, from the 7th-century Hanging Church of Coptic Cairo to the millennium-old Mosque of Amr Ibn Al As. But within the Fustat area of Old Cairo stands Darb 1718, an outdoor contemporary art and culture centre that in springtime weather, is the perfect place to spend an afternoon. \r\n<br><br>\r\nThe centre hosts live music concerts, fashion, art exhibitions, open-mic nights and education workshops. This spring you can get your hands dirty with a pottery workshop and or learn about light refraction and shutter speed at a photography class. April’s hieroglyphics workshop is sure to be a hit.'),
(5, 'India', 'India y sus colores', 'img/blog/holi2.jpg', 'img/blog/holi2.jpg', '1', '2019-06-18 19:08:36', 'Poet Rabindranath Tagore described it as \'a teardrop on the cheek of eternity\'; Rudyard Kipling as \'the embodiment of all things pure\'; while its creator, Emperor Shah Jahan, said it made \'the sun and the moon shed tears from their eyes\'. Every year, tourists numbering more than twice the population of Agra pass through its gates to catch a once-in-a-lifetime glimpse of what is widely considered the most beautiful building in the world. Few leave disappointed. <br><br>\r\nThe Taj was built by Shah Jahan as a memorial for his third wife, Mumtaz Mahal, who died giving birth to their 14th child in 1631. The death of Mumtaz left the emperor so heartbroken that his hair is said to have turned grey virtually overnight. Construction of the Taj began the following year; although the main building is thought to have been built in eight years, the whole complex was not completed until 1653.<br><br>\r\nNot long after it was finished, Shah Jahan was overthrown by his son Aurangzeb and imprisoned in Agra Fort, where for the rest of his days he could only gaze out at his creation through a window. Following his death in 1666, Shah Jahan was buried here alongside his beloved Mumtaz.<br><br>\r\nIn total, some 20,000 people from India and Central Asia worked on the building. Specialists were brought in from as far away as Europe to produce the exquisite marble screens and pietra dura (marble inlay work) made with thousands of semiprecious stones.<br><br>\r\nThe Taj was designated a World Heritage Site in 1983 and looks nearly as immaculate today as when it was first constructed – though it underwent a huge restoration project in the early 20th century.'),
(6, 'Paris', 'Paris, la ciudad luz', 'img/blog/paris2.jpg', 'img/blog/paris.jpg', '1', '2019-06-18 19:29:41', 'It isn’t until you’re standing in the vast courtyard of the Louvre, with sunlight shimmering through the glass pyramid and crowds milling about beneath the museum’s ornate facade, that you can truly say you’ve been to Paris. Holding tens of thousands of works of art – from Mesopotamian, Egyptian and Greek antiquities to masterpieces by artists such as da Vinci (including his incomparable Mona Lisa), Michelangelo and Rembrandt – it’s no surprise that this is one of the world’s most visited museums.<br><br>\r\nThe Sully Wing is at the eastern end of the complex; the Denon Wing stretches 800m along the Seine to the south; and the northern Richelieu Wing parallels rue de Rivoli. Long before its modern incarnation, the vast Palais du Louvre originally served as a fortress constructed by Philippe-Auguste in the 12th century (medieval remnants are still visible on the lower ground floor, Sully); it was rebuilt in the mid-16th century as a royal residence in the Renaissance style. The Revolutionary Convention turned it into a national museum in 1793.<br><br>\r\nThe paintings, sculptures and artefacts on display in the Louvre have been amassed by subsequent French governments. Among them are works of art and artisanship from all over Europe and priceless collections of antiquities. The Louvre’s raison d’être is essentially to present Western art (primarily French and Italian, but also Dutch and Spanish) from the Middle Ages to about 1848 – at which point the Musée d’Orsay takes over – as well as works from ancient civilisations that formed the West\'s cultural foundations.<br><br>\r\nWhen the museum opened in the late 18th century it contained 2500 paintings and objets d’art; the ‘Grand Louvre’ project inaugurated by the late president François Mitterrand in 1989 doubled the museum’s exhibition space, and both new and renovated galleries have opened in recent years devoted to objets d’art such as the crown jewels of Louis XV (Room 66, 1st floor, Apollo Gallery, Denon). The Islamic art galleries (lower ground floor, Denon) are in the restored Cour Visconti.'),
(7, 'Hawaii', 'Hawaii, naturaleza en su maxima expresion', 'img/blog/1562116696_hawaii.JPG', 'img/blog/1562116696_hawaii.JPG', '1', '2019-07-03 03:18:16', 'Even among Hawaii\'s many wonders, this national park stands out. Its two active volcanoes testify to the ongoing birth of the islands: quiet Mauna Loa (13,677ft) sprawling above, its unassuming mass downplaying its height, and young Kilauea (4091ft), one of the world\'s most active volcanoes, providing near-continual sources of awe. With luck, you\'ll witness the primal power of molten earth boiling into the sea. But the park contains much more: overwhelming lava deserts, steaming craters, lava tubes and ancient rainforests.<br><br>\r\nRoadless, pristine and hauntingly beautiful, this 16-mile-long stretch of stark cliffs, white-sand beaches, turquoise coves and gushing waterfalls links the island\'s northern and western shores.<br><br>\r\nThere\'s a sense of suspense you just can\'t shake while driving the Road to Hana, a serpentine road lined with tumbling waterfalls, lush slopes, and rugged coasts – and serious hairpin turns. Spanning the northeast shore of Maui, the legendary Hana Hwy ribbons tightly between jungle valleys and towering cliffs. Along the way, 54 one-lane bridges mark nearly as many waterfalls, some tranquil and inviting, others so sheer they kiss you with spray as you drive past. The drive is ravishingly gorgeous, but certainly not easy.<br><br>\r\nGot your camera? This beauty takes its name from the triple cascade that flows down a steep rockface on the inland side of the road, 0.5 miles past the 19-mile marker. Catch it after a rainstorm and the cascades come together and roar as one mighty waterfall. There’s limited parking up the hill to the left after the falls.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id_com` int(11) NOT NULL,
  `id_art_id` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `comentario` text NOT NULL,
  PRIMARY KEY (`id_com`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_com`, `id_art_id`, `id_autor`, `fecha`, `comentario`) VALUES
(1, 1, 2, '2019-06-18 17:06:54', 'Excelente articulo!'),
(2, 6, 3, '2019-06-18 23:51:19', 'No entiendo nada'),
(3, 2, 3, '2019-06-18 23:53:49', 'Vamos a buscar, las esferas del dragon'),
(4, 2, 1, '2019-07-11 16:08:12', 'Con un guantelete del infinito me conformo.'),
(5, 1, 4, '2019-07-11 15:47:39', 'El comisionado Gordon es un inepto, esta perdiendo control de la ciudad y los criminales hacen lo que quieren. Batman podra tener metodos de dudosa justificacion pero por lo menos hace algo.'),
(6, 6, 5, '2019-07-11 15:56:44', 'Cuanto sale el embape ese');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE IF NOT EXISTS `consultas` (
  `id_consult` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `consulta` text NOT NULL,
  `respondida` int(3) NOT NULL,
  PRIMARY KEY (`id_consult`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consult`, `nombre`, `email`, `consulta`, `respondida`) VALUES
(1, 'Franco', 'francoacipolla@gmail.com', 'Hola esto es una consultaaaaaaaaa', 0),
(2, 'Tony Stark', 'francoc10@live.com.ar', 'Hola, estoy interesado en la tecnologia usada para los viajes en el tiempo. Tenemos que revertir lo que Thanos hizo.. preferentemente sin seguir las recomendaciones para Ant Man de los fans', 0),
(3, 'Franco', 'francoacipolla@gmail.com', 'Estoy probando las consultas', 1),
(4, 'Franco', 'francoacipolla@gmail.com', 'probando las consultas', 1),
(5, 'Franco', 'francoc10@live.com.ar', 'Probando las consultassssss', 1),
(6, 'Franco', 'francoacipolla@gmail.com', 'Probando consultasssssss', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galerias`
--

DROP TABLE IF EXISTS `galerias`;
CREATE TABLE IF NOT EXISTS `galerias` (
  `id_gale` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(50) NOT NULL,
  PRIMARY KEY (`id_gale`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `galerias`
--

INSERT INTO `galerias` (`id_gale`, `pais`) VALUES
(1, 'Nepal'),
(2, 'India'),
(3, 'Egipto'),
(4, 'Jordania'),
(5, 'Israel'),
(6, 'EAU'),
(7, 'Bhutan'),
(8, 'Turquia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_galeria`
--

DROP TABLE IF EXISTS `img_galeria`;
CREATE TABLE IF NOT EXISTS `img_galeria` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `id_gale` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `lugar` varchar(60) NOT NULL,
  PRIMARY KEY (`id_img`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `img_galeria`
--

INSERT INTO `img_galeria` (`id_img`, `id_gale`, `img`, `lugar`) VALUES
(1, 1, 'img/galeria/Nepal/ne1.jpg', 'Bhaktapur'),
(2, 1, 'img/galeria/Nepal/ne2.jpg', 'Himalayas'),
(3, 1, 'img/galeria/Nepal/ne3.jpg', 'Boudhanath Stupa, Kathmandu'),
(4, 1, 'img/galeria/Nepal/ne4.jpg', 'Kathmandu'),
(5, 1, 'img/galeria/Nepal/ne5.jpg', 'Himalayas'),
(6, 1, 'img/galeria/Nepal/ne6.jpg', 'Swayambhunath, Kathmandu'),
(7, 1, 'img/galeria/Nepal/ne7.jpg', 'Bhaktapur'),
(8, 1, 'img/galeria/Nepal/ne8.jpg', 'Durbar Square, Kathmandu'),
(9, 1, 'img/galeria/Nepal/ne9.jpg', 'Boudhanath Stupa, Kathmandu'),
(10, 1, 'img/galeria/Nepal/ne10.jpg', 'Durbar Square, Kathmandu'),
(11, 1, 'img/galeria/Nepal/ne11.jpg', 'Himalayas'),
(12, 1, 'img/galeria/Nepal/ne12.jpg', 'Himalayas'),
(13, 2, 'img/galeria/India/in1.jpg', 'Taj Mahal, Agra'),
(14, 2, 'img/galeria/India/in2.jpg', 'Fuerte Rojo, Agra'),
(15, 2, 'img/galeria/India/in3.jpg', 'Puerta de la India, Delhi'),
(16, 2, 'img/galeria/India/in4.jpg', 'Tumba de Humayun, Delhi'),
(17, 2, 'img/galeria/India/in5.jpg', 'Fatehpur Sikri, Agra'),
(18, 2, 'img/galeria/India/in6.jpg', 'Templo de Loto, Delhi'),
(19, 2, 'img/galeria/India/in7.jpg', 'Varanasi'),
(20, 2, 'img/galeria/India/in8.jpg', 'Taj Mahal, Agra'),
(21, 2, 'img/galeria/India/in9.jpg', 'Hawa Mahal, Jaipur'),
(22, 2, 'img/galeria/India/in10.jpg', 'Jaipur'),
(23, 2, 'img/galeria/India/in11.jpg', 'Fuerte Amer, Jaipur'),
(24, 2, 'img/galeria/India/in12.jpg', 'Kochi, Kerala'),
(25, 3, 'img/galeria/Egipto/eg1.jpg', 'Giza'),
(26, 3, 'img/galeria/Egipto/eg2.jpg', 'Templo de Edfu'),
(27, 3, 'img/galeria/Egipto/eg3.jpg', 'Abu Simbel'),
(28, 3, 'img/galeria/Egipto/eg4.jpg', 'Abu Simbel'),
(29, 3, 'img/galeria/Egipto/eg5.jpg', 'Templo de Kom Ombo'),
(30, 3, 'img/galeria/Egipto/eg6.jpg', 'Templo de Karnak'),
(31, 3, 'img/galeria/Egipto/eg7.jpg', 'Templo de Luxor'),
(32, 3, 'img/galeria/Egipto/eg8.jpg', 'Aswan'),
(33, 3, 'img/galeria/Egipto/eg9.jpg', 'Cairo'),
(34, 3, 'img/galeria/Egipto/eg10.jpeg', 'Cairo'),
(35, 3, 'img/galeria/Egipto/eg11.jpg', 'Piramide Escalonada de Saqqara'),
(36, 3, 'img/galeria/Egipto/eg12.jpg', 'Esfinge, Giza'),
(37, 4, 'img/galeria/Jordania/jo1.jpg', 'Amman'),
(38, 4, 'img/galeria/Jordania/jo2.jpg', 'Jerash'),
(39, 4, 'img/galeria/Jordania/jo3.jpg', 'Tesoro, Petra'),
(40, 4, 'img/galeria/Jordania/jo4.jpg', 'Amman'),
(41, 4, 'img/galeria/Jordania/jo5.jpg', 'Monasterio, Petra'),
(42, 4, 'img/galeria/Jordania/jo6.jpg', 'Mezquita Rey Abdullah, Amman'),
(43, 4, 'img/galeria/Jordania/jo7.jpg', 'Desierto de Wadi Rum'),
(44, 4, 'img/galeria/Jordania/jo8.jpg', 'Jerash'),
(45, 4, 'img/galeria/Jordania/jo9.jpg', 'Petra'),
(46, 4, 'img/galeria/Jordania/jo10.jpg', 'Petra'),
(47, 4, 'img/galeria/Jordania/jo11.jpg', 'Abdali Mall, Amman'),
(48, 4, 'img/galeria/Jordania/jo12.jpg', 'Abdali Boulevard, Amman'),
(49, 5, 'img/galeria/Israel/is1.jpg', 'Jerusalem'),
(50, 5, 'img/galeria/Israel/is2.jpg', 'Bahai Gardens, Haifa'),
(51, 5, 'img/galeria/Israel/is3.jpg', 'Shuk Ha Carmel, Tel Aviv'),
(52, 5, 'img/galeria/Israel/is4.jpg', 'Tel Aviv'),
(53, 5, 'img/galeria/Israel/is5.jpg', 'Torre de David, Jerusalem'),
(54, 5, 'img/galeria/Israel/is6.jpg', 'Santo Sepulcro, Jerusalem'),
(55, 5, 'img/galeria/Israel/is7.jpg', 'Iglesia de la Natividad, Belen'),
(56, 5, 'img/galeria/Israel/is8.jpg', 'Rio Jordan, Yardenit'),
(57, 5, 'img/galeria/Israel/is9.jpg', 'Domo de la roca, Jerusalem'),
(58, 5, 'img/galeria/Israel/is10.jpg', 'Ciudad Antigua, Jerusalem'),
(59, 5, 'img/galeria/Israel/is11.jpg', 'Tzfat'),
(60, 5, 'img/galeria/Israel/is12.jpg', 'Iglesia de San Pedro, Jaffa'),
(61, 6, 'img/galeria/Dubai/du1.jpg', 'Downtown Dubai'),
(62, 6, 'img/galeria/Dubai/du2.jpg', 'Burj Al Arab, Dubai'),
(63, 6, 'img/galeria/Dubai/du3.jpg', 'Burj Khalifa, Dubai'),
(64, 6, 'img/galeria/Dubai/du4.jpg', 'Mezquita Sheikh Zayed, Abu Dhabi'),
(65, 6, 'img/galeria/Dubai/du5.jpg', 'Atlantis, The Palm, Dubai'),
(66, 6, 'img/galeria/Dubai/du6.jpg', 'Burj Khalifa, Dubai'),
(67, 6, 'img/galeria/Dubai/du7.jpg', 'Dubai Frame'),
(68, 6, 'img/galeria/Dubai/du8.jpg', 'Palm Jumeirah, Dubai'),
(69, 6, 'img/galeria/Dubai/du9.jpg', 'Abu Dhabi'),
(70, 6, 'img/galeria/Dubai/du10.jpg', 'Ferrari World, Abu Dhabi'),
(71, 6, 'img/galeria/Dubai/du11.jpg', 'Desierto, Dubai'),
(72, 6, 'img/galeria/Dubai/du12.jpg', 'Dubai Marina'),
(73, 7, 'img/galeria/Bhutan/bu1.jpg', 'Paro Taktshang'),
(74, 7, 'img/galeria/Bhutan/bu2.jpg', 'Thimphu Chorten, Thimphu'),
(75, 7, 'img/galeria/Bhutan/bu3.jpg', 'Paro'),
(76, 7, 'img/galeria/Bhutan/bu4.jpg', 'Estatua Buddha Dordenma, Thimphu'),
(77, 7, 'img/galeria/Bhutan/bu5.jpg', 'Punakha Dzong'),
(78, 7, 'img/galeria/Bhutan/bu6.jpg', 'Tashichhoedzong, Thimphu'),
(79, 7, 'img/galeria/Bhutan/bu7.jpg', 'Tashichhoedzong, Thimphu'),
(80, 7, 'img/galeria/Bhutan/bu8.jpg', 'Tashichhoedzong, Thimphu'),
(81, 7, 'img/galeria/Bhutan/bu9.jpg', 'Punakha Dzong'),
(82, 7, 'img/galeria/Bhutan/bu10.jpg', 'Paro Taktshang'),
(83, 7, 'img/galeria/Bhutan/bu11.jpg', 'Festival de Paro'),
(84, 7, 'img/galeria/Bhutan/bu12.jpg', 'Festival de Paro'),
(85, 8, 'img/galeria/Turquia/tu1.jpg', 'Ayasofya, Istanbul'),
(86, 8, 'img/galeria/Turquia/tu2.jpg', 'Sultan Ahmet Camii, Istanbul'),
(87, 8, 'img/galeria/Turquia/tu3.jpg', 'Ayasofya, Istanbul'),
(88, 8, 'img/galeria/Turquia/tu4.jpg', 'Topkapi Sarayi, Istanbul'),
(89, 8, 'img/galeria/Turquia/tu5.jpg', 'Dolmabahce Sarayi, Istanbul'),
(90, 8, 'img/galeria/Turquia/tu6.jpeg', 'Besiktas Arena, Istanbul'),
(91, 8, 'img/galeria/Turquia/tu7.jpg', 'Cisterna de la Basilica, Istanbul'),
(92, 8, 'img/galeria/Turquia/tu8.jpg', 'Antiguo Hipodromo, Istanbul'),
(93, 8, 'img/galeria/Turquia/tu9.jpg', 'Torre del reloj, Dolmabahce Sarayi, Istanbul'),
(94, 8, 'img/galeria/Turquia/tu10.jpg', 'Gran Bazaar, Istanbul'),
(95, 8, 'img/galeria/Turquia/tu11.jpg', 'Galata Kulesi, Istanbul'),
(96, 8, 'img/galeria/Turquia/tu12.jpg', 'Bazaar Egipcio, Istanbul');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usr` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usr` varchar(15) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `admin` int(3) NOT NULL,
  `cod` varchar(250) NOT NULL,
  `activado` int(2) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  PRIMARY KEY (`id_usr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usr`, `nombre`, `email`, `usr`, `pass`, `admin`, `cod`, `activado`, `imagen`) VALUES
(1, 'Franco Cipolla', 'francoc10@live.com.ar', 'franco', '1234', 1, 'feb034ccfb6918d1e90a1d9b46a1a3d0', 1, 'img/img_usuarios/1560895159_thanos.jpg'),
(2, 'Tony Stark', 'franco.cipolla@comunidad.ub.edu.ar', 'ironman420', 'ironman', 0, 'fd7ffdf293364a8ebc1cdf55c640cd6b', 1, 'img/img_usuarios/tony.jpg'),
(3, 'Harold Balder', 'harold@gmail.com', 'harold', 'harold123', 0, 'bd0e73e7d7f69c40acb4e8e0c9207211', 1, 'img/img_usuarios/harold.jpg'),
(4, 'Bruce Wayne', 'bruce@wayneenterprises.com', 'Batman', 'batman1234', 0, 'ffe2d3ece088737750e85ddbd537649c', 1, 'img/img_usuarios/1562859933_bruce.jpg'),
(5, 'Daniel Angelici', 'angeleasy@boca.com', 'angeleasy', 'bokeh', 0, 'rts7484ccfb6984f1e955gn9b46a1a3d0', 1, 'img/img_usuarios/1562860573_angeleasy.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
