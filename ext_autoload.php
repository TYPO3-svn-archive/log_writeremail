<?php

$extensionClassPath = t3lib_extMgm::extPath('log_writeremail') . 'Classes/';

return array(
        'tx_logwriteremail_log_writer_email' => $extensionClassPath . 'Log/Writer/Email.php',
);

?>