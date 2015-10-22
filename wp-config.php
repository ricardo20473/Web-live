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
define('AUTH_KEY', '2E@Jpm]HdaFzBio-,WM%C@/s92gs/ssTNj_x,CU}fwag.MF&OSqK9}-*l0j)|I3w');
define('SECURE_AUTH_KEY', 'T_-F?yjaUc`,}fC|+WMQhMGULbx_~i*lrrAu+S?GE7-##_w=_hbk|spnz8>g7EeH');
define('LOGGED_IN_KEY', '?mrU+w9NGY-}IVJ,,N%tl1ICWWLO NiM18IV)DN[:$qF6AS`p]o8dxMqKntIq?x8');
define('NONCE_KEY', '-B(q:#a,kY5|y{aNg0uIY`M$=R7XXKMa4.=*2XdM-E|tLf*I-I.[:NeN1B:3=% z');
define('AUTH_SALT', 'D4xtk+bqAQ;IU}T):tpX6R;dp9:WGQ^A.2(sA=>7svLp(Az5x8-^n`<wz-Vl&#>z');
define('SECURE_AUTH_SALT', '37?}R+ujz;tZxyC!ibc;foj|@EN07VNmtKuMjv4.sh5S_F8?eP +S<sK A=+_jE>');
define('LOGGED_IN_SALT', '-a vL/Bw[vcvLG (|=6%F8]B3x*%E#?6LrpG4*+ycxA6d`+|_[_/RXdo<Ysg 1)B');
define('NONCE_SALT', '6V=6<|u-,1)r3B::/DHxH3BhFc|)-Ub}/4A7~X5XH8FX{kv0n++;]R+j9qR~-c.,');

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
define('FS_METHOD','direct');

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

