<?php 
//web index 

(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'temp', 'top');
(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'global', 'top');
(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'global', 'nav');
(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'global', 'menu');
(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'global', 'mobile_view');
(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'adver', 'banner_adver_1');
(new FileCaller)->FileIncluderWithControler(dirname(__FILE__,2), 'temp', 'down');
