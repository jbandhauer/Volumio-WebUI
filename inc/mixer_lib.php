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

$mixer_level_sets = array(
	"65 65 65 65 65 65 65 65 65 65",
	"68 68 68 65 65 65 65 65 65 65",
	"70 70 70 68 65 65 65 65 65 65",
	"72 72 72 70 65 65 65 65 65 65",
	"74 74 74 72 65 65 65 65 65 65",
	"76 76 74 72 65 65 65 65 65 65",
	"78 78 76 72 65 65 65 65 65 65",
	"80 80 76 72 65 65 65 65 65 65",
	"82 82 78 74 65 65 65 65 65 65"
);

function set_bass_level($level) {
	global $mixer_level_sets;

	$mixer_level_sets_count = count($mixer_level_sets);

	if ($level < 0) {
		$level = 0;
	} else if ($level >= $mixer_level_sets_count) {
		$level = $mixer_level_sets_count - 1;
	}

	set_mixer_levels($mixer_level_sets[$level]);

	return $level;
}

?>
