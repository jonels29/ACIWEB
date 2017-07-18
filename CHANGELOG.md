NOTAS DE CAMBIO: 

Agregar cambio a tabla de MOD_MENU_CONF. 

	ALTER TABLE  `MOD_MENU_CONF` ADD  `mod_pro` INT NULL DEFAULT NULL AFTER  `mod_stock` ;

Cambio tipo de variable a campos de dicha tabla: 

	ALTER TABLE  `MOD_MENU_CONF` CHANGE  `ID`  `ID` INT( 11 ) NOT NULL AUTO_INCREMENT ,
	CHANGE  `mod_sales`  `mod_sales` INT( 1 ) NOT NULL DEFAULT  '0',
	CHANGE  `mod_fact`   `mod_fact` INT( 1 ) NOT NULL DEFAULT  '0',
	CHANGE  `mod_invt`  `mod_invt` INT( 1 ) NOT NULL DEFAULT  '0',
	CHANGE  `mod_rept`   `mod_rept` INT( 1 ) NOT NULL DEFAULT  '0',
	CHANGE  `mod_stock`  `mod_stock` INT( 1 ) NOT NULL DEFAULT  '0',
	CHANGE  `mod_pro`    `mod_pro` INT( 11 ) NOT NULL DEFAULT  '0';


SE AGREGAN CAMBIOS A LA TABLA DE SAX_USER 

	ALTER TABLE  `SAX_USER` ADD  `pro_addmod` INT NOT NULL AFTER  `stoc_view` ,
	ADD  `tpl_addmod` INT NOT NULL AFTER  `pro_addmod` ;

SE AGREGA CAMPOS A LA TABLA DE sale_tax 

   ALTER TABLE  `sale_tax` ADD  `DEFAULT` INT( 1 ) NOT NULL DEFAULT  '0' AFTER  `rate` ;

cambio de primary key en tabla de Sales Representative

  ALTER TABLE  `Sales_Representative_Exp` ADD PRIMARY KEY (  `SalesRepID` ,  `ID_compania` ) ;