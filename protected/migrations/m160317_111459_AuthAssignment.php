<?php

class m160317_111459_AuthAssignment extends CDbMigration
{
	public function up()
	{
		$sql="
            CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Authority', '1', '', 's:0:'';'),
('Supervisor', '3', '', 's:0:'';');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD PRIMARY KEY (`itemname`,`userid`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
        ";
        
        $this->execute($sql);
	}

	public function down()
	{
		echo "m160317_111459_AuthAssignment does not support migration down.\n";
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
