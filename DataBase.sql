-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-12-2022 a las 14:20:12
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tutorias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `altera_entrega`
--

CREATE TABLE `altera_entrega` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mes_1` tinyint(1) NOT NULL DEFAULT '0',
  `mes_2` tinyint(1) NOT NULL DEFAULT '0',
  `mes_3` tinyint(1) NOT NULL DEFAULT '0',
  `mes_4` tinyint(1) NOT NULL DEFAULT '0',
  `mes_5` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `altera_entrega`
--

INSERT INTO `altera_entrega` (`id`, `mes_1`, `mes_2`, `mes_3`, `mes_4`, `mes_5`) VALUES
(1, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_paterno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_materno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `domicilio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grupo` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `carrera_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `ap_paterno`, `ap_materno`, `sexo`, `fecha_nacimiento`, `domicilio`, `grupo`, `telefono`, `correo`, `estado`, `carrera_id`) VALUES
('123456', 'Salas', 'salas', 'salas', 'M', '2022-12-31', 'tantoyuca', 'A', '456-789-0086', 'itsa@gmail.com', 1, 2),
('173S0006', 'SANDRA ELIZABETH', 'HERNANDEZ', 'DEL ANGEL', 'F', NULL, 'Toyol Aquiche', 'A', '789-120-3260', '173S0006@itsta.edu.mx', 1, 1),
('173S0010', 'Azure', 'Herrera', 'Axcel', 'F', '2022-12-31', 'Las Lajitas Tantoyuca, Ver.', 'A', '789-122-3444', '173s0010@itsta.edu.mx', 1, 1),
('173S0012', 'BERENICE ANAI', 'ANTONIO', 'ANTONIO', 'F', NULL, 'La Estanzuela Aquiche', 'A', '7891300141', '173S0012@itsta.edu.mx', 1, 1),
('173S0016', 'Azure', 'Lopez', 'Santana', 'M', '2022-02-22', 'Las Lajitas Tantoyuca, Ver.', 'B', '789-108-6450', '173s0010@itsta.edu.mx', 1, 2),
('173S0019', 'JOSE', 'PEREZ', 'LEON', 'M', '2022-03-23', 'Tantoyuca, Ver.', 'B', '786-876-8768', '173s0019@itsta.edu.mx', 1, 2),
('183s0012', 'ANGEL', 'DEL ANGEL', 'DL ANGEL', 'M', '2022-12-31', 'CALLE 15 DE MAYO', 'B', '7891192608', '183S0014@itsta.edu.mx', 1, 2),
('183s0014', 'ANGEL', 'DEL ANGEL', 'DL ANGEL', 'M', '2022-12-31', 'CALLE 15 DE MAYO', 'B', '7891192608', '183S0014@itsta.edu.mx', 1, 2),
('183S0016', 'ANA', 'HERNANDEZ', 'LOPEZ', 'F', NULL, 'Toyol Aquiche', 'A', '7891203260', '183S0016@itsta.edu.mx', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_examenes`
--

CREATE TABLE `alumnos_examenes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `periodo_eval_id` bigint(20) UNSIGNED NOT NULL,
  `num_control` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrera_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos_examenes`
--

INSERT INTO `alumnos_examenes` (`id`, `periodo_eval_id`, `num_control`, `carrera_id`, `nombre`, `telefono`, `correo`, `status`) VALUES
(1, 1, '173S0014', 1, 'Jose Perez Leon', '7891001212', '173S0016@gmail.com', 0),
(2, 1, '173S0018', 1, 'Ana lopez santana', '0987654321', '173S0017@itsta.edu.mx', 0),
(3, 1, '173S0019', 1, 'Susan Lopez', '0987654322', '173S0016@gmail.com', 0),
(4, 1, '173S0016', 1, 'albert', '0987654323', '173S0017@itsta.edu.mx', 1),
(5, 1, '173S0021', 1, 'robert', '0987654324', '173S0016@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_tutor`
--

CREATE TABLE `asignacion_tutor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tutor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodo_id` bigint(20) UNSIGNED NOT NULL,
  `semestre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grupo` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asignacion_tutor`
--

INSERT INTO `asignacion_tutor` (`id`, `tutor_id`, `periodo_id`, `semestre`, `grupo`) VALUES
(2, '173S0018', 4, '5', 'B'),
(3, '17212F', 4, '2', 'B'),
(4, '173S0020', 4, '1', 'A'),
(5, '173S0021', 4, '1', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisos`
--

CREATE TABLE `avisos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aviso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destinatario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `avisos`
--

INSERT INTO `avisos` (`id`, `titulo`, `aviso`, `destinatario`) VALUES
(1, 'Urgente', 'El día de mañana nos vemos en las islas de sistemas', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_carrera` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fondo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre_carrera`, `icono`, `fondo`) VALUES
(1, 'Ing. industrial', '/img_carrera/icon-20220222-030829.jpeg', '/img_carrera/back-20220222-030829.png'),
(2, 'Ing. Sistemas Computacionales', '/img_carrera/icon-20220226-220153.png', '/img_carrera/back-20220226-220153.png'),
(17, 'POSGRADO', '/img_carrera/icon-20220408-191650.png', '/img_carrera/back-20220408-191650.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caracteristicas` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id`, `nombre`, `codigo`, `caracteristicas`) VALUES
(1, 'azul', '#343399', 'El azul oscuro de este test  representa la serenidad absoluta. La contemplación de  este  color  tiene  el  efecto  tranquilizador  en  el  sistema  nervioso  central.  La presión de la sangre, el ritmo cardiaco y respiratorio disminuyen, en tanto que los  mecanismos  auto  protectores  se  ponen  en  funcionamiento  para acondicionar de nuevo al organismo. El cuerpo se relaja y se recupera, por lo que en la enfermedad y en el cansancio, aumenta la necesidad de este color.'),
(2, 'verde', '#339967', 'Se  expresa  psicológicamente  como  la  voluntad  en  actividad,  como perseverancia y tenacidad. Representa firmeza, perseverancia y sobre todo de resistencia  a  cambia.  '),
(3, 'amarillo', '#FFFF00', 'Los  efectos  de  éste  son  de  luz  y  alegría.  El  amarillo  aumenta  la  presión sanguínea,  el  ritmo  del  pulso  y  de  la  respiración  de  un  modo  parecido  al  del rojo.  Las  principales  características  del  amarillo  son:  Claridad,  reflexión,  brillo  y alegría  substancial.  El  amarillo  manifiesta expansividad  desinhibida,  laxitud  y relación.'),
(4, 'rojo', '#FE0000', 'Representa  una condición orgánica de exceso de energía. El pulso se acelera,  aumenta  la  presión  sanguínea  y  el  ritmo  respiratorio  crece.  El  color  rojo  es  la expresión  de  fuerza  vital  y  de  actividad  nerviosa  y  glandular;   por  esta  razón significa  deseo  en  todas  las  gamas  de  apetencia  y  anhelo;  es  el  apremio  de lograr  éxitos,  de  alcanzar  el  triunfo,  de  conseguir  ávidamente  todas  aquellas cosas que ofrece intensidad vital y experiencia plena: es el impulso, la voluntad de  vencer  y  todas  las  formas  de  vitalidad  y  poder  desde  la  potencia  sexual hasta las transformaciones revolucionarías.'),
(5, 'violeta', '#81007F', 'Es una mezcla de azul y rojo. Intenta unir el ardo  impulsivo del rojo con la dócil entrega del azul para significar la identificación.El violeta quiere decir identificación en una unión íntima y erótica; puede llevar a  una  comprensión  intuitiva  y  sensible.  Nos  demuestra  una  gran irresponsabilidad  en  el  sujeto.  Una  persona  juiciosa  en  general  escogerá  un color  básico  en  lugar  del  violeta,  una  mental  y  emocionalmente  inmadura escoge  el  violeta.  Este  color  es  escogido  en  muchos  de  los  casos  por adolescentes, otros casos son los homosexuales que escogen en primer lugar el violeta mostrando una inseguridad sentimental.'),
(6, 'marron', '#993400', 'Éste es un color amarillo  –  rojo oscuro. El marrón representa lo sensitivo, es decir, lo  que  hace  referencia  a  los  sentidos  corporales.  Es  sensual,  se  relaciona directamente con el cuerpo físico y su posición en la fila de una indicación de la condición sensorial de éste. Cuando existen trastornos somáticos o mal estar, el marrón se recorre al principio de la fila demostrando de este modo que se acentúa  la  indisposición  orgánica  y  la  necesidad  de  mejorar  las  condiciones que permitan aliviarla.'),
(7, 'negro', '#000000', 'El  color  negro,  es  la  negación  del  mismo  color.  El  negro  representa renunciación, la  última entrega o abandono y tiene un efecto muy intenso en cualquier color que esté en el mismo grupo  acentuando las características de ese color.'),
(8, 'gris', '#C0C0C0', 'El gris nos es un color oscuro ni claro. El gris no es una zona ocupada, sino una frontera, que es “tierra de nadie”, como en una zona desmilitarizada.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_materias`
--

CREATE TABLE `control_materias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `periodo_id` bigint(20) UNSIGNED NOT NULL,
  `materia_id` bigint(20) UNSIGNED NOT NULL,
  `alumno_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `control_materias`
--

INSERT INTO `control_materias` (`id`, `periodo_id`, `materia_id`, `alumno_id`, `status`) VALUES
(1, 4, 1, '173s0010', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`id`, `nombre`) VALUES
(1, 'Examen Psicometrico'),
(2, 'Test Socioeconomico'),
(3, 'Prueba de Razonamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_respuesta`
--

CREATE TABLE `evaluacion_respuesta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alumno_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pregunta_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respuesta_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periodo_eval_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `evaluacion_respuesta`
--

INSERT INTO `evaluacion_respuesta` (`id`, `alumno_id`, `pregunta_id`, `respuesta_id`, `periodo_eval_id`) VALUES
(1, '173S0016', 'sec1p01', 'sec1-r01', 1),
(2, '173S0016', 'sec1p02', 'sec1-r05', 1),
(3, '173S0016', 'sec1p03', 'sec1-r08', 1),
(4, '173S0016', 'sec1p04', 'sec1-r11', 1),
(5, '173S0016', 'sec1p05', 'sec1-r14', 1),
(6, '173S0016', 'sec1p06', 'sec1-r17', 1),
(7, '173S0016', 'sec1p07', 'sec1-r20', 1),
(8, '173S0016', 'sec1p08', 'sec1-r23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `file_format`
--

CREATE TABLE `file_format` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_archivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destinatario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atentamente_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atentamente_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atentamente_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `file_format`
--

INSERT INTO `file_format` (`id`, `nombre_archivo`, `destinatario`, `atentamente_1`, `cargo`, `atentamente_2`, `cargo_2`, `atentamente_3`, `cargo_3`) VALUES
(1, 'CONTANCIA', 'PRESENTE', 'LPS. José Candelario García', 'Coordinador del Programa Institucional de Tutorías', 'Ing. Julio Meza Hernández', 'Subdirector de estudios superiores.', 'Lic. Santa del Ángel Méndez', 'Jefa del Departamento de Servicios Escolares.'),
(2, 'MEORANDUM', 'DOCENTE', 'Psic. José Candelario García', 'Orientación Educativa', 'Ing. Julio Meza Hernández', 'Subdirector Académico', 'M.I J. Guillermo Rivera Zumaya', 'Director Académico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semestre` int(11) NOT NULL,
  `carrera_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre`, `semestre`, `carrera_id`) VALUES
(1, 'Matemáticas Discretas', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_25_010307_create_carreras', 1),
(6, '2021_09_25_041652_create_tutores', 1),
(7, '2021_09_25_043500_add_fk_tutor', 1),
(8, '2021_09_27_044028_create_materias', 1),
(9, '2021_09_27_044042_create_avisos', 1),
(10, '2021_09_27_044426_create_periodos', 1),
(11, '2021_09_27_044442_create_alumnos', 1),
(12, '2021_09_27_044509_create_control_materias', 1),
(13, '2021_09_27_044521_create_perido_tutorado', 1),
(14, '2021_10_10_191939_create_colores', 1),
(15, '2021_10_10_192748_create_periodo_eval', 1),
(16, '2021_10_10_193152_create_posiciones', 1),
(17, '2021_10_11_155922_create_evaluaciones', 1),
(18, '2021_10_11_161000_create_preguntas', 1),
(19, '2021_10_11_162700_create_respuestas', 1),
(20, '2021_10_11_164847_create_evaluacion_respuesta', 1),
(21, '2021_10_17_165251_create_permission_tables', 1),
(22, '2021_11_06_025159_create_semaforo', 1),
(23, '2021_12_01_032500_add_fk_periodo_tutorado', 1),
(24, '2021_12_09_022546_create_resultados', 1),
(25, '2021_12_20_022920_create_asignacion_tutor', 1),
(26, '2021_12_20_030346_create_file_format', 1),
(27, '2021_12_29_043125_create_alumnos_examenes', 1),
(28, '2022_01_13_172349_create_registro', 1),
(30, '2022_05_23_025308_create_altera_entrega', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inicio` date NOT NULL,
  `fin` date NOT NULL,
  `mes_1` date NOT NULL,
  `mes_2` date NOT NULL,
  `mes_3` date NOT NULL,
  `mes_4` date NOT NULL,
  `reporte_final` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`id`, `inicio`, `fin`, `mes_1`, `mes_2`, `mes_3`, `mes_4`, `reporte_final`) VALUES
(4, '2022-02-20', '2022-12-31', '2022-05-20', '2022-02-25', '2022-02-25', '2022-03-03', '2022-03-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_eval`
--

CREATE TABLE `periodo_eval` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inicio` date NOT NULL,
  `fin` date NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `periodo_eval`
--

INSERT INTO `periodo_eval` (`id`, `inicio`, `fin`, `estado`) VALUES
(1, '2022-02-27', '2022-02-28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_tutorado`
--

CREATE TABLE `periodo_tutorado` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `periodo_id` bigint(20) UNSIGNED NOT NULL,
  `tutor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alumno_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semestre` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `mes_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mes_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mes_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mes_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporte_final` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oe_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oe_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oe_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oe_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entrega_1` date DEFAULT NULL,
  `entrega_2` date DEFAULT NULL,
  `entrega_3` date DEFAULT NULL,
  `entrega_4` date DEFAULT NULL,
  `entrega_final` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `semaforo_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `periodo_tutorado`
--

INSERT INTO `periodo_tutorado` (`id`, `periodo_id`, `tutor_id`, `alumno_id`, `semestre`, `tipo`, `mes_1`, `mes_2`, `mes_3`, `mes_4`, `reporte_final`, `oe_1`, `oe_2`, `oe_3`, `oe_4`, `entrega_1`, `entrega_2`, `entrega_3`, `entrega_4`, `entrega_final`, `status`, `semaforo_id`) VALUES
(2, 4, '173S0018', '173s0010', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3),
(5, 4, '17212F', '173S0012', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4),
(8, 4, '173S0018', '173s0006', 1, 1, 'Ya esta mejorando ya se hablo con ella y pondrá mas empeño a sus clases', NULL, NULL, NULL, NULL, 'Pendiente jajajaja no se que es esto tiene que estar muy amplio', 'Guardar todos los archivos', 'Crear nuevo', 'Pendiente de revisar', '2022-02-26', NULL, NULL, NULL, NULL, 1, 2),
(9, 4, '17212F', '173s0006', 1, 2, 'No entra a clases es muy desordenada', NULL, NULL, NULL, 'Pendiente', NULL, NULL, NULL, NULL, '2022-02-26', NULL, NULL, NULL, NULL, 1, 1),
(10, 4, '17212F', '173s0010', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4),
(11, 4, '173S0018', '173S0012', 1, 2, 'No ha entregado varias tareas ingles y algebra lineal tampoco entra a clases', 'Entrego todo lo que debia', 'No entro a dos clases', 'Ya se esta poniendo las pilas', 'Este es el resultado final', 'Se llevo acabo una platica presencial con el alumno y esta dispuesto a ponerse al corriente', 'Ok todo en orden entonces', 'Hablare con ella', 'ok', '2022-02-26', '2022-02-26', '2022-02-26', '2022-02-26', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'tutorias.home', 'web', '2022-02-16 09:42:11', '2022-02-16 09:42:11'),
(2, 'tutorias.tutores.show', 'web', '2022-02-16 09:42:11', '2022-02-16 09:42:11'),
(3, 'show.date', 'web', '2022-02-16 09:42:11', '2022-02-16 09:42:11'),
(4, 'mes.admin', 'web', '2022-02-16 09:42:11', '2022-02-16 09:42:11'),
(5, 'nuevo_ingreso.home', 'web', '2022-02-16 09:42:11', '2022-02-16 09:42:11'),
(6, 'solo.admin', 'web', '2022-02-16 09:42:11', '2022-02-16 09:42:11'),
(7, 'mes.tutor', 'web', '2022-02-16 09:42:11', '2022-02-16 09:42:11'),
(8, 'solo.tutor', 'web', '2022-02-16 09:42:11', '2022-02-16 09:42:11'),
(9, 'admin.tutor', 'web', '2022-02-16 09:42:11', '2022-02-16 09:42:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posiciones`
--

CREATE TABLE `posiciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alumno_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `posicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `posiciones`
--

INSERT INTO `posiciones` (`id`, `alumno_id`, `color_id`, `posicion`) VALUES
(1, '173S0016', 1, 2),
(2, '173S0016', 2, 6),
(3, '173S0016', 3, 5),
(4, '173S0016', 4, 3),
(5, '173S0016', 5, 1),
(6, '173S0016', 6, 7),
(7, '173S0016', 7, 8),
(8, '173S0016', 8, 4),
(9, '123456', 1, 2),
(10, '123456', 2, 4),
(11, '123456', 3, 5),
(12, '123456', 4, 6),
(13, '123456', 5, 3),
(14, '123456', 6, 1),
(15, '123456', 7, 7),
(16, '123456', 8, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evaluacion_id` bigint(20) NOT NULL,
  `pregunta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `evaluacion_id`, `pregunta`, `seccion`) VALUES
('ps1p01', 1, 'Cuando no entiendo algo en clase, no me atrevo a pedir explicaciones', 1),
('ps1p02', 1, 'Cuando el maestro está ausente, no me agrada recibir órdenes de un compañero', 1),
('ps1p03', 1, 'Cuando lo que compro tiene algún defecto, se lo digo al vendedor', 1),
('ps1p04', 1, 'Generalmente hago lo que me mandan y no me cuesta trabajo someterme', 1),
('ps1p05', 1, 'A menudo me opongo a lo que dicen o quieren hacer los demás', 1),
('ps1p06', 1, 'No me gusta que el capitán del equipo decida todo sin consultarme', 1),
('ps1p07', 1, 'No me agrada ser el responsable de un equipo deportivo', 1),
('ps1p08', 1, 'Si un amigo me insiste a que lo acompañe a una reunión poco interesante, no me niego', 1),
('ps1p09', 1, 'No me gusta dar órdenes en reuniones en reuniones a muchachos de mi edad', 1),
('ps1p10', 1, 'No tengo duda en contestar a quien me insiste demasiado en lo que tengo que hacer', 1),
('ps1p11', 1, 'Prefiero dejar a otros la tarea de organizar nuevos juegos', 1),
('ps1p12', 1, 'Aunque no quiera asistir a un espectáculo, no me gusta decir que no a quien me invita', 1),
('ps1p13', 1, 'A menudo quiero tener la razón cuando discuto con mis amigos', 1),
('ps1p14', 1, 'Si juego con un adversario más hábil que yo, ni siquiera intento ganarle', 1),
('ps1p15', 1, 'Me esfuerzo en imponer mis ideas, aunque para ello me sea preciso luchar', 1),
('ps1p16', 1, 'No me gusta dirigir un trabajo colectivo', 1),
('ps1p17', 1, 'Prefiero dejar que hablen los demás cuando el maestro nos pide nuestra opinión', 1),
('ps1p18', 1, 'Intento colocarme entre los primeros cuando se trata de algo curioso o de ir a jugar', 1),
('ps1p19', 1, 'A menudo desearía conducir y mandar a los demás', 1),
('ps1p20', 1, 'Vacilo en contradecir a quienes expresan opiniones contrarias a las mías', 1),
('ps1p21', 1, 'No me atrevo a negar un trabajo que se me pide, aunque no me guste', 1),
('ps1p22', 1, 'Si olvido algo necesario para el juego, prefiero no jugar antes que pedirlo prestado', 1),
('ps1p23', 1, 'No renuncio fácilmente a mis derechos cuando tengo la razón', 1),
('ps1p24', 1, 'Me gusta desafiar a otros y enfrentarme con ellos en algunas ocasiones', 1),
('ps1p25', 1, 'Me siento molesto cuando estoy en compañía de un superior', 1),
('ps2p01', 1, 'Hablo poco en las reuniones, prefiero escuchar a los compañeros', 2),
('ps2p02', 1, 'Durante los partidos grito mucho cuando algún jugador realiza una buena jugada', 2),
('ps2p03', 1, 'Suelo ser el que más habla en las reuniones de los amigos', 2),
('ps2p04', 1, 'Cuando escribo una carta tengo pocas cosas que decirle', 2),
('ps2p05', 1, 'En los momentos de esparcimiento divierto a mis amigos con historietas y canciones', 2),
('ps2p06', 1, 'Me gusta mucho organizar fiestas y reunionese', 2),
('ps2p07', 1, 'Guardo para mí secretos y no los confío fácilmente a los demás', 2),
('ps2p08', 1, 'Cuando tengo que hablar o escribir sobre un asunto, se me ocurren muy pocas ideas', 2),
('ps2p09', 1, 'Me gusta contar mis aventuras más interesantes a mis amigos', 2),
('ps2p10', 1, ' Siento inclinación a responder en el acto y a disculparme cuando me reprochan algo', 2),
('ps2p11', 1, 'En las reuniones prefiero que hablen los demás y escuchar sus opiniones', 2),
('ps2p12', 1, 'Fácilmente guardo silencio en clase, cuando no se debe hablar', 2),
('ps2p13', 1, 'Cuando estoy apenado necesito comunicarlo a un amigo, para desahogarme', 2),
('ps2p14', 1, 'No siento inclinación a revelar los secretos que me han confiado', 2),
('ps2p15', 1, 'Cuando el maestro pregunta a todos la clase, me gusta responder', 2),
('ps2p16', 1, 'Rara vez hable de mí, de lo que he hecho, o de lo que me ha sucedido', 2),
('ps2p17', 1, 'Me preocupo cuando tengo que intervenir en una reunión', 2),
('ps2p18', 1, 'Me gusta hacer reír a los demás contando chistes o historietas graciosas', 2),
('ps2p19', 1, 'Tan pronto como recibo una noticia interesante, se las comunico a mis amigos', 2),
('ps2p20', 1, 'Soy reservado en mis opiniones, me gusta guardarlas para mí', 2),
('ps2p21', 1, ' Durante los partidos no me altero, aunque los demás espectadores se emocionen', 2),
('ps2p22', 1, 'Fácilmente oculto mis pensamientos cuando no es necesario manifestarlos', 2),
('ps2p23', 1, 'Aprovecho cualquier ocasión para manifestar a los demás lo que pienso', 2),
('ps2p24', 1, 'Me gusta mucho bromear a costa de otros, pero sin molestarl', 2),
('ps2p25', 1, 'Puedo permanecer mucho tiempo quieto sin sentir necesidad de hablar o de moverme', 2),
('ps3p01', 1, 'Me deshago fácilmente de unos amigos para hacer amistad con otros', 3),
('ps3p02', 1, 'Mantengo mi manera de pensar y hablar, aunque no agrade a los demás', 3),
('ps3p03', 1, 'Procuro jugar lo mejor posibles, aunque tenga poco éxito en el juego', 3),
('ps3p04', 1, 'Unas veces estudio y hago mis tareas con mucho cuidado y otras sin importarme', 3),
('ps3p05', 1, 'Cuando me doy cuenta que un trabajo me es útil, lo hago a pesar de que no me guste', 3),
('ps3p06', 1, 'Me gustan los trabajos que exigen atención y esfuerzo', 3),
('ps3p07', 1, 'Fácilmente cambio de opinión, después de hacer decidido hacer una cosa, hago otra', 3),
('ps3p08', 1, 'Me gusta prestar servicios, con tal de que no me lleve demasiado tiempo', 3),
('ps3p09', 1, 'No me desanimo fácilmente ante un problema difícil, dedico mucho tiempo a encontrar la manera de resolverlo', 3),
('ps3p10', 1, 'Actúo según mi voluntad, aún cuando encuentre oposición', 3),
('ps3p11', 1, 'Fácilmente abandono el juego cuando no resulta a mi gusto', 3),
('ps3p12', 1, 'Unas veces respeto el reglamento escolar y otras apenas hago caso de él', 3),
('ps3p13', 1, 'Cuando he decidido hacer algo, no me detienen felicitaciones ni críticas', 3),
('ps3p14', 1, 'Abandono mis proyectos cuando encuentro demasiada oposición para realizarlos', 3),
('ps3p15', 1, 'Termino las tareas comenzadas, aunque me resulten poco interesantes', 3),
('ps3p16', 1, 'Necesito que me estimulen para proseguir el trabajo y los estudios', 3),
('ps3p17', 1, 'Tardo en decidirme cuando se trata de un trabajo difícil', 3),
('ps3p18', 1, 'Cuando me decido a leer un libro, generalmente lo termino', 3),
('ps3p19', 1, 'Me gustan las dificultades, por el placer de superarlas', 3),
('ps3p20', 1, 'Me desanimo fácilmente cuando un trabajo me resulta difícil', 3),
('ps3p21', 1, 'Me dejo guiar demasiado por los demás, por temor a desagradarles ', 3),
('ps3p22', 1, 'Las críticas me desaniman y hacen que renuncie a mis propósitos ', 3),
('ps3p23', 1, 'Por una ligera indisposición no dejo de ir a la escuela o al trabajo', 3),
('ps3p24', 1, 'Cuando prometo asistir a una reunión, cumplo mi palabra', 3),
('ps3p25', 1, 'Después de tomar una resolución cambio fácilmente de parecer', 3),
('ps4p01', 1, 'No logro tener muchos amigos entre mis compañeros de clase', 4),
('ps4p02', 1, 'Me tiene sin cuidado saber que otros hablan mal de mí', 4),
('ps4p03', 1, 'Los días de vacaciones prefiero pasarlos en casa en lugar de salir de paseo', 4),
('ps4p04', 1, 'Prefiero escribir a mi maestro, que ir a decirle lo que pienso', 4),
('ps4p05', 1, 'Las representaciones me afectan poco y las olvido pronto', 4),
('ps4p06', 1, ' Entablo fácilmente conversación con desconocidos', 4),
('ps4p07', 1, 'Me gusta reflexionar y solucionar mis dificultades sin ayuda de otros', 4),
('ps4p08', 1, 'Prefiero los juegos tranquilos (cartas o damas) a los de movimiento (béisbol o fútbol)', 4),
('ps4p09', 1, 'Fácilmente hago amistad con los compañeros de nuevo ingreso', 4),
('ps4p10', 1, ' Me gusta prestar servicios en clase, tales como ayudar al maestro o a los compañeros', 4),
('ps4p11', 1, 'Cuando me equivoco en clase, siento pesar e inquietud', 4),
('ps4p12', 1, ' Prefiero leer una historia, a verla representada en la pantalla o en el escenario', 4),
('ps4p13', 1, 'Me gustan los juegos violentos que exigen mucha actividad y ejercitan mi fuerza física', 4),
('ps4p14', 1, 'Después de visitar a un amigo, pienso mucho en qué palabras amables debería haberle dicho', 4),
('ps4p15', 1, 'Me gusta llamar la atención o que me hagan bromas inocentes en clase', 4),
('ps4p16', 1, 'Prefiero soñar con los éxitos, a esforzarme por conseguirlos', 4),
('ps4p17', 1, 'Prefiero guardar mis penas para mí solo, en vez de contárselas a otros', 4),
('ps4p18', 1, 'Prefiero ejecutar enseguida un trabajo, en vez de pensar mucho en su realización', 4),
('ps4p19', 1, 'Cuando cometo una torpeza, soy el primero en reírme y la olvido pronto', 4),
('ps4p20', 1, 'Me gusta pensar en acontecimientos agradables, de difícil realización', 4),
('ps4p21', 1, 'Si tengo algún rato libre, prefiero pasarlo en casa, en vez de salir a la calle', 4),
('ps4p22', 1, 'Reflexiono mucho, pero no me gusta comunicar mis pensamientos', 4),
('ps4p23', 1, 'Generalmente estoy de buen humor y contento con lo que me sucede', 4),
('ps4p24', 1, 'Si alguien me causa pesar, lo olvido pronto y no le guardo rencor', 4),
('ps4p25', 1, 'Me afectan mucho las burlas y no las olvido fácilmente', 4),
('ps5p01', 1, 'Desconfío de mí cuando tengo que hablar delante de mis compañeros en clase', 5),
('ps5p02', 1, 'Confío en el triunfo cuando emprendo algún trabajo', 5),
('ps5p03', 1, 'Cuando hay que hacer algo, me decido con rapidez', 5),
('ps5p04', 1, 'Dudo de mi capacidad cuando se me pide algún servicio', 5),
('ps5p05', 1, 'Si un compañero me pide que le preste un objeto, lo hago sin vacilar', 5),
('ps5p06', 1, 'No necesito reflexionar mucho tiempo para decidirme', 5),
('ps5p07', 1, 'Me intimido fácilmente en presencia de mis superiores', 5),
('ps5p08', 1, 'Frente a una tarea difícil, vacilo antes de decidirme a obrar', 5),
('ps5p09', 1, 'Cuando cometo un error no temo en reconocer mi equivocación', 5),
('ps5p10', 1, 'Cuando he hecho lo posible, no me dejo desanimar por la crítica', 5),
('ps5p11', 1, 'Me falta la seguridad que observo en mis compañeros y no confío en mí mismo', 5),
('ps5p12', 1, 'Habitualmente procuro evitar la presencia de personas autoritarias', 5),
('ps5p13', 1, 'No me desanimo cuando los demás no quieren aceptar mis ideas', 5),
('ps5p14', 1, 'No me atrevo a organizar nada, por miedo a que me resulte mal', 5),
('ps5p15', 1, 'Expongo mis razones y defiendo mis ideas con convicción, cuando estoy en mi derecho', 5),
('ps5p16', 1, 'Creo que para triunfar en la vida necesito más ayuda que los demás', 5),
('ps5p17', 1, 'La vergüenza me impide obrar y hacerle bien que desearía', 5),
('ps5p18', 1, 'Prefiero obrar por mi cuenta, en vez de seguir siempre a los demás', 5),
('ps5p19', 1, ' Me parece que la mayoría de mis amigos tienen confianza en mí', 5),
('ps5p20', 1, 'Me falta la audacia y decisión que aseguran el triunfo en el juego', 5),
('ps5p21', 1, 'Me falta la audacia y decisión que aseguran el triunfo en el juego', 5),
('ps5p22', 1, 'Me parece que mis compañeros son más hábiles que yo', 5),
('ps5p23', 1, 'Ante la dificultad, no vacilo en probar fortuna si tengo posibilidad de éxito', 5),
('ps5p24', 1, 'Si me invitan a participar en un juego difícil, acepto sin vacilar', 5),
('ps5p25', 1, 'A menudo pienso que no tengo mucho talento como la mayoría de mis compañeros', 5),
('ps6p01', 1, 'Prefiero ver un programa de televisión, a ir a un partido de fútbol', 6),
('ps6p02', 1, 'Me gusta entablar relaciones con desconocidos y hablar con ellos', 6),
('ps6p03', 1, 'Me gusta enseñar mis trabajos a otros y les pido consejo', 6),
('ps6p04', 1, 'Me gusta pasar las vacaciones en la soledad y quietud del campo', 6),
('ps6p05', 1, 'Me resulta más agradable entretenerme con numerosos compañeros que permanecer solo', 6),
('ps6p06', 1, 'Me gusta acompañar a los visitantes y enseñarles las diversas dependencias de la escuela', 6),
('ps6p07', 1, 'Cuando tengo la libertad de escoger un trabajo, prefiero aquél que puedo realizar solo', 6),
('ps6p08', 1, 'Si me encuentro con desconocidos, no les hago caso porque no me interesan', 6),
('ps6p09', 1, 'Me gusta el trato con los demás para llegar a tener muchos amigos', 6),
('ps6p10', 1, 'Prefiero la compañía de mis padres, a permanecer sólo en la habitación', 6),
('ps6p11', 1, 'Me disgustan las reuniones en las que hay mucha gente', 6),
('ps6p12', 1, 'Prefiero divertirme en casa, en vez de ir a jugar a donde hay mucha gente', 6),
('ps6p13', 1, 'Me gusta asistir a juegos o espectáculos que concentran grandes multitudes', 6),
('ps6p14', 1, 'No me gusta pasear por las calles muy frecuentadas, porque suele haber curiosos', 6),
('ps6p15', 1, 'Me aburro cuando tengo que trabajar solo y sin compañeros', 6),
('ps6p16', 1, 'Tengo pocos amigos porque prefiero vivir solo y retirado', 6),
('ps6p17', 1, 'Prefiero pasar la tarde en casa, en vez de asistir a un espectáculo', 6),
('ps6p18', 1, 'Me gustaría pasar las vacaciones donde haya muchos turistas y extranjeros', 6),
('ps6p19', 1, 'Me gustaría ir de casa en casa, vendiendo boletos, para sostener obras de caridad', 6),
('ps6p20', 1, 'Me gusta vivir solo y tranquilo, sin ser molestado por nadie', 6),
('ps6p21', 1, 'Me desagradan las muchedumbres, los gritos y la agitación me fatigan', 6),
('ps6p22', 1, 'Me siento molesto cuando siento que me están mirando', 6),
('ps6p23', 1, 'Me hago pronto de muchos amigos cuando cambio de lugar de residencia', 6),
('ps6p24', 1, 'Me siento muy a gusto en las reuniones y veladas con mis amigos', 6),
('ps6p25', 1, 'Me siento molesto en presencia de personas desconocidas', 6),
('rz1p01', 3, 'Un grupo de ocho estudiantes reunieron la cantidad de $268.000.00 para una fiesta, si dieron igual aportación ¿Cuánto dio cada uno?.', 1),
('rz1p02', 3, 'Compraste 232 hojas para elaborar 2 trabajos en el de Química gastaste 78 y en el de ingles 11, ¿Cuántas hojas te sobraron?', 1),
('rz1p03', 3, 'Al realizar una encuesta se encontró que el peso de cuatro personas era en cada una de 54.400 kgr., 68.200kgr., 72.100kgr ¿Cuál es el peso promedio de las personas encuestadas?', 1),
('rz1p04', 3, 'Si compras 8 libros de $ 67.200.00 cada uno ¿Cuánto pagas te en total?', 1),
('rz1p05', 3, '¿Cuál es el perímetro de un terreno cuadrado que mide 13.5 mts.?', 1),
('rz1p06', 3, '¿Qué valor tiene 250 gramos de jamón si el precio del quilo es de $ 18,000.00?', 1),
('rz1p07', 3, 'Si 8 obreros tardan 6 horas en hacer un trabajo ¿Cuánto tiempo tardarán 12 obreros en hacer el mismo trabajo?.', 1),
('rz1p08', 3, '¿Cuántos paquetes de 250 gramos se pueden hacer con 9 kilogramos de azúcar? ', 1),
('rz1p09', 3, 'Una pulgada tiene 2.54 cm. ; 13 pulgadas; ¿Cuántos centímetros tiene?', 1),
('rz1p10', 3, 'Si un motor pesa 190 libras ¿ cuál es su peso en kilogramos? (una libra es igual 0.454 kilogramos)', 1),
('rz1p11', 3, '¿Cuál es el perímetro de una alberca triangular cuyos lados miden 22.75 mts. 16.28 mts. y 11.35 mts.?', 1),
('rz1p12', 3, '¿Cuántos litros almacena un recipiente de 8 galones? (un galón es igual a 3.785 litros)', 1),
('rz1p13', 3, 'Si 15 cuadernos valen $20.250.00 ¿Cuánto valen 8 cuadernos?', 1),
('rz1p14', 3, '¿Cuál es el área de un terreno triangular que mide 30 metros de base y 20 metros de altura?', 1),
('rz1p15', 3, 'Un aparato de aire acondicionado vale $1,400.000.00 al contado, si se compra en abonos aumenta un 15% ¿Cuál es el precio en abonos? ', 1),
('rz1p16', 3, '¿Qué intereses ganarían $2,300,000.00 al 22% anual en 3 años?', 1),
('rz1p17', 3, 'Se repartieron entre el total del alumnado de la preparatoria 4,455 revistas, si la escuela tiene 495 alumnos ¿Cuántas revistas le correspondieron a cada estudiante si la repartición fue equitativa?', 1),
('rz1p18', 3, 'Al hacer las compras en un supermercado, resultaron los siguientes gastos: $1,300,.00 en ropa; $ 327.292.00 en comestibles y $ 145,200.00 en otros artículos. Si se pago con un cheque de $ 2,000,000.00 ¿Cuál es el cambio que se debe de recibir?', 1),
('rz1p19', 3, 'En una biblioteca hay cuatro libreros, el primero tiene 875 libros, el segundo 974, el tercero1050 y el cuarto596 libros ¿Cuántos libros hay en los cuatro libreros?', 1),
('rz1p20', 3, 'En la compra de un automóvil se gastaron $ 1,375,240.00 de tenencia $175,000.00 por placas más $80,000.00 de impuestos ¿Cuál fue el gasto total?', 1),
('rz1p21', 3, '¿Cuanto se gastará en alambre al colocar doble cerca alrededor de un terreno rectangular que mide 32 metros de largo y 25 metros de ancho, si el metro de alambre cuesta $ 1,500.00?', 1),
('rz1p22', 3, 'Se desea comprar un terreno de forma rectangular que mide 36 metros de largo y 25 metros de ancho ¿Cuánto cuesta el terreno si el metro cuadrado vale $ 48,000.00?', 1),
('rz1p23', 3, 'María Elena gasta $3,285.00 el lunes, $4,127.00 el martes $5,392.00 el miércoles $2,980.00 el jueves y $1,835.00 el viernes ¿Cuánto gasta diariamente en promedio?', 1),
('rz1p24', 3, 'En la compra de una videocasetera se pago con un cheque de $578,500.00. si el valor del aparato es de $735,000.00 más  $110,250.00 de impuestos ¿Cuál es la cantidad que falta para liquidar la videocasetera?', 1),
('rz1p25', 3, 'En la preparatoria se van a construir marcos para 18 láminas de material educativo con la misma forma y dimensiones ¿Cuántos metros de madera se ocuparán si las láminas tienen forma cuadrangular y mide 1.25 metros por lado?', 1),
('rz2p01', 3, 'En la carnicería se compra generalmente:', 2),
('rz2p02', 3, 'El hombre se defiende con sus puños como la abeja con:', 2),
('rz2p03', 3, 'Un libro contiene siempre:', 2),
('rz2p04', 3, 'Octubre es el mes posterior a:', 2),
('rz2p05', 3, 'El gato se defiende con la uñas y el águila con las:', 2),
('rz2p06', 3, 'Bienaventuranza quiere decir:', 2),
('rz2p07', 3, 'En un parque hay siempre:', 2),
('rz2p08', 3, 'Que número continuara de la serie 9,11,13,15,17,19,21,23 (     ):', 2),
('rz2p09', 3, 'Si tienes 12 años y tu hermano mayor tiene dos años menos que el doble de tu edad ¿Qué edad tiene tu hermano?', 2),
('rz2p10', 3, 'Si hoy es jueves ¿Qué día fue anteayer?', 2),
('rz2p11', 3, 'Reloj es a tiempo como termómetro a :', 2),
('rz2p12', 3, '¿Que número multiplicado por dos es igual a tres veces cuatro?', 2),
('rz2p13', 3, '¿Cual de éstas palabras no coinciden con las otras?', 2),
('rz2p14', 3, 'Todos los niños tienen siempre:', 2),
('rz2p15', 3, ' ¿Qué se parece más a gorrión, paloma y gallina?', 2),
('rz2p16', 3, ' Si ordenas los siguientes números en orden creciente ¿ Cual estará junto al mayor?', 2),
('rz2p17', 3, 'Recompensa es a héroe como castigo es a:', 2),
('rz2p18', 3, '¿Qué número aumentado en dos unidades da 12 menos 4? ', 2),
('rz2p19', 3, 'Si ordenas los siguientes números en orden creciente ¿ Cual estará junto al menor?', 2),
('rz2p20', 3, 'Cuando una escritura resulta difícil de leer, se dice que no es:', 2),
('rz2p21', 3, 'Tabaco es a cigarro como vidrio es a:', 2),
('rz2p22', 3, '¿Qué número continuaría de la serie 1,2,4,7,11,16,22? ', 2),
('rz2p23', 3, 'Un camión arranca con dificultad cuando esta demasiado:', 2),
('rz2p24', 3, 'El alcalde rige al municipio como el gobernador a:', 2),
('rz2p25', 3, 'El terciopelo es de:', 2),
('rz2p26', 3, 'El armazón es a la casa como el esqueleto a:', 2),
('rz2p27', 3, 'La hija de la hermana de tu madre es tu:', 2),
('rz2p28', 3, 'Si ordenas debidamente las letras B O A D L A R formaras una de las palabras siguientes:', 2),
('rz2p29', 3, 'Árbol es a bosque como soldado es a:', 2),
('rz2p30', 3, 'En las siguientes series de números ¿Cuántas veces se encuentra en 5 procedido del 3 y seguido del 22?        8 3 5 2 3 5 7 3 5 2 8 1 5 6 3 5 2 4 5 6 3 5 2 9 5 1', 2),
('rz2p31', 3, '¿Qué ser colocarías entre caballo, gorrión y serpiente?', 2),
('rz2p32', 3, 'De las cinco palabras siguientes ¿Cuál liga mejor con gorra, boina y sombrero?', 2),
('rz2p33', 3, 'En la siguiente serie de números ¿Cuántos cuatro van precedidos del 1 y seguidos del 8?      4 1 4 8 6 1 4 3 2 4 6 8 1 4 8 3 2 1 4 8 5', 2),
('rz2p34', 3, 'La lluvia es necesaria para:', 2),
('rz2p35', 3, 'Los faros de los automóviles son necesarios para:', 2),
('rz2p36', 3, 'De las palabras siguientes cual no liga con las otras:', 2),
('rz2p37', 3, 'La hija del padre de tu hermano es tu:', 2),
('rz2p38', 3, '¿Qué número continuaría la serie 1 4 5 8 9 12 13?', 2),
('rz2p39', 3, 'En un banquete hay siempre:', 2),
('rz2p40', 3, '¿Cuál es la palabra que se encuentra antes en el diccionario?', 2),
('rz2p41', 3, '¿Qué número hay que añadir a 11 para obtener una que aventaje a 12 en 2 unidades?', 2),
('rz2p42', 3, '¿Qué palabra de las cinco siguientes, va mejor con mosca, avispa, y mosquito?', 2),
('rz2p43', 3, 'La principal diferencia entre lago y estanque es que aquél es más:', 2),
('rz2p44', 3, 'Pablo es mayor que Juan y éste es mayor que Pedro, en consecuencia Pedro es, con respecto a pablo:', 2),
('rz2p45', 3, '¿Cuál es el número que hay que restar de 67 para que la diferencia sea exactamente divisible entre 8? ', 2),
('rz2p46', 3, 'De las cinco palabras siguientes ¿Cuál liga mejor con silla, mesa y cama?', 2),
('rz2p47', 3, '¿Qué número continuaría de la serie siguiente: 13, 12, 14, 13, 15, 14, 16?', 2),
('rz2p48', 3, '¿Cual de las siguientes palabras no liga con las otras?', 2),
('rz2p49', 3, 'Si ordenas estos números en orden creciente ¿Cuál quedara en medio?', 2),
('rz2p50', 3, 'Monte es a valle como genio es a:', 2),
('rz2p51', 3, '¿Cuántos años hace que Juan tenia 12, si tendrá 17 dentro de 3 años?', 2),
('rz2p52', 3, 'José tiene 5 manzanas y María 4, llega Pablo que no tiene ninguna ¿Cuántas deben darle José y María para que los tres tengan el mismo número de manzanas?', 2),
('rz2p53', 3, 'Si ordenas debidamente la letras N E D A C O, formaras una de las siguientes:', 2),
('rz2p54', 3, 'Un padre comparado con su hijo ¿es siempre más?', 2),
('rz2p55', 3, 'Un hombre para poder vivir debe tener:', 2),
('rz2p56', 3, 'De las cinco palabras siguientes ¿Cuál se parece menos a carpa, gato y gallina?', 2),
('rz2p57', 3, 'Oreja es oír como ojo a:', 2),
('rz2p58', 3, 'Si la madre de María es la tía de Laura ¿Qué parentesco existe entre María y Laura?', 2),
('rz2p59', 3, '¿Qué número continuaría la serie siguiente 3, 4, 7, 8, 11, 12, 15 ? ( )', 2),
('rz2p60', 3, 'Las personas conocidas no son :', 2),
('rz2p61', 3, 'El padre del primo de tu hermano es tu:', 2),
('rz2p62', 3, 'Un vehículo tiene siempre:', 2),
('rz2p63', 3, '¿Qué número continuaría de la serie siguiente 1,2,3,2,3,4,3,4,5?. ( )', 2),
('rz2p64', 3, 'A los guardias se les conoce por sus:', 2),
('rz2p65', 3, '¿Qué número multiplicado por tres da dos unidades menos que 4 veces 5? ( )', 2),
('rz2p66', 3, 'Si la hija de tu madre tiene un hijo ¿ tu padre es respecto de ese niño?', 2),
('rz2p67', 3, 'Si Luisa tiene 12 años y Celia el doble de edad que tenia Luisa hace dos años ¿Cuál es la edad de Celia.? ', 2),
('rz2p68', 3, '¿Qué producto se obtiene al multiplicar 9 por 8, después de restar dos unidades al multiplicado y al multiplicador?.', 2),
('rz2p69', 3, 'De las cinco palabras siguientes ¿Cual liga mejor con violín, piano y órgano?', 2),
('rz2p70', 3, 'El sol se pone hacia el:', 2),
('rz2p71', 3, 'Un equipo ha jugado 19 partidos, si ha ganado 5 más de los que ha perdido y no ha empatado ninguno ¿Cuántos ha ganado?', 2),
('rz2p72', 3, '¿Qué número continuaría la serie siguiente:25,24, 22, 21, 19, 18?', 2),
('rz2p73', 3, 'Pedro es mayor que Jorge y Juan más joven que Santiago, Pedro es mayor que Marco y Juan y Pedro tienen la misma edad, ¿Quién es el mayor?', 2),
('rz2p74', 3, '¿Qué número continua la serie siguiente: 1,4,8,3,12,4,16,5,20?.', 2),
('rz2p75', 3, 'Si colocas en orden de generación a las personas siguientes ¿Cuál quedara en el centro?', 2),
('sec1p01', 2, 'Trabaja usted', 1),
('sec1p02', 2, 'Sus ingresos mensuales son de', 1),
('sec1p03', 2, '¿Cuánto aporta usted al gasto familiar?', 1),
('sec1p04', 2, 'El sostenimiento de la familia depende principalmente de los ingresos de: ', 1),
('sec1p05', 2, 'Estos ingresos provienen principalmente de: ', 1),
('sec1p06', 2, 'El trabajo desarrollado lo realiza en calidad de: ', 1),
('sec1p07', 2, '¿Que escolaridad tiene su madre?', 1),
('sec1p08', 2, 'La vivienda donde vive es:', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `status`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pregunta_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respuesta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `pregunta_id`, `respuesta`, `valor`) VALUES
('ps1-r01', 'ps1p01', 'S', 0),
('ps1-r02', 'ps1p01', 'D', 1),
('ps1-r03', 'ps1p02', 'S', 1),
('ps1-r04', 'ps1p02', 'D', 0),
('ps1-r05', 'ps1p03', 'S', 1),
('ps1-r06', 'ps1p03', 'D', 0),
('ps1-r07', 'ps1p04', 'S', 0),
('ps1-r08', 'ps1p04', 'D', 1),
('ps1-r09', 'ps1p05', 'S', 1),
('ps1-r10', 'ps1p05', 'D', 0),
('ps1-r11', 'ps1p06', 'S', 1),
('ps1-r12', 'ps1p06', 'D', 0),
('ps1-r13', 'ps1p07', 'S', 0),
('ps1-r14', 'ps1p07', 'D', 1),
('ps1-r15', 'ps1p08', 'S', 0),
('ps1-r16', 'ps1p08', 'D', 1),
('ps1-r17', 'ps1p09', 'S', 1),
('ps1-r18', 'ps1p09', 'D', 0),
('ps1-r19', 'ps1p10', 'S', 1),
('ps1-r20', 'ps1p10', 'D', 0),
('ps1-r21', 'ps1p11', 'S', 0),
('ps1-r22', 'ps1p11', 'D', 1),
('ps1-r23', 'ps1p12', 'S', 0),
('ps1-r24', 'ps1p12', 'D', 1),
('ps1-r25', 'ps1p13', 'S', 1),
('ps1-r26', 'ps1p13', 'D', 0),
('ps1-r27', 'ps1p14', 'S', 0),
('ps1-r28', 'ps1p14', 'D', 1),
('ps1-r29', 'ps1p15', 'S', 1),
('ps1-r30', 'ps1p15', 'D', 0),
('ps1-r31', 'ps1p16', 'S', 0),
('ps1-r32', 'ps1p16', 'D', 1),
('ps1-r33', 'ps1p17', 'S', 0),
('ps1-r34', 'ps1p17', 'D', 1),
('ps1-r35', 'ps1p18', 'S', 1),
('ps1-r36', 'ps1p18', 'D', 0),
('ps1-r37', 'ps1p19', 'S', 1),
('ps1-r38', 'ps1p19', 'D', 0),
('ps1-r39', 'ps1p20', 'S', 0),
('ps1-r40', 'ps1p20', 'D', 1),
('ps1-r41', 'ps1p21', 'S', 0),
('ps1-r42', 'ps1p21', 'D', 1),
('ps1-r43', 'ps1p22', 'S', 0),
('ps1-r44', 'ps1p22', 'D', 1),
('ps1-r45', 'ps1p23', 'S', 1),
('ps1-r46', 'ps1p23', 'D', 0),
('ps1-r47', 'ps1p24', 'S', 1),
('ps1-r48', 'ps1p24', 'D', 0),
('ps1-r49', 'ps1p25', 'S', 0),
('ps1-r50', 'ps1p25', 'D', 1),
('ps2-r01', 'ps2p01', 'S', 0),
('ps2-r02', 'ps2p01', 'D', 1),
('ps2-r03', 'ps2p02', 'S', 1),
('ps2-r04', 'ps2p02', 'D', 0),
('ps2-r05', 'ps2p03', 'S', 1),
('ps2-r06', 'ps2p03', 'D', 0),
('ps2-r07', 'ps2p04', 'S', 0),
('ps2-r08', 'ps2p04', 'D', 1),
('ps2-r09', 'ps2p05', 'S', 1),
('ps2-r10', 'ps2p05', 'D', 0),
('ps2-r11', 'ps2p06', 'S', 1),
('ps2-r12', 'ps2p06', 'D', 0),
('ps2-r13', 'ps2p07', 'S', 0),
('ps2-r14', 'ps2p07', 'D', 1),
('ps2-r15', 'ps2p08', 'S', 0),
('ps2-r16', 'ps2p08', 'D', 1),
('ps2-r17', 'ps2p09', 'S', 1),
('ps2-r18', 'ps2p09', 'D', 0),
('ps2-r19', 'ps2p10', 'S', 1),
('ps2-r20', 'ps2p10', 'D', 0),
('ps2-r21', 'ps2p11', 'S', 0),
('ps2-r22', 'ps2p11', 'D', 1),
('ps2-r23', 'ps2p12', 'S', 0),
('ps2-r24', 'ps2p12', 'D', 1),
('ps2-r25', 'ps2p13', 'S', 1),
('ps2-r26', 'ps2p13', 'D', 0),
('ps2-r27', 'ps2p14', 'S', 0),
('ps2-r28', 'ps2p14', 'D', 1),
('ps2-r29', 'ps2p15', 'S', 1),
('ps2-r30', 'ps2p15', 'D', 0),
('ps2-r31', 'ps2p16', 'S', 0),
('ps2-r32', 'ps2p16', 'D', 1),
('ps2-r33', 'ps2p17', 'S', 0),
('ps2-r34', 'ps2p17', 'D', 1),
('ps2-r35', 'ps2p18', 'S', 1),
('ps2-r36', 'ps2p18', 'D', 0),
('ps2-r37', 'ps2p19', 'S', 1),
('ps2-r38', 'ps2p19', 'D', 0),
('ps2-r39', 'ps2p20', 'S', 0),
('ps2-r40', 'ps2p20', 'D', 1),
('ps2-r41', 'ps2p21', 'S', 0),
('ps2-r42', 'ps2p21', 'D', 1),
('ps2-r43', 'ps2p22', 'S', 0),
('ps2-r44', 'ps2p22', 'D', 1),
('ps2-r45', 'ps2p23', 'S', 1),
('ps2-r46', 'ps2p23', 'D', 0),
('ps2-r47', 'ps2p24', 'S', 1),
('ps2-r48', 'ps2p24', 'D', 0),
('ps2-r49', 'ps2p25', 'S', 0),
('ps2-r50', 'ps2p25', 'D', 1),
('ps3-r01', 'ps3p01', 'S', 0),
('ps3-r02', 'ps3p01', 'D', 1),
('ps3-r03', 'ps3p02', 'S', 1),
('ps3-r04', 'ps3p02', 'D', 0),
('ps3-r05', 'ps3p03', 'S', 1),
('ps3-r06', 'ps3p03', 'D', 0),
('ps3-r07', 'ps3p04', 'S', 0),
('ps3-r08', 'ps3p04', 'D', 1),
('ps3-r09', 'ps3p05', 'S', 1),
('ps3-r10', 'ps3p05', 'D', 0),
('ps3-r11', 'ps3p06', 'S', 1),
('ps3-r12', 'ps3p06', 'D', 0),
('ps3-r13', 'ps3p07', 'S', 0),
('ps3-r14', 'ps3p07', 'D', 1),
('ps3-r15', 'ps3p08', 'S', 0),
('ps3-r16', 'ps3p08', 'D', 1),
('ps3-r17', 'ps3p09', 'S', 1),
('ps3-r18', 'ps3p09', 'D', 0),
('ps3-r19', 'ps3p10', 'S', 1),
('ps3-r20', 'ps3p10', 'D', 0),
('ps3-r21', 'ps3p11', 'S', 0),
('ps3-r22', 'ps3p11', 'D', 1),
('ps3-r23', 'ps3p12', 'S', 0),
('ps3-r24', 'ps3p12', 'D', 1),
('ps3-r25', 'ps3p13', 'S', 1),
('ps3-r26', 'ps3p13', 'D', 0),
('ps3-r27', 'ps3p14', 'S', 0),
('ps3-r28', 'ps3p14', 'D', 1),
('ps3-r29', 'ps3p15', 'S', 1),
('ps3-r30', 'ps3p15', 'D', 0),
('ps3-r31', 'ps3p16', 'S', 0),
('ps3-r32', 'ps3p16', 'D', 1),
('ps3-r33', 'ps3p17', 'S', 0),
('ps3-r34', 'ps3p17', 'D', 1),
('ps3-r35', 'ps3p18', 'S', 1),
('ps3-r36', 'ps3p18', 'D', 0),
('ps3-r37', 'ps3p19', 'S', 1),
('ps3-r38', 'ps3p19', 'D', 0),
('ps3-r39', 'ps3p20', 'S', 0),
('ps3-r40', 'ps3p20', 'D', 1),
('ps3-r41', 'ps3p21', 'S', 0),
('ps3-r42', 'ps3p21', 'D', 1),
('ps3-r43', 'ps3p22', 'S', 0),
('ps3-r44', 'ps3p22', 'D', 1),
('ps3-r45', 'ps3p23', 'S', 1),
('ps3-r46', 'ps3p23', 'D', 0),
('ps3-r47', 'ps3p24', 'S', 1),
('ps3-r48', 'ps3p24', 'D', 0),
('ps3-r49', 'ps3p25', 'S', 0),
('ps3-r50', 'ps3p25', 'D', 1),
('ps4-r01', 'ps4p01', 'S', 0),
('ps4-r02', 'ps4p01', 'D', 1),
('ps4-r03', 'ps4p02', 'S', 1),
('ps4-r04', 'ps4p02', 'D', 0),
('ps4-r05', 'ps4p03', 'S', 1),
('ps4-r06', 'ps4p03', 'D', 0),
('ps4-r07', 'ps4p04', 'S', 0),
('ps4-r08', 'ps4p04', 'D', 1),
('ps4-r09', 'ps4p05', 'S', 1),
('ps4-r10', 'ps4p05', 'D', 0),
('ps4-r11', 'ps4p06', 'S', 1),
('ps4-r12', 'ps4p06', 'D', 0),
('ps4-r13', 'ps4p07', 'S', 0),
('ps4-r14', 'ps4p07', 'D', 1),
('ps4-r15', 'ps4p08', 'S', 0),
('ps4-r16', 'ps4p08', 'D', 1),
('ps4-r17', 'ps4p09', 'S', 1),
('ps4-r18', 'ps4p09', 'D', 0),
('ps4-r19', 'ps4p10', 'S', 1),
('ps4-r20', 'ps4p10', 'D', 0),
('ps4-r21', 'ps4p11', 'S', 0),
('ps4-r22', 'ps4p11', 'D', 1),
('ps4-r23', 'ps4p12', 'S', 0),
('ps4-r24', 'ps4p12', 'D', 1),
('ps4-r25', 'ps4p13', 'S', 1),
('ps4-r26', 'ps4p13', 'D', 0),
('ps4-r27', 'ps4p14', 'S', 0),
('ps4-r28', 'ps4p14', 'D', 1),
('ps4-r29', 'ps4p15', 'S', 1),
('ps4-r30', 'ps4p15', 'D', 0),
('ps4-r31', 'ps4p16', 'S', 0),
('ps4-r32', 'ps4p16', 'D', 1),
('ps4-r33', 'ps4p17', 'S', 0),
('ps4-r34', 'ps4p17', 'D', 1),
('ps4-r35', 'ps4p18', 'S', 1),
('ps4-r36', 'ps4p18', 'D', 0),
('ps4-r37', 'ps4p19', 'S', 1),
('ps4-r38', 'ps4p19', 'D', 0),
('ps4-r39', 'ps4p20', 'S', 0),
('ps4-r40', 'ps4p20', 'D', 1),
('ps4-r41', 'ps4p21', 'S', 0),
('ps4-r42', 'ps4p21', 'D', 1),
('ps4-r43', 'ps4p22', 'S', 0),
('ps4-r44', 'ps4p22', 'D', 1),
('ps4-r45', 'ps4p23', 'S', 1),
('ps4-r46', 'ps4p23', 'D', 0),
('ps4-r47', 'ps4p24', 'S', 1),
('ps4-r48', 'ps4p24', 'D', 0),
('ps4-r49', 'ps4p25', 'S', 0),
('ps4-r50', 'ps4p25', 'D', 1),
('ps5-r01', 'ps5p01', 'S', 0),
('ps5-r02', 'ps5p01', 'D', 1),
('ps5-r03', 'ps5p02', 'S', 1),
('ps5-r04', 'ps5p02', 'D', 0),
('ps5-r05', 'ps5p03', 'S', 1),
('ps5-r06', 'ps5p03', 'D', 0),
('ps5-r07', 'ps5p04', 'S', 0),
('ps5-r08', 'ps5p04', 'D', 1),
('ps5-r09', 'ps5p05', 'S', 1),
('ps5-r10', 'ps5p05', 'D', 0),
('ps5-r11', 'ps5p06', 'S', 1),
('ps5-r12', 'ps5p06', 'D', 0),
('ps5-r13', 'ps5p07', 'S', 0),
('ps5-r14', 'ps5p07', 'D', 1),
('ps5-r15', 'ps5p08', 'S', 0),
('ps5-r16', 'ps5p08', 'D', 1),
('ps5-r17', 'ps5p09', 'S', 1),
('ps5-r18', 'ps5p09', 'D', 0),
('ps5-r19', 'ps5p10', 'S', 1),
('ps5-r20', 'ps5p10', 'D', 0),
('ps5-r21', 'ps5p11', 'S', 0),
('ps5-r22', 'ps5p11', 'D', 1),
('ps5-r23', 'ps5p12', 'S', 0),
('ps5-r24', 'ps5p12', 'D', 1),
('ps5-r25', 'ps5p13', 'S', 1),
('ps5-r26', 'ps5p13', 'D', 0),
('ps5-r27', 'ps5p14', 'S', 0),
('ps5-r28', 'ps5p14', 'D', 1),
('ps5-r29', 'ps5p15', 'S', 1),
('ps5-r30', 'ps5p15', 'D', 0),
('ps5-r31', 'ps5p16', 'S', 0),
('ps5-r32', 'ps5p16', 'D', 1),
('ps5-r33', 'ps5p17', 'S', 0),
('ps5-r34', 'ps5p17', 'D', 1),
('ps5-r35', 'ps5p18', 'S', 1),
('ps5-r36', 'ps5p18', 'D', 0),
('ps5-r37', 'ps5p19', 'S', 1),
('ps5-r38', 'ps5p19', 'D', 0),
('ps5-r39', 'ps5p20', 'S', 0),
('ps5-r40', 'ps5p20', 'D', 1),
('ps5-r41', 'ps5p21', 'S', 0),
('ps5-r42', 'ps5p21', 'D', 1),
('ps5-r43', 'ps5p22', 'S', 0),
('ps5-r44', 'ps5p22', 'D', 1),
('ps5-r45', 'ps5p23', 'S', 1),
('ps5-r46', 'ps5p23', 'D', 0),
('ps5-r47', 'ps5p24', 'S', 1),
('ps5-r48', 'ps5p24', 'D', 0),
('ps5-r49', 'ps5p25', 'S', 0),
('ps5-r50', 'ps5p25', 'D', 1),
('ps6-r01', 'ps6p01', 'S', 0),
('ps6-r02', 'ps6p01', 'D', 1),
('ps6-r03', 'ps6p02', 'S', 1),
('ps6-r04', 'ps6p02', 'D', 0),
('ps6-r05', 'ps6p03', 'S', 1),
('ps6-r06', 'ps6p03', 'D', 0),
('ps6-r07', 'ps6p04', 'S', 0),
('ps6-r08', 'ps6p04', 'D', 1),
('ps6-r09', 'ps6p05', 'S', 1),
('ps6-r10', 'ps6p05', 'D', 0),
('ps6-r11', 'ps6p06', 'S', 1),
('ps6-r12', 'ps6p06', 'D', 0),
('ps6-r13', 'ps6p07', 'S', 0),
('ps6-r14', 'ps6p07', 'D', 1),
('ps6-r15', 'ps6p08', 'S', 0),
('ps6-r16', 'ps6p08', 'D', 1),
('ps6-r17', 'ps6p09', 'S', 1),
('ps6-r18', 'ps6p09', 'D', 0),
('ps6-r19', 'ps6p10', 'S', 1),
('ps6-r20', 'ps6p10', 'D', 0),
('ps6-r21', 'ps6p11', 'S', 0),
('ps6-r22', 'ps6p11', 'D', 1),
('ps6-r23', 'ps6p12', 'S', 0),
('ps6-r24', 'ps6p12', 'D', 1),
('ps6-r25', 'ps6p13', 'S', 1),
('ps6-r26', 'ps6p13', 'D', 0),
('ps6-r27', 'ps6p14', 'S', 0),
('ps6-r28', 'ps6p14', 'D', 1),
('ps6-r29', 'ps6p15', 'S', 1),
('ps6-r30', 'ps6p15', 'D', 0),
('ps6-r31', 'ps6p16', 'S', 0),
('ps6-r32', 'ps6p16', 'D', 1),
('ps6-r33', 'ps6p17', 'S', 0),
('ps6-r34', 'ps6p17', 'D', 1),
('ps6-r35', 'ps6p18', 'S', 1),
('ps6-r36', 'ps6p18', 'D', 0),
('ps6-r37', 'ps6p19', 'S', 1),
('ps6-r38', 'ps6p19', 'D', 0),
('ps6-r39', 'ps6p20', 'S', 0),
('ps6-r40', 'ps6p20', 'D', 1),
('ps6-r41', 'ps6p21', 'S', 0),
('ps6-r42', 'ps6p21', 'D', 1),
('ps6-r43', 'ps6p22', 'S', 0),
('ps6-r44', 'ps6p22', 'D', 1),
('ps6-r45', 'ps6p23', 'S', 1),
('ps6-r46', 'ps6p23', 'D', 0),
('ps6-r47', 'ps6p24', 'S', 1),
('ps6-r48', 'ps6p24', 'D', 0),
('ps6-r49', 'ps6p25', 'S', 0),
('ps6-r50', 'ps6p25', 'D', 1),
('rz1-r01', 'rz1p01', 'A) 26,800', 0),
('rz1-r02', 'rz1p01', 'B) 33,500', 1),
('rz1-r03', 'rz1p01', 'C) 3,350', 0),
('rz1-r04', 'rz1p01', 'D) 36,200', 0),
('rz1-r05', 'rz1p01', 'E) Ninguna de estas', 0),
('rz1-r06', 'rz1p02', 'A) 34', 0),
('rz1-r07', 'rz1p02', 'B) 40', 0),
('rz1-r08', 'rz1p02', 'C) 22', 0),
('rz1-r09', 'rz1p02', 'D) 48', 0),
('rz1-r10', 'rz1p02', 'E) Ninguna de estas', 1),
('rz1-r100', 'rz1p20', 'E) Ninguna de estas', 0),
('rz1-r101', 'rz1p21', 'A) $324,000.00', 0),
('rz1-r102', 'rz1p21', 'B) $348,000.00', 0),
('rz1-r103', 'rz1p21', 'C) $339,000.00', 0),
('rz1-r104', 'rz1p21', 'D) $342,000.00', 1),
('rz1-r105', 'rz1p21', 'E) Ninguna de estas', 0),
('rz1-r106', 'rz1p22', 'A) $432,000.00', 0),
('rz1-r107', 'rz1p22', 'B) $452,000.00', 0),
('rz1-r108', 'rz1p22', 'C) $43,200,000.00', 1),
('rz1-r109', 'rz1p22', 'D) $48,250,000.00', 0),
('rz1-r11', 'rz1p03', 'A) 69.675 kgr., ', 1),
('rz1-r110', 'rz1p22', 'E) Ninguna de estas', 0),
('rz1-r111', 'rz1p23', 'A) $35,238.00', 0),
('rz1-r112', 'rz1p23', 'B) $3,428.00', 0),
('rz1-r113', 'rz1p23', 'C) $3,528.80', 1),
('rz1-r114', 'rz1p23', 'D) $4,428.30', 0),
('rz1-r115', 'rz1p23', 'E) Ninguna de estas', 0),
('rz1-r116', 'rz1p24', 'A) $268,250.00', 0),
('rz1-r117', 'rz1p24', 'B) $266,750.00', 1),
('rz1-r118', 'rz1p24', 'C) $845,250.00', 0),
('rz1-r119', 'rz1p24', 'D) $386,250.00', 0),
('rz1-r12', 'rz1p03', 'B) 68.750 kgr.', 0),
('rz1-r120', 'rz1p24', 'E) Ninguna de estas', 0),
('rz1-r121', 'rz1p25', 'A) 90 mts', 1),
('rz1-r122', 'rz1p25', 'B) 50 mts', 0),
('rz1-r123', 'rz1p25', 'C) 70 mts', 0),
('rz1-r124', 'rz1p25', 'D) 80 mts', 0),
('rz1-r125', 'rz1p25', 'E) Ninguna de estas', 0),
('rz1-r13', 'rz1p03', 'C) 72.465 kgr.', 0),
('rz1-r14', 'rz1p03', 'D) 73.125 kgr.', 0),
('rz1-r15', 'rz1p03', 'E) Ninguna de estas', 0),
('rz1-r16', 'rz1p04', 'A) $542.600.00', 0),
('rz1-r17', 'rz1p04', 'B) $588.100.00', 0),
('rz1-r18', 'rz1p04', 'C) $53,760.00', 0),
('rz1-r19', 'rz1p04', 'D) $537.600.00', 1),
('rz1-r20', 'rz1p04', 'E) Ninguna de estas', 0),
('rz1-r21', 'rz1p05', 'A) 54.25 mts', 0),
('rz1-r22', 'rz1p05', 'B) 51 mts', 0),
('rz1-r23', 'rz1p05', 'C) 54 mts', 1),
('rz1-r24', 'rz1p05', 'D) 57.50 mts', 0),
('rz1-r25', 'rz1p05', 'E) Ninguna de estas', 0),
('rz1-r26', 'rz1p06', 'A) $450.00', 0),
('rz1-r27', 'rz1p06', 'B) $4,500.00', 1),
('rz1-r28', 'rz1p06', 'C) $4,850.00, ', 0),
('rz1-r29', 'rz1p06', 'D) $1,800.00', 0),
('rz1-r30', 'rz1p06', 'E) Ninguna de estas', 0),
('rz1-r31', 'rz1p07', 'A) 4 hrs', 1),
('rz1-r32', 'rz1p07', 'B) 9 días', 0),
('rz1-r33', 'rz1p07', 'C) 2hrs', 0),
('rz1-r34', 'rz1p07', 'D) 31 hrs', 0),
('rz1-r35', 'rz1p07', 'E) Ninguna de estas', 0),
('rz1-r36', 'rz1p08', 'A) 4', 0),
('rz1-r37', 'rz1p08', 'B) 18', 0),
('rz1-r38', 'rz1p08', 'C) 36', 1),
('rz1-r39', 'rz1p08', 'D) 28', 0),
('rz1-r40', 'rz1p08', 'E) Ninguna de estas', 0),
('rz1-r41', 'rz1p09', 'A) 3320 cm', 0),
('rz1-r42', 'rz1p09', 'B) 33.02 cm', 1),
('rz1-r43', 'rz1p09', 'C) 32.33 cm', 0),
('rz1-r44', 'rz1p09', 'D) 3120 cm', 0),
('rz1-r45', 'rz1p09', 'E) Ninguna de estas', 0),
('rz1-r46', 'rz1p10', 'A) 86.26 kgr', 1),
('rz1-r47', 'rz1p10', 'B) 862.60 kgr', 0),
('rz1-r48', 'rz1p10', 'C) 890 kgr', 0),
('rz1-r49', 'rz1p10', 'D) 89.28 kgr', 0),
('rz1-r50', 'rz1p10', 'E) Ninguna de estas', 0),
('rz1-r51', 'rz1p11', 'A) 51.27 mts', 0),
('rz1-r52', 'rz1p11', 'B) 512.75 mts', 0),
('rz1-r53', 'rz1p11', 'C) 50.38 mts', 1),
('rz1-r54', 'rz1p11', 'D) 48.22 mts', 0),
('rz1-r55', 'rz1p11', 'E) Ninguna de estas', 0),
('rz1-r56', 'rz1p12', 'A) 32.2711', 0),
('rz1-r57', 'rz1p12', 'B) 29.171', 0),
('rz1-r58', 'rz1p12', 'C) 34.821', 0),
('rz1-r59', 'rz1p12', 'D) 30.281', 1),
('rz1-r60', 'rz1p12', 'E) Ninguna de estas', 0),
('rz1-r61', 'rz1p13', 'A) $9,250.00', 0),
('rz1-r62', 'rz1p13', 'B) $12,325.00', 0),
('rz1-r63', 'rz1p13', 'C) $10,800.00', 1),
('rz1-r64', 'rz1p13', 'D) $11,230.00', 0),
('rz1-r65', 'rz1p13', 'E) Ninguna de estas', 0),
('rz1-r66', 'rz1p14', 'A) 600 mts', 0),
('rz1-r67', 'rz1p14', 'B) 50 mts', 0),
('rz1-r68', 'rz1p14', 'C) 250 mts', 0),
('rz1-r69', 'rz1p14', 'D) 60 mts', 0),
('rz1-r70', 'rz1p14', 'E) Ninguna de estas', 1),
('rz1-r71', 'rz1p15', 'A) $1,510,000.00', 0),
('rz1-r72', 'rz1p15', 'B) $1,610.000.00', 1),
('rz1-r73', 'rz1p15', 'C) $1,830.000.00', 0),
('rz1-r74', 'rz1p15', 'D) $1,415.000.00', 0),
('rz1-r75', 'rz1p15', 'E) Ninguna de estas', 0),
('rz1-r76', 'rz1p16', 'A) $506,000.00', 0),
('rz1-r77', 'rz1p16', 'B) $1,518,000.00', 1),
('rz1-r78', 'rz1p16', 'C) $1,725,000.00', 0),
('rz1-r79', 'rz1p16', 'D) $1,240,000.00', 0),
('rz1-r80', 'rz1p16', 'E) Ninguna de estas', 0),
('rz1-r81', 'rz1p17', 'A) 10', 0),
('rz1-r82', 'rz1p17', 'B) 7', 0),
('rz1-r83', 'rz1p17', 'C) 9', 1),
('rz1-r84', 'rz1p17', 'D) 11', 0),
('rz1-r85', 'rz1p17', 'E) Ninguna de estas', 0),
('rz1-r86', 'rz1p18', 'A) $ 277,508.00', 1),
('rz1-r87', 'rz1p18', 'B) $227,406.00', 0),
('rz1-r88', 'rz1p18', 'C) $238,504.00', 0),
('rz1-r89', 'rz1p18', 'D) $218,309.00', 0),
('rz1-r90', 'rz1p18', 'E) Ninguna de estas', 0),
('rz1-r91', 'rz1p19', 'A) 3492', 0),
('rz1-r92', 'rz1p19', 'B) 3328', 0),
('rz1-r93', 'rz1p19', 'C) 3499', 0),
('rz1-r94', 'rz1p19', 'D) 3412', 0),
('rz1-r95', 'rz1p19', 'E) Ninguna de estas', 1),
('rz1-r96', 'rz1p20', 'A) $1,695,340.00', 0),
('rz1-r97', 'rz1p20', 'B) $1,534,204.00', 0),
('rz1-r98', 'rz1p20', 'C) $1,638,230.00', 0),
('rz1-r99', 'rz1p20', 'D) $1,630,240.00', 1),
('rz2-r01', 'rz2p01', '1) Pan', 0),
('rz2-r02', 'rz2p01', '2) Leche', 0),
('rz2-r03', 'rz2p01', '3) Nata', 0),
('rz2-r04', 'rz2p01', '4) Periódicos', 0),
('rz2-r05', 'rz2p01', '5) Embutidos', 1),
('rz2-r06', 'rz2p02', '1) Aguijon', 1),
('rz2-r07', 'rz2p02', '2) Alas', 0),
('rz2-r08', 'rz2p02', '3) Miel', 0),
('rz2-r09', 'rz2p02', '4) Cera', 0),
('rz2-r10', 'rz2p02', '5) Antenas', 0),
('rz2-r100', 'rz2p20', '5) hermosa', 0),
('rz2-r101', 'rz2p21', '1) botella', 1),
('rz2-r102', 'rz2p21', '2) quebradiza', 0),
('rz2-r103', 'rz2p21', '3) fumador', 0),
('rz2-r104', 'rz2p21', '4) cerilla', 0),
('rz2-r105', 'rz2p21', '5) transparente', 0),
('rz2-r106', 'rz2p22', '1) 23', 0),
('rz2-r107', 'rz2p22', '2) 21', 0),
('rz2-r108', 'rz2p22', '3) 29', 1),
('rz2-r109', 'rz2p22', '4) 26', 0),
('rz2-r11', 'rz2p03', '1) Ilustraciones', 0),
('rz2-r110', 'rz2p22', '5) 25', 0),
('rz2-r111', 'rz2p23', '1) nuevo', 0),
('rz2-r112', 'rz2p23', '2) engrasado', 0),
('rz2-r113', 'rz2p23', '3) recalentado', 0),
('rz2-r114', 'rz2p23', '4) pintado', 0),
('rz2-r115', 'rz2p23', '5) cargado', 1),
('rz2-r116', 'rz2p24', '1) nación', 0),
('rz2-r117', 'rz2p24', '2) provincia', 0),
('rz2-r118', 'rz2p24', '3) estado', 1),
('rz2-r119', 'rz2p24', '4) reino', 0),
('rz2-r12', 'rz2p03', '2) Colores', 0),
('rz2-r120', 'rz2p24', '5) ejercito', 0),
('rz2-r121', 'rz2p25', '1) cuero', 0),
('rz2-r122', 'rz2p25', '2) papel', 0),
('rz2-r123', 'rz2p25', '3) tela', 1),
('rz2-r124', 'rz2p25', '4) cartón', 0),
('rz2-r125', 'rz2p25', '5) madera', 0),
('rz2-r126', 'rz2p26', '1) cráneo', 0),
('rz2-r127', 'rz2p26', '2) cuerpo', 1),
('rz2-r128', 'rz2p26', '3) cabeza', 0),
('rz2-r129', 'rz2p26', '4) brazo', 0),
('rz2-r13', 'rz2p03', '3) Noticias', 0),
('rz2-r130', 'rz2p26', '5) atajo', 0),
('rz2-r131', 'rz2p27', '1) tía', 0),
('rz2-r132', 'rz2p27', '2) sobrina', 0),
('rz2-r133', 'rz2p27', '3) prima', 1),
('rz2-r134', 'rz2p27', '4) madrina', 0),
('rz2-r135', 'rz2p27', '5) cuñada', 0),
('rz2-r136', 'rz2p28', '1) OBRADLE', 0),
('rz2-r137', 'rz2p28', '2) LABRADOR', 0),
('rz2-r138', 'rz2p28', '3) REDOBLE', 0),
('rz2-r139', 'rz2p28', '4) DOBLARA', 1),
('rz2-r14', 'rz2p03', '4) Paginas', 1),
('rz2-r140', 'rz2p28', '5) TRABADO', 0),
('rz2-r141', 'rz2p29', '1) patria', 0),
('rz2-r142', 'rz2p29', '2) victoria', 0),
('rz2-r143', 'rz2p29', '3) batalla', 0),
('rz2-r144', 'rz2p29', '4) ejército', 1),
('rz2-r145', 'rz2p29', '5) guerra', 0),
('rz2-r146', 'rz2p30', '1) 2', 0),
('rz2-r147', 'rz2p30', '2) 8', 0),
('rz2-r148', 'rz2p30', '3) 4', 1),
('rz2-r149', 'rz2p30', '4) 6', 0),
('rz2-r15', 'rz2p03', '5) Fotografías', 0),
('rz2-r150', 'rz2p30', '5) 3', 0),
('rz2-r151', 'rz2p31', '1) piedra', 0),
('rz2-r152', 'rz2p31', '2) hierro', 0),
('rz2-r153', 'rz2p31', '3) árbol', 0),
('rz2-r154', 'rz2p31', '4) gato', 1),
('rz2-r155', 'rz2p31', '5) col', 0),
('rz2-r156', 'rz2p32', '1) bonete', 0),
('rz2-r157', 'rz2p32', '2) pantalón', 1),
('rz2-r158', 'rz2p32', '3) media', 0),
('rz2-r159', 'rz2p32', '4) guante', 0),
('rz2-r16', 'rz2p04', '1) Noviembre', 0),
('rz2-r160', 'rz2p32', '5) vestido', 0),
('rz2-r161', 'rz2p33', '1) 9', 0),
('rz2-r162', 'rz2p33', '2) 6', 0),
('rz2-r163', 'rz2p33', '3) 12', 0),
('rz2-r164', 'rz2p33', '4) 3', 1),
('rz2-r165', 'rz2p33', '5) 7', 0),
('rz2-r166', 'rz2p34', '1) abrir pozos', 0),
('rz2-r167', 'rz2p34', '2) excavar', 0),
('rz2-r168', 'rz2p34', '3) lavar casas', 0),
('rz2-r169', 'rz2p34', '4) limpiar calles', 0),
('rz2-r17', 'rz2p04', '2) Septiembre', 1),
('rz2-r170', 'rz2p34', '5) hacer crecer la cosecha', 1),
('rz2-r171', 'rz2p35', '1) embellecerlos', 0),
('rz2-r172', 'rz2p35', '2) alargarlos', 0),
('rz2-r173', 'rz2p35', '3) aumentar su velocidad', 0),
('rz2-r174', 'rz2p35', '4) aumentar su precio', 0),
('rz2-r175', 'rz2p35', '5) viajar de noche', 1),
('rz2-r176', 'rz2p36', '1) bolígrafo', 0),
('rz2-r177', 'rz2p36', '2) papel', 0),
('rz2-r178', 'rz2p36', '3) pluma', 0),
('rz2-r179', 'rz2p36', '4) mesa', 1),
('rz2-r18', 'rz2p04', '3) Agosto', 0),
('rz2-r180', 'rz2p36', '5) tinta', 0),
('rz2-r181', 'rz2p37', '1) hermana', 1),
('rz2-r182', 'rz2p37', '2) tía', 0),
('rz2-r183', 'rz2p37', '3) sobrina', 0),
('rz2-r184', 'rz2p37', '4) madre', 0),
('rz2-r185', 'rz2p37', '5) prima', 0),
('rz2-r186', 'rz2p38', '1) 12', 0),
('rz2-r187', 'rz2p38', '2) 14', 0),
('rz2-r188', 'rz2p38', '3) 16', 1),
('rz2-r189', 'rz2p38', '4) 10', 0),
('rz2-r19', 'rz2p04', '4) Diciembre', 0),
('rz2-r190', 'rz2p38', '5) 8', 0),
('rz2-r191', 'rz2p39', '1) invitados', 0),
('rz2-r192', 'rz2p39', '2) alegría', 0),
('rz2-r193', 'rz2p39', '3) música', 0),
('rz2-r194', 'rz2p39', '4) comida', 1),
('rz2-r195', 'rz2p39', '5) flores', 0),
('rz2-r196', 'rz2p40', '1) arquero', 0),
('rz2-r197', 'rz2p40', '2) antes', 0),
('rz2-r198', 'rz2p40', '3) área', 0),
('rz2-r199', 'rz2p40', '4) abril', 1),
('rz2-r20', 'rz2p04', '5) Enero', 0),
('rz2-r200', 'rz2p40', '5) armario', 0),
('rz2-r201', 'rz2p41', '1) 8', 0),
('rz2-r202', 'rz2p41', '2) 6', 0),
('rz2-r203', 'rz2p41', '3) 9', 0),
('rz2-r204', 'rz2p41', '4) 3', 1),
('rz2-r205', 'rz2p41', '5) 4', 0),
('rz2-r206', 'rz2p42', '1) alas', 0),
('rz2-r207', 'rz2p42', '2) patas', 0),
('rz2-r208', 'rz2p42', '3) antenas', 0),
('rz2-r209', 'rz2p42', '4) aguijón', 0),
('rz2-r21', 'rz2p05', '1) Alas', 0),
('rz2-r210', 'rz2p42', '5) abeja', 1),
('rz2-r211', 'rz2p43', '1) hermoso', 0),
('rz2-r212', 'rz2p43', '2) grande', 1),
('rz2-r213', 'rz2p43', '3) frio', 0),
('rz2-r214', 'rz2p43', '4) agitado', 0),
('rz2-r215', 'rz2p43', '5) intranquilo', 0),
('rz2-r216', 'rz2p44', '1) menor', 1),
('rz2-r217', 'rz2p44', '2) igual', 0),
('rz2-r218', 'rz2p44', '3) mayor', 0),
('rz2-r219', 'rz2p44', '4) imposible de averiguar', 0),
('rz2-r22', 'rz2p05', '2) Patas', 0),
('rz2-r220', 'rz2p44', '5) Todas', 0),
('rz2-r221', 'rz2p45', '1) 9', 0),
('rz2-r222', 'rz2p45', '2) 6', 0),
('rz2-r223', 'rz2p45', '3) 2', 1),
('rz2-r224', 'rz2p45', '4) 3', 0),
('rz2-r225', 'rz2p45', '5) 8', 0),
('rz2-r226', 'rz2p46', '1) cojín', 0),
('rz2-r227', 'rz2p46', '2) armario', 1),
('rz2-r228', 'rz2p46', '3) tela', 0),
('rz2-r229', 'rz2p46', '4) cortina', 0),
('rz2-r23', 'rz2p05', '3) Garras', 1),
('rz2-r230', 'rz2p46', '5) alfombra', 0),
('rz2-r231', 'rz2p47', '1) 15', 1),
('rz2-r232', 'rz2p47', '2) 14', 0),
('rz2-r233', 'rz2p47', '3) 20', 0),
('rz2-r234', 'rz2p47', '4) 11', 0),
('rz2-r235', 'rz2p47', '5) 16', 0),
('rz2-r236', 'rz2p48', '1) leche', 0),
('rz2-r237', 'rz2p48', '2) té', 0),
('rz2-r238', 'rz2p48', '3) café', 0),
('rz2-r239', 'rz2p48', '4) natilla', 0),
('rz2-r24', 'rz2p05', '4) Gritos', 0),
('rz2-r240', 'rz2p48', '5) mantequilla', 1),
('rz2-r241', 'rz2p49', '1) 8741', 1),
('rz2-r242', 'rz2p49', '2) 8733', 0),
('rz2-r243', 'rz2p49', '3) 8765', 0),
('rz2-r244', 'rz2p49', '4) 8790', 0),
('rz2-r245', 'rz2p49', '5) 8726', 0),
('rz2-r246', 'rz2p50', '1) medico', 0),
('rz2-r247', 'rz2p50', '2) comerciante', 0),
('rz2-r248', 'rz2p50', '3) periodista', 0),
('rz2-r249', 'rz2p50', '4) vendedor', 0),
('rz2-r25', 'rz2p05', '5) Plumas', 0),
('rz2-r250', 'rz2p50', '5) idiota', 1),
('rz2-r251', 'rz2p51', '1) 15', 0),
('rz2-r252', 'rz2p51', '2) 11', 0),
('rz2-r253', 'rz2p51', '3) 12', 0),
('rz2-r254', 'rz2p51', '4) 3', 0),
('rz2-r255', 'rz2p51', '5) 2', 1),
('rz2-r256', 'rz2p52', '1) 2', 0),
('rz2-r257', 'rz2p52', '2) 1', 0),
('rz2-r258', 'rz2p52', '3) 3', 1),
('rz2-r259', 'rz2p52', '4) 6', 0),
('rz2-r26', 'rz2p06', '1) Felicidad', 1),
('rz2-r260', 'rz2p52', '5) 4', 0),
('rz2-r261', 'rz2p53', '1) Senado', 0),
('rz2-r262', 'rz2p53', '2) Niceo', 0),
('rz2-r263', 'rz2p53', '3) Cerado', 0),
('rz2-r264', 'rz2p53', '4) Decimo', 0),
('rz2-r265', 'rz2p53', '5) Decano', 1),
('rz2-r266', 'rz2p54', '1) Pesado', 0),
('rz2-r267', 'rz2p54', '2) Viejo', 1),
('rz2-r268', 'rz2p54', '3) Grande', 0),
('rz2-r269', 'rz2p54', '4) Fuerte', 0),
('rz2-r27', 'rz2p06', '2) Tristeza', 0),
('rz2-r270', 'rz2p54', '5) Instruido', 0),
('rz2-r271', 'rz2p55', '1) Dientes', 0),
('rz2-r272', 'rz2p55', '2) Gafas', 0),
('rz2-r273', 'rz2p55', '3) Nariz', 0),
('rz2-r274', 'rz2p55', '4) Corazón', 1),
('rz2-r275', 'rz2p55', '5) Cabello', 0),
('rz2-r276', 'rz2p56', '1) Perro', 0),
('rz2-r277', 'rz2p56', '2) Piedra', 1),
('rz2-r278', 'rz2p56', '3) Gorrión', 0),
('rz2-r279', 'rz2p56', '4) Trucha', 0),
('rz2-r28', 'rz2p06', '3) Costumbres', 0),
('rz2-r280', 'rz2p56', '5) Asno', 0),
('rz2-r281', 'rz2p57', '1) Luz', 0),
('rz2-r282', 'rz2p57', '2) Parpado', 0),
('rz2-r283', 'rz2p57', '3) Escuchar', 0),
('rz2-r284', 'rz2p57', '4) Guiñar', 0),
('rz2-r285', 'rz2p57', '5) Ver', 1),
('rz2-r286', 'rz2p58', '1) Prima', 1),
('rz2-r287', 'rz2p58', '2) Hermana', 0),
('rz2-r288', 'rz2p58', '3) Madre', 0),
('rz2-r289', 'rz2p58', '4) Tía', 0),
('rz2-r29', 'rz2p06', '4) Solicitud', 0),
('rz2-r290', 'rz2p58', '5) Nieta', 0),
('rz2-r291', 'rz2p59', '1) 8', 0),
('rz2-r292', 'rz2p59', '2) 12', 0),
('rz2-r293', 'rz2p59', '3) 16', 1),
('rz2-r294', 'rz2p59', '4) 14', 0),
('rz2-r295', 'rz2p59', '5) 17', 0),
('rz2-r296', 'rz2p60', '1) Hermosas', 0),
('rz2-r297', 'rz2p60', '2) Detestables', 0),
('rz2-r298', 'rz2p60', '3) Desconocidas', 1),
('rz2-r299', 'rz2p60', '4) Narrativas', 0),
('rz2-r30', 'rz2p06', '5) Multitud', 0),
('rz2-r300', 'rz2p60', '5) Animosas', 0),
('rz2-r301', 'rz2p61', '1) Primo', 0),
('rz2-r302', 'rz2p61', '2) Abuelo', 0),
('rz2-r303', 'rz2p61', '3) Tío', 1),
('rz2-r304', 'rz2p61', '4) Hermano', 0),
('rz2-r305', 'rz2p61', '5) Sobrino', 0),
('rz2-r306', 'rz2p62', '1) Puertas', 0),
('rz2-r307', 'rz2p62', '2) Caballo', 0),
('rz2-r308', 'rz2p62', '3) Conductor', 0),
('rz2-r309', 'rz2p62', '4) Ruedas', 1),
('rz2-r31', 'rz2p07', '1) Quiosco', 0),
('rz2-r310', 'rz2p62', '5) Frenos', 0),
('rz2-r311', 'rz2p63', '1) 6', 0),
('rz2-r312', 'rz2p63', '2) 4', 1),
('rz2-r313', 'rz2p63', '3) 8', 0),
('rz2-r314', 'rz2p63', '4) 12', 0),
('rz2-r315', 'rz2p63', '5) 7', 0),
('rz2-r316', 'rz2p64', '1) Esposas', 0),
('rz2-r317', 'rz2p64', '2) Guantes', 0),
('rz2-r318', 'rz2p64', '3) Gafas', 0),
('rz2-r319', 'rz2p64', '4) Uniformes', 1),
('rz2-r32', 'rz2p07', '2) Orquesta', 0),
('rz2-r320', 'rz2p64', '5) Silbato', 0),
('rz2-r321', 'rz2p65', '1) 4', 0),
('rz2-r322', 'rz2p65', '2) 8', 0),
('rz2-r323', 'rz2p65', '3) 6', 1),
('rz2-r324', 'rz2p65', '4) 12', 0),
('rz2-r325', 'rz2p65', '5) 10', 0),
('rz2-r326', 'rz2p66', '1) Tío', 0),
('rz2-r327', 'rz2p66', '2) Primo', 0),
('rz2-r328', 'rz2p66', '3) Sobrino', 0),
('rz2-r329', 'rz2p66', '4) Suegro', 0),
('rz2-r33', 'rz2p07', '3) Árboles', 1),
('rz2-r330', 'rz2p66', '5) Abuelo', 1),
('rz2-r331', 'rz2p67', '1) 24', 0),
('rz2-r332', 'rz2p67', '2) 22', 0),
('rz2-r333', 'rz2p67', '3) 18', 0),
('rz2-r334', 'rz2p67', '4) 26', 0),
('rz2-r335', 'rz2p67', '5) 20', 1),
('rz2-r336', 'rz2p68', '1) 72', 0),
('rz2-r337', 'rz2p68', '2) 48', 0),
('rz2-r338', 'rz2p68', '3) 26', 0),
('rz2-r339', 'rz2p68', '4) 42', 1),
('rz2-r34', 'rz2p07', '4) Vehículos', 0),
('rz2-r340', 'rz2p68', '5) 56', 0),
('rz2-r341', 'rz2p69', '1) Clarinete', 1),
('rz2-r342', 'rz2p69', '2) Concierto', 0),
('rz2-r343', 'rz2p69', '3) Música', 0),
('rz2-r344', 'rz2p69', '4) Orquesta', 0),
('rz2-r345', 'rz2p69', '5) Sonido', 0),
('rz2-r346', 'rz2p70', '1) Norte', 0),
('rz2-r347', 'rz2p70', '2) Sur', 0),
('rz2-r348', 'rz2p70', '3) Este', 0),
('rz2-r349', 'rz2p70', '4) Oeste', 1),
('rz2-r35', 'rz2p07', '5) Estanque', 0),
('rz2-r350', 'rz2p70', '5) Polo', 0),
('rz2-r351', 'rz2p71', '1) 16', 0),
('rz2-r352', 'rz2p71', '2) 12', 1),
('rz2-r353', 'rz2p71', '3) 14', 0),
('rz2-r354', 'rz2p71', '4) 18', 0),
('rz2-r355', 'rz2p71', '5) 22', 0),
('rz2-r356', 'rz2p72', '1) 24', 0),
('rz2-r357', 'rz2p72', '2) 32', 0),
('rz2-r358', 'rz2p72', '3) 16', 1),
('rz2-r359', 'rz2p72', '4) 14', 0),
('rz2-r36', 'rz2p08', '1) 25', 1),
('rz2-r360', 'rz2p72', '5) 12', 0),
('rz2-r361', 'rz2p73', '1) Pedro', 0),
('rz2-r362', 'rz2p73', '2) Jorge', 0),
('rz2-r363', 'rz2p73', '3) Juan', 0),
('rz2-r364', 'rz2p73', '4) Santiago', 1),
('rz2-r365', 'rz2p73', '5) Marco', 0),
('rz2-r366', 'rz2p74', '1) 8', 0),
('rz2-r367', 'rz2p74', '2) 2', 0),
('rz2-r368', 'rz2p74', '3) 4', 0),
('rz2-r369', 'rz2p74', '4) 6', 1),
('rz2-r37', 'rz2p08', '2) 19', 0),
('rz2-r370', 'rz2p74', '5) 2', 0),
('rz2-r371', 'rz2p75', '1) Padre', 0),
('rz2-r372', 'rz2p75', '2) Hijo', 0),
('rz2-r373', 'rz2p75', '3) Abuelo', 1),
('rz2-r374', 'rz2p75', '4) Bisabuelo', 0),
('rz2-r375', 'rz2p75', '5) Tatarabuelo', 0),
('rz2-r38', 'rz2p08', '3) 23', 0),
('rz2-r39', 'rz2p08', '4) 16', 0),
('rz2-r40', 'rz2p08', '5) 27', 0),
('rz2-r41', 'rz2p09', '1) 24', 0),
('rz2-r42', 'rz2p09', '2) 20', 0),
('rz2-r43', 'rz2p09', '3) 26', 0),
('rz2-r44', 'rz2p09', '4) 28', 0),
('rz2-r45', 'rz2p09', '5) 22', 1),
('rz2-r46', 'rz2p10', '1) sábado', 0),
('rz2-r47', 'rz2p10', '2) martes', 1),
('rz2-r48', 'rz2p10', '3) lunes', 0),
('rz2-r49', 'rz2p10', '4) viernes', 0),
('rz2-r50', 'rz2p10', '5) miércoles', 0),
('rz2-r51', 'rz2p11', '1) calor', 0),
('rz2-r52', 'rz2p11', '2) frio', 0),
('rz2-r53', 'rz2p11', '3) mercurio', 0),
('rz2-r54', 'rz2p11', '4) alcohol', 0),
('rz2-r55', 'rz2p11', '5) temperatura', 1),
('rz2-r56', 'rz2p12', '1) 8', 0),
('rz2-r57', 'rz2p12', '2) 16', 0),
('rz2-r58', 'rz2p12', '3) 6', 1),
('rz2-r59', 'rz2p12', '4) 12', 0),
('rz2-r60', 'rz2p12', '5) 9', 0),
('rz2-r61', 'rz2p13', '1) patata', 0),
('rz2-r62', 'rz2p13', '2) pan', 0),
('rz2-r63', 'rz2p13', '3) cocina', 1),
('rz2-r64', 'rz2p13', '4) pastel', 0),
('rz2-r65', 'rz2p13', '5) manzana', 0),
('rz2-r66', 'rz2p14', '1) hermanos', 0),
('rz2-r67', 'rz2p14', '2) juguetes', 0),
('rz2-r68', 'rz2p14', '3) camisa', 0),
('rz2-r69', 'rz2p14', '4) sombrero', 0),
('rz2-r70', 'rz2p14', '5) cabeza', 1),
('rz2-r71', 'rz2p15', '1) pluma', 0),
('rz2-r72', 'rz2p15', '2) pico', 0),
('rz2-r73', 'rz2p15', '3) pato', 1),
('rz2-r74', 'rz2p15', '4) alas', 0),
('rz2-r75', 'rz2p15', '5) nido', 0),
('rz2-r76', 'rz2p16', '1) 4238', 0),
('rz2-r77', 'rz2p16', '2) 8623', 0),
('rz2-r78', 'rz2p16', '3) 7932', 0),
('rz2-r79', 'rz2p16', '4) 7965', 0),
('rz2-r80', 'rz2p16', '5) 8612', 1),
('rz2-r81', 'rz2p17', '1) disciplina', 0),
('rz2-r82', 'rz2p17', '2) penitencia', 0),
('rz2-r83', 'rz2p17', '3) policía', 0),
('rz2-r84', 'rz2p17', '4) vigilancia', 0),
('rz2-r85', 'rz2p17', '5) cobarde', 1),
('rz2-r86', 'rz2p18', '1) 10', 0),
('rz2-r87', 'rz2p18', '2) 12', 0),
('rz2-r88', 'rz2p18', '3) 6', 1),
('rz2-r89', 'rz2p18', '4) 14', 0),
('rz2-r90', 'rz2p18', '5) 4', 0),
('rz2-r91', 'rz2p19', '1) 2641', 1),
('rz2-r92', 'rz2p19', '2) 5315', 0),
('rz2-r93', 'rz2p19', '3) 5369', 0),
('rz2-r94', 'rz2p19', '4) 2631', 0),
('rz2-r95', 'rz2p19', '5) 4918', 0),
('rz2-r96', 'rz2p20', '1) aplicada', 0),
('rz2-r97', 'rz2p20', '2) legible', 1),
('rz2-r98', 'rz2p20', '3) cuidada', 0),
('rz2-r99', 'rz2p20', '4) limpia', 0),
('sec1-r01', 'sec1p01', 'A) No', 1),
('sec1-r02', 'sec1p01', 'B) Ocasionalmente', 2),
('sec1-r03', 'sec1p01', 'C) Si', 3),
('sec1-r04', 'sec1p02', 'A) De $2000 a $2500', 3),
('sec1-r05', 'sec1p02', 'B) Menos de $1000', 1),
('sec1-r06', 'sec1p02', 'C) De $1000 a $1500', 2),
('sec1-r07', 'sec1p03', 'A) Nada', 1),
('sec1-r08', 'sec1p03', 'B) De $1000 a $1500', 3),
('sec1-r09', 'sec1p03', 'C) Menos de $1000', 2),
('sec1-r10', 'sec1p04', 'A) Padres', 2),
('sec1-r11', 'sec1p04', 'B) Uno o varios hermanos', 3),
('sec1-r12', 'sec1p04', 'C) De mi', 1),
('sec1-r13', 'sec1p05', 'A) Negocio propio', 2),
('sec1-r14', 'sec1p05', 'B) Una pensión o jubilación', 3),
('sec1-r15', 'sec1p05', 'C) Salario', 1),
('sec1-r16', 'sec1p06', 'A) Oficinista, trabajador admirativo o empleado de una dependencia pública', 3),
('sec1-r17', 'sec1p06', 'B) Dependiente de comercio', 2),
('sec1-r18', 'sec1p06', 'C) Obrero o ayudante', 1),
('sec1-r19', 'sec1p07', 'A) Licenciatura', 3),
('sec1-r20', 'sec1p07', 'B) Preparatoria', 2),
('sec1-r21', 'sec1p07', 'C) Primaria', 1),
('sec1-r22', 'sec1p08', 'A) Propia', 3),
('sec1-r23', 'sec1p08', 'B) Prestada', 2),
('sec1-r24', 'sec1p08', 'C) Rentada', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alumno_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodo_eval_id` bigint(20) UNSIGNED NOT NULL,
  `psicometrico_I` int(11) NOT NULL DEFAULT '0',
  `psicometrico_II` int(11) NOT NULL DEFAULT '0',
  `psicometrico_III` int(11) NOT NULL DEFAULT '0',
  `psicometrico_IV` int(11) NOT NULL DEFAULT '0',
  `psicometrico_V` int(11) NOT NULL DEFAULT '0',
  `psicometrico_VI` int(11) NOT NULL DEFAULT '0',
  `razonamiento` int(11) NOT NULL DEFAULT '0',
  `socioeconomico` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`id`, `alumno_id`, `periodo_eval_id`, `psicometrico_I`, `psicometrico_II`, `psicometrico_III`, `psicometrico_IV`, `psicometrico_V`, `psicometrico_VI`, `razonamiento`, `socioeconomico`) VALUES
(1, '173S0016', 1, 0, 0, 0, 0, 0, 0, 0, 17),
(2, '173S0019', 1, 0, 0, 0, 0, 0, 0, 0, 0),
(3, '123456', 1, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-02-16 09:42:11', '2022-02-16 09:42:11'),
(2, 'tutor', 'web', '2022-02-16 09:42:11', '2022-02-16 09:42:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(9, 1),
(7, 2),
(8, 2),
(9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semaforo`
--

CREATE TABLE `semaforo` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fondo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `semaforo`
--

INSERT INTO `semaforo` (`id`, `nombre`, `fondo`, `color`) VALUES
(1, 'Verde', '#02B010', '#FFFFFF'),
(2, 'Amarillo', '#F2CE00', '#000000'),
(3, 'Rojo', '#E60000', '#FFFFFF'),
(4, 'sin', '#', '#'),
(5, 'violeta', '#81007F', '#'),
(6, 'azul', '#343399', '#');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutores`
--

CREATE TABLE `tutores` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrera_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_paterno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_materno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tutores`
--

INSERT INTO `tutores` (`id`, `carrera_id`, `nombre`, `ap_paterno`, `ap_materno`, `sexo`, `telefono`, `domicilio`, `foto`) VALUES
('17212F', 2, 'Robert', 'Rivera', 'Lopez', 'M', '798-798-7987', 'Las Lajitas Tantoyuca, Ver.', '/tutores/tutor-20220226-220319.png'),
('173S0018', 2, 'Ing. Susan', 'Lopez', 'Santana', 'F', '789-108-6450', 'Las Lajitas Tantoyuca, Ver.', '/tutores/tutor-20220328-184154.png'),
('173S0020', 2, 'Zuky', 'Lopez', 'Santana', 'M', '789-108-6450', 'Las Lajitas Tantoyuca, Ver.', '/tutores/tutor-20220327-042911.png'),
('173S0021', 2, 'kasy', 'Lopez', 'Santana', 'F', '789-108-6450', 'Las Lajitas Tantoyuca, Ver.', '/tutores/tutor-20220327-043137.png'),
('Admin01', NULL, 'Admin', 'Orientacion', 'Educativa', 'm', '7711544280', 'Tantoyuca', '/tutores/tutor-20211204-203909.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tutor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `tutor_id`) VALUES
(1, 'Admin', 'orientacion14educativa@gmail.com', NULL, '$2y$10$KZE/gfti0n9yBnuGD93Df.MrxHSGEdrsIcAMhN1hM259a7L4UJjs6', NULL, '2022-02-16 09:42:11', '2022-02-16 09:42:11', 'Admin01'),
(2, 'Ing. Susan', 'soportecpz14@gmail.com', NULL, '$2y$10$9F4E7UUjT/k0tBD3z6KRuew6M403fsE6n92Ys2CJeZTq26uAllhQi', '9BMX4o17sYtFS77UkSzsCMnHb0Y8NXstm9zLQ7HyTI56LnSOhD70ojSo9UBj', '2022-02-22 09:17:24', '2022-03-29 00:42:00', '173S0018'),
(3, 'Robert', 'soportecpz15@gmail.com', NULL, '$2y$10$e1nJ/XN.Mid5lxFMEJP.ue7Y1D6N1.jUdgKI5n/UAtZ2roUiTwM0S', NULL, '2022-02-27 04:03:19', '2022-02-27 04:03:19', '17212F'),
(4, 'Zuky', 'soportecpz16@gmail.com', NULL, '$2y$10$HgqWXjp9IZh6l02jdnQyduOpEwVLitfWcaojLbcy6E3RTmxz.5A6y', NULL, '2022-03-27 10:29:11', '2022-03-27 10:29:11', '173S0020'),
(5, 'kasy', 'soportecpz18@gmail.com', NULL, '$2y$10$/wOUzTAMK6XbtIeBwwme2ep7QSM5s8to35IcbnDt09p8/fxSfpA4W', NULL, '2022-03-27 10:31:37', '2022-03-27 21:40:36', '173S0021');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `altera_entrega`
--
ALTER TABLE `altera_entrega`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumnos_carrera_id_foreign` (`carrera_id`);

--
-- Indices de la tabla `alumnos_examenes`
--
ALTER TABLE `alumnos_examenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumnos_examenes_carrera_id_foreign` (`carrera_id`),
  ADD KEY `alumnos_examenes_periodo_eval_id_foreign` (`periodo_eval_id`);

--
-- Indices de la tabla `asignacion_tutor`
--
ALTER TABLE `asignacion_tutor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asignacion_tutor_tutor_id_foreign` (`tutor_id`),
  ADD KEY `asignacion_tutor_periodo_id_foreign` (`periodo_id`);

--
-- Indices de la tabla `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `control_materias`
--
ALTER TABLE `control_materias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `control_materias_periodo_id_foreign` (`periodo_id`),
  ADD KEY `control_materias_materia_id_foreign` (`materia_id`),
  ADD KEY `control_materias_alumno_id_foreign` (`alumno_id`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluacion_respuesta`
--
ALTER TABLE `evaluacion_respuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluacion_respuesta_alumno_id_foreign` (`alumno_id`),
  ADD KEY `evaluacion_respuesta_pregunta_id_foreign` (`pregunta_id`),
  ADD KEY `evaluacion_respuesta_respuesta_id_foreign` (`respuesta_id`),
  ADD KEY `evaluacion_respuesta_periodo_eval_id_foreign` (`periodo_eval_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `file_format`
--
ALTER TABLE `file_format`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materias_carrera_id_foreign` (`carrera_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `periodo_eval`
--
ALTER TABLE `periodo_eval`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `periodo_tutorado`
--
ALTER TABLE `periodo_tutorado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periodo_tutorado_periodo_id_foreign` (`periodo_id`),
  ADD KEY `periodo_tutorado_tutor_id_foreign` (`tutor_id`),
  ADD KEY `periodo_tutorado_alumno_id_foreign` (`alumno_id`),
  ADD KEY `periodo_tutorado_semaforo_id_foreign` (`semaforo_id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `posiciones`
--
ALTER TABLE `posiciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posiciones_alumno_id_foreign` (`alumno_id`),
  ADD KEY `posiciones_color_id_foreign` (`color_id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preguntas_evaluacion_id_foreign` (`evaluacion_id`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respuestas_pregunta_id_foreign` (`pregunta_id`);

--
-- Indices de la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resultados_alumno_id_foreign` (`alumno_id`),
  ADD KEY `resultados_periodo_eval_id_foreign` (`periodo_eval_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `semaforo`
--
ALTER TABLE `semaforo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tutores`
--
ALTER TABLE `tutores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutores_carrera_id_foreign` (`carrera_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_tutor_id_foreign` (`tutor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `altera_entrega`
--
ALTER TABLE `altera_entrega`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnos_examenes`
--
ALTER TABLE `alumnos_examenes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `asignacion_tutor`
--
ALTER TABLE `asignacion_tutor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `control_materias`
--
ALTER TABLE `control_materias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `evaluacion_respuesta`
--
ALTER TABLE `evaluacion_respuesta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `file_format`
--
ALTER TABLE `file_format`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `periodo_eval`
--
ALTER TABLE `periodo_eval`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `periodo_tutorado`
--
ALTER TABLE `periodo_tutorado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posiciones`
--
ALTER TABLE `posiciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_carrera_id_foreign` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alumnos_examenes`
--
ALTER TABLE `alumnos_examenes`
  ADD CONSTRAINT `alumnos_examenes_carrera_id_foreign` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alumnos_examenes_periodo_eval_id_foreign` FOREIGN KEY (`periodo_eval_id`) REFERENCES `periodo_eval` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asignacion_tutor`
--
ALTER TABLE `asignacion_tutor`
  ADD CONSTRAINT `asignacion_tutor_periodo_id_foreign` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asignacion_tutor_tutor_id_foreign` FOREIGN KEY (`tutor_id`) REFERENCES `tutores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `control_materias`
--
ALTER TABLE `control_materias`
  ADD CONSTRAINT `control_materias_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `control_materias_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `control_materias_periodo_id_foreign` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `evaluacion_respuesta`
--
ALTER TABLE `evaluacion_respuesta`
  ADD CONSTRAINT `evaluacion_respuesta_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluacion_respuesta_periodo_eval_id_foreign` FOREIGN KEY (`periodo_eval_id`) REFERENCES `periodo_eval` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluacion_respuesta_pregunta_id_foreign` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluacion_respuesta_respuesta_id_foreign` FOREIGN KEY (`respuesta_id`) REFERENCES `respuestas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_carrera_id_foreign` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `periodo_tutorado`
--
ALTER TABLE `periodo_tutorado`
  ADD CONSTRAINT `periodo_tutorado_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `periodo_tutorado_periodo_id_foreign` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `periodo_tutorado_semaforo_id_foreign` FOREIGN KEY (`semaforo_id`) REFERENCES `semaforo` (`id`),
  ADD CONSTRAINT `periodo_tutorado_tutor_id_foreign` FOREIGN KEY (`tutor_id`) REFERENCES `tutores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `posiciones`
--
ALTER TABLE `posiciones`
  ADD CONSTRAINT `posiciones_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posiciones_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_evaluacion_id_foreign` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluaciones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_pregunta_id_foreign` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `resultados_alumno_id_foreign` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultados_periodo_eval_id_foreign` FOREIGN KEY (`periodo_eval_id`) REFERENCES `periodo_eval` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tutores`
--
ALTER TABLE `tutores`
  ADD CONSTRAINT `tutores_carrera_id_foreign` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
