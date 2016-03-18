<?php

class m160317_135325_Cliente extends CDbMigration
{
	public function up()
	{
		$sql="
            CREATE TABLE `Cliente` (
			  `id` int(11) NOT NULL,
			  `nome` varchar(32) NOT NULL,
			  `conogme` varchar(32) NOT NULL,
			  `codice_fiscale` varchar(64) NOT NULL,
			  `note` text NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			ALTER TABLE `Cliente`
			ADD PRIMARY KEY (`id`);
        ";

		$this->execute($sql);
	}

	public function down()
	{
		$sql="
            SET FOREIGN_KEY_CHECKS=0;

            DROP TABLE IF EXISTS `Cliente`;
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