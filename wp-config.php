<?php

   /**
    * The base configurations of the WordPress.
    *
    * This file has the following configurations: MySQL settings, Table Prefix,
    * Secret Keys, WordPress Language, and ABSPATH. You can find more information
    * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
    * wp-config.php} Codex page. You can get the MySQL settings from your web host.
    *
    * This file is used by the wp-config.php creation script during the
    * installation. You don't have to use the web site, you can just copy this file
    * to "wp-config.php" and fill in the values.
    *
    * @package WordPress
    */
// ** MySQL settings - You can get this info from your web host ** //
   /** The name of the database for WordPress */
    define( 'WP_MEMORY_LIMIT', '64M' );
    
   define('DB_NAME', 'wordpress');

   /** MySQL database username */
   define('DB_USER', 'wrench');

   /** MySQL database password */
   define('DB_PASSWORD', 'teacup123');

   /** MySQL hostname */
   define('DB_HOST', 'localhost');

   /** Database Charset to use in creating database tables. */
   define('DB_CHARSET', 'utf8');

   /** The Database Collate type. Don't change this if in doubt. */
   define('DB_COLLATE', '');

   define('EMPTY_TRASH_DAYS', 7);

   define('WP_POST_REVISIONS', 2);
   /*    * #@+
    * Authentication Unique Keys and Salts.
    *
    * Change these to different unique phrases!
    * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
    * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
    *
    * @since 2.6.0
    */
   define('AUTH_KEY', ';M-8rw,53OlG[-Kn9.XJT,:;y)Vz`EW[/Z8}~Q-<$+{]v{PSAXwIuP !C/Dt`sqw');
   define('SECURE_AUTH_KEY', 'YQOXiUk?:-Kit,YB1]LUg-n3m=:_Che5|fr5-c(1B/e[BG?sOE.1(v]&K@EoW/-L');
   define('LOGGED_IN_KEY', 'H/~FP:Yf;-2==C>amh-W.LIvy90=KieRD/)fKGax3zx3{8-qpY5mBz@pd5xrpG;l');
   define('NONCE_KEY', 'hkS-P)cZAA|mK@17+m6|51$mWwdjZ7{6jz-`6sZ$D+hC)OO)-5aq{B?sJC7Kmj}{');
   define('AUTH_SALT', 'f8|D Q|1|sHsg&U2M|;CpFv@WTdKsc]&U$}NpPl|gyKbMyY:+ny(??:1+ya5In`]');
   define('SECURE_AUTH_SALT', '(=x(lZjXl0>(L-f7r{X21}z0DdEj3t6MJ#~5=-i5x+fIWe}v$5z!rudhrc01DaNn');
   define('LOGGED_IN_SALT', 'd)#(EKMn=Jk0 )0#?*|HJ_:fI;Y-J$|-4+2ejj$ae^-,L|*pc44+SD}BHEp>v32$');
   define('NONCE_SALT', '_D#3m+lb0$@ici=Jhm[cI7-~wI,Vaap)E.FQ+jKBd-cB~ISm U73eg&]pMCYyccn');

   // Enable WP_DEBUG mode
   //define('WP_DEBUG', true);

// Enable Debug logging to the /wp-content/debug.log file
   define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings 
   define('WP_DEBUG_DISPLAY', true);

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
   define('SCRIPT_DEBUG', true);

   /*    * #@- */

   /**
    * WordPress Database Table prefix.
    *
    * You can have multiple installations in one database if you give each a unique
    * prefix. Only numbers, letters, and underscores please!
    */
   $table_prefix = 'woopli_';

   /**
    * WordPress Localized Language, defaults to English.
    *
    * Change this to localize WordPress. A corresponding MO file for the chosen
    * language must be installed to wp-content/languages. For example, install
    * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
    * language support.
    */
   define('WPLANG', '');

   /**
    * For developers: WordPress debugging mode.
    *
    * Change this to true to enable the display of notices during development.
    * It is strongly recommended that plugin and theme developers use WP_DEBUG
    * in their development environments.
    */
   define('WP_DEBUG', true);

   /* That's all, stop editing! Happy blogging. */

   /** Absolute path to the WordPress directory. */
   if (!defined('ABSPATH'))
       define('ABSPATH', dirname(__FILE__) . '/');

   define('CONCATENATE_SCRIPTS', false);
   /** Sets up WordPress vars and included files. */
   require_once(ABSPATH . 'wp-settings.php');

   define('FS_METHOD','direct');

  