<?php

class m160317_111700_AuthItem extends CDbMigration
{
	public function up()
	{
		$sql="
            CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Assign', 1, 'Assing tasks', '', 's:10:'2016-03-15';'),
('Authority', 2, 'This is the\r\nonly user that can admin srbac (create, edit, delete roles, tasks, operations and assign them to users).', '', 's:10:'2016-03-15';'),
('Roles', 0, 'Assign roles', '', 's:10:'2016-03-15';'),
('Supervisor', 2, 'Import/export csv', '', 's:10:'2016-03-15';');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `AuthItem`
--
ALTER TABLE `AuthItem`
  ADD PRIMARY KEY (`name`);
        ";
        
        $this->execute($sql);
	}

	public function down()
	{
		echo "m160317_111700_AuthItem does not support migration down.\n";
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
