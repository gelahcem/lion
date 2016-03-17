<?php

class m160317_095632_User extends CDbMigration
{
	public function up()
	{
		$sql="
            CREATE TABLE `User` (
			  `id` int(11) NOT NULL,
			  `username` varchar(20) NOT NULL,
			  `password` varchar(128) NOT NULL,
			  `email` varchar(128) NOT NULL,
			  `activkey` varchar(128) NOT NULL DEFAULT '',
			  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
			  `superuser` int(1) NOT NULL DEFAULT '0',
			  `status` int(1) NOT NULL DEFAULT '0'
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			
			ALTER TABLE `User`
			ADD PRIMARY KEY (`id`);
        ";
        
        $this->execute($sql);
	}

	public function down()
	{
		$sql="
            SET FOREIGN_KEY_CHECKS=0;

            DROP TABLE IF EXISTS `User`;
        ";
        
        $this->execute($sql);
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
