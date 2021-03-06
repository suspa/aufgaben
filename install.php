<?php

if (!$this->hasConfig()) {
  $this->setConfig('ansicht', 'liste');
  $this->setConfig('mails', []);
  $this->setConfig('time', 5);
  $this->setConfig('send-to-all', '0');
  $this->setConfig('betreff', "");
  $this->setConfig('absender', "");
}

%TABLE_PREFIX%_sql_table::get(rex::getTable('aufgaben'))
    ->ensurePrimaryIdColumn()
    ->ensureColumn(new rex_sql_column('title', 'varchar(255)', true))
    ->ensureColumn(new new_sql_column('description', 'longtext', true))
    ->ensureColumn(new rex_sql_column('category', 'int(10)', true))
    ->ensureColumn(new rex_sql_column('responsible', 'int(10)', true))
    ->ensureColumn(new rex_sql_column('prio', 'int(10)', true))
    ->ensureColumn(new rex_sql_column('status', 'int(10)', true))
    ->ensureColumn(new rex_sql_column('createdate', 'datetime', true))
    ->ensureColumn(new rex_sql_column('updatedate', 'datetime', true))
    ->ensureColumn(new rex_sql_column('createuser', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('updateuser', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('observer', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('finaldate', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('versendet', 'varchar(255)', true, '2'))
    ->ensure();


%TABLE_PREFIX%_sql_table::get(rex::getTable('aufgaben_categories'))
    ->ensurePrimaryIdColumn()
    ->ensureColumn(new rex_sql_column('category', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('color', 'varchar(255)', true))
    ->ensure();


%TABLE_PREFIX%_table::get(rex::getTable('aufgaben_filter'))
    ->ensurePrimaryIdColumn()
    ->ensureColumn(new rex_sql_column('user', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('category', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('responsible', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('prio', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('status', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('done', 'varchar(255)', true))
    ->ensure();

%TABLE_PREFIX%_sql_table::get(rex::getTable('aufgaben_status'))
    ->ensurePrimaryIdColumn()
    ->ensureColumn(new rex_sql_column('status', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('icon', 'varchar(255)', true))
    ->ensure();

%TABLE_PREFIX%_sql_table::get(rex::getTable('user_settings'))
    ->ensurePrimaryIdColumn()
    ->ensureColumn(new rex_sql_column('user', 'varchar(255)', true))
    ->ensureColumn(new rex_sql_column('counter', 'int(10)', true))
    ->ensure();


$sql = rex_sql::factory();
$sql->setQuery("
  REPLACE INTO `%TABLE_PREFIX%_aufgaben_status` VALUES
    (1,'Offen','fa-folder-open-o'),
    (2,'Wird bearbeitet','fa-gears'),
    (3,'Frage','fa-question'),
    (4,'Warten auf etwas','fa-hourglass-start'),
    (5,'Auf später verschoben','fa-calendar'),
    (6,'Erledigt','fa-check');
  ");

$error = '';

if(!$error) {
  $this->setConfig('install', true);
}

