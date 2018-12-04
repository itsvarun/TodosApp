<?php

if (! function_exists('is_set')) {

	function is_set($vairable, $positiveValue, $negativeValue = "") {
		return $vairable ? $positiveValue : $negativeValue;
	}

}

