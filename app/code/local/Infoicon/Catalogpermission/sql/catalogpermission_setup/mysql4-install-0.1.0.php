<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
create table customerproducts(id int not null auto_increment, product_id varchar(100), customer_id varchar(100), primary key(id));
    insert into tablename values(1,'1,2',9);
		
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 