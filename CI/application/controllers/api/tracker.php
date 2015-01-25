<?php

function le9ko_createPIN() {
	return substr(str_shuffle(MD5(microtime())), 0, 10);
}