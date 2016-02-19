<?php
/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.0.1
 * @copyright Serge Rodovnichenko, 2016
 */
$path = wa()->getDataPath("plugins/yatableau/", true);
waFiles::delete($path, true);
