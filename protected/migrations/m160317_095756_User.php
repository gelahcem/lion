<?php

class m160317_095756_User extends CDbMigration
{
	public function up()
	{
		$sql="
            INSERT INTO `User` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES
(1, 'admin', 'admin', 'webmaster@example.com', '9a24eff8c15a6a141ece27eb6947da0f', '2016-03-14 15:44:56', '0000-00-00 00:00:00', 1, 1),
(2, 'demo', 'demo', 'demo@example.com', '099f825543f7850cc038b90aaff39fac', '2016-03-14 15:44:56', '0000-00-00 00:00:00', 0, 1),
(3, 'supervisor', 'supervisor', 'supervisor@example.com', '', '2016-03-14 23:00:00', '0000-00-00 00:00:00', 0, 1);
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
