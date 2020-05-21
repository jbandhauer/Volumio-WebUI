<?php
/*
 *      PlayerUI Copyright (C) 2013 Andrea Coiutti & Simone De Gregori
 *		 Tsunamp Team
 *      http://www.tsunamp.com
 *
 *  This Program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3, or (at your option)
 *  any later version.
 *
 *  This Program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with TsunAMP; see the file COPYING.  If not, see
 *  <http://www.gnu.org/licenses/>.
 *
 *
 *	UI-design/JS code by: 	Andrea Coiutti (aka ACX)
 * PHP/JS code by:			Simone De Gregori (aka Orion)
 * 
 * file:							config.inc
 * version:						1.0
 *
 */
 
// configurazione personale
// valore produzione su raspberry
define('ROOTPATH', $_SERVER['HOME'] . '/' ); // default = '/'
// valore ambiente ACX
//define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/' ); // default = '/'
define('DAEMONIP', 'localhost'); // default = 'localhost'
// DEV debug parameters
// ini_set('display_errors',1);
ini_set('error_log', '/var/log/php_errors.log'); 
// ini_set('log_errors', 'on');
// define('ERRORLEVEL', '-1'); // default = 'E_ALL ^ E_NOTICE'
//__production
define('ERRORLEVEL', 'E_ALL ^ E_NOTICE'); // default = 'E_ALL ^ E_NOTICE'
// NOTE jband: I had a heck of a time figuring out why I could not get log output
// to '/var/log/php_errors.log'. I turned out that this the file was only writable by 
// root and the php runs as the `www-data` user. I changed the owner of the file to 
// be www-data.
// define('ERRORLEVEL', 'E_ERROR'); // default = 'E_ALL ^ E_NOTICE'
// error_log("this is error text dfgjdg2");
// error_log("You messed up!\n", 3, "/var/tmp/my-errors.log");
// configurazione generale
define ('COMMENTCHAR','#');
define ('DELSTRING','');
define ('CONFPATH', ROOTPATH.'inc/mpd.conf');
define ('DEFCONFPATH', ROOTPATH.'inc/mpd.conf.default');
define ('NETCONFPATH', ROOTPATH.'inc/network/interfaces');
define ('NETCONFPATHMANUAL', ROOTPATH.'inc/network/interfaces.manual');
define ('NETCONFPATHAUTO', ROOTPATH.'inc/network/interfaces.dhcp');
define ('NETCONFPATHBOOT', ROOTPATH.'inc/network/interfaces.loadatboot');
//echo '<pre>INCPATH = '.INCPATH.'</pre>';
// datastore SQLite
$db = 'sqlite:'.$_SERVER['DOCUMENT_ROOT'].'/db/player.db';
?>