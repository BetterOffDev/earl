<?php
	
	// set up global variables

	global $position;
	global $draft_class;
	global $title;

	// check the GET variables for sorting & filtering of player list

	if ( isset( $_GET['position'] ) ) {

		$position = $_GET['position'];

		switch($_GET['position']) {

			case('QB'):
				$title = 'Quarterback';
				break;

			case('RB'):
				$title = 'Running Back';
				break;

			case('FB'):
				$title = 'Fullback';
				break;

			case('WR'):
				$title = 'Wide Receiver';
				break;

			case('TE'):
				$title = 'Tight End';
				break;

			case('OT'):
				$title = 'Offensive Tackle';
				break;

			case('OG'):
				$title = 'Offensive Guard';
				break;

			case('C'):
				$title = 'Center';
				break;

			case('DL'):
				$title = 'Defensive Line';
				break;

			case('EDGE'):
				$title = 'Edge Player';
				break;

			case('DE'):
				$title = 'Defensive End';
				break;

			case('DT'):
				$title = 'Defensive Tackle';
				break;

			case('ILB'):
				$title = 'Inside Linebacker';
				break;

			case('OLB'):
				$title = 'Outside Linebacker';
				break;

			case('LB'):
				$title = 'Linebacker';
				break;

			case('CB'):
				$title = 'Cornerback';
				break;

			case('S'):
				$title = 'Safety';
				break;

			case('K'):
				$title = 'Kicker';
				break;

			case('P'):
				$title = 'Punter';
				break;

			default:
				$title = 'All Prospects';
		}
	}

	else {
		$title = 'All Prospects';
		$position = 'ALL';
	}

	if ( isset( $_GET['draft_class'] ) ) {
		$draft_class = $_GET['draft_class'];

		if ( $draft_class < 2015 && $position == 'LB' ) {
			$position = 'ILB';
		}

		if ( $draft_class < 2015 && $position == 'DL' ) {
			$position = 'DT';
		}

		if ( $draft_class < 2015 && $position == 'EDGE' ) {
			$position = 'OLB';
		}

		if ( $draft_class >= 2015 && $position == 'ILB' ) {
			$position = 'LB';
		}

		if ( $draft_class >= 2015 && $position == 'OLB' ) {
			$position = 'EDGE';
		}

		if ( $draft_class >= 2015 && $position == 'DE' ) {
			$position = 'DL';
		}

		if ( $draft_class >= 2015 && $position == 'DT' ) {
			$position = 'DL';
		}
	}

	else {
		$draft_class = '2016';
	}

?>