<?php
$installer = $this;
$installer->startSetup();
$installer->run("CREATE TABLE IF NOT EXISTS `{$this->getTable('learning')}` (
  `apptera_id` int(255) NOT NULL,
  `host` varchar(2000) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `password` varchar(200) NOT NULL,
  `filename` varchar(300) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

ALTER TABLE `{$this->getTable('learning')}`
  ADD PRIMARY KEY (`apptera_id`);
  
  ALTER TABLE `{$this->getTable('learning')}`
  MODIFY `apptera_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
 

INSERT INTO `{$this->getTable('learning')}` (host, username, password, filename) values ('Your host will be here', 'FTP Username', 'FTP Password', 'Filepath');");

 
  
  
  
/**
$installer->run("
 CREATE TABLE `{$this->getTable('learning/learning')}` (
  `apptera_id` int(11) unsigned NOT NULL auto_increment,
  `host` varchar(2000) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `password` varchar(200) NOT NULL,
  `filename` varchar(300) NOT NULL
  PRIMARY KEY (`apptera_id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
INSERT INTO `{$this->getTable('learning/learning')}` (host, username, password, filename) values ('Your host will be here', 'username', 'password', 'filename');
");
**/
$installer->endSetup();             
?>