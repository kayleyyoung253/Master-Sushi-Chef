<?php

unset($_SESSION);
session_destroy();
session_write_close();
$this->_f3->reroute('/');