<?php

# Support for setting mixer leves using alsa.

# NOTE: In order for the sudo below to work I needed to add to /etc/sudoers the following:
#  www-data ALL=(ALL) NOPASSWD: /usr/bin/amixer
#
# TODO: make this part of the install for the entire system

# Return a space-seperated string of 10 mixer values (low frequencies first). 
function get_mixer_levels() {
	$result = "";
	for ($x = 0; $x <= 10; $x++) {
		$output = null;
		# this and the parsing is all quite brittle :(
		exec("sudo -H -u mpd amixer -D equal cget numid=$x", $output);
		$match = null;
		if (preg_match("/^  : values=(\d+)\,/", $output[2], $match) == 1) {
			$result .= $match[1];
			if ($x < 10) {
				$result .= " ";
			}
		}
	}
	return $result;
}

# Assume that input is a space-seperated string of up to 10 mixer level values.
function set_mixer_levels($input) {
	$levels = explode(" ", $input);
	$level_count = count($levels);
	for ($x = 1; $x <= $level_count; $x++) {
		$level = $levels[$x-1];
		exec("sudo -H -u mpd amixer -D equal cset numid=$x $level");
	}
}