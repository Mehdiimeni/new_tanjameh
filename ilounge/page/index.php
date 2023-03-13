<?php 
//web index 

(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'temp', 'top');
(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'global', 'top');
(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'global', 'nav');
(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'global', 'newsletter', '0');
(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'global', 'footer');
(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'temp', 'down');
