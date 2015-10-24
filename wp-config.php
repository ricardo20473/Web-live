<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'wordpress');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '1234');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'wex-$5E$sG`^@J$83s%N[9?`!{B5%@EXDeM)dH Lf#gxWwFd3@Iq4+e cR-QeLld');
define('SECURE_AUTH_KEY', 'y,}1 R^ZEc#>o#8L%YR&P.aCPn2cri+2nUltb4uZ:mpT(*&J|pvOmpWq_FDUQN%D');
define('LOGGED_IN_KEY', 'Mu,`,^$1=j-p`?i}Pms=wowjYzSJO^sa<0c5JW9QvLmp1|tVYIciEh_a!ZrQjdN/');
define('NONCE_KEY', 'iPWo0H =dl)_y`g_sssj~Z/BK9Ye:QB?#W0NgG00uB~[OllBu`=<B46[3]g%~>x%');
define('AUTH_SALT', 'pP[7;x^$Dr/]o@Dek+^OXR{DJaAnAr{yuNg]sMvKw25FP>z|2bVZ5`aNyo.L#@@W');
define('SECURE_AUTH_SALT', '*X!<od_V/xR[>U2o-RhA|*=,NCQjUfT]C+wG[_RvkEiu|&s/-,Ns(Myy6N,>P?t1');
define('LOGGED_IN_SALT', 'Vu~h32J<^kHhT/pMTe;T7~zV X]bgyLPm,% CJ5?ln&B=W$4U-76bye*a{>=?!V[');
define('NONCE_SALT', ',&~FGc)&>ts4MOu,vW t(!([e*m~5hp1GP&Z0db]fISZ(4{#e-lINDv$oe>->3)g');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

