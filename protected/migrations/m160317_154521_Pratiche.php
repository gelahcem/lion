<?php

class m160317_154521_Pratiche extends CDbMigration
{
	public function up()
	{
		$sql="
            CREATE TABLE `Pratiche` (
			  `id` int(11) NOT NULL,
			  `id_pratica` varchar(32) NOT NULL,
			  `data_creazione` datetime NOT NULL,
			  `stato_pratica` enum('open','close','','') NOT NULL,
			  `note` text NOT NULL,
			  `id_cliente` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			ALTER TABLE `Pratiche`
			ADD PRIMARY KEY (`id`);

			ALTER TABLE `Pratiche`
			ADD CONSTRAINT `Pratiche_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `Cliente` (`id`) ON DELETE CASCADE;

        ";

		$this->execute($sql);
	}

	public function down()
	{
		echo "m160317_154521_Pratiche does not support migration down.\n";
		return false;
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