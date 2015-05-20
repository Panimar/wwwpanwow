<?php
$mysql_conf = array (
"dbhost" => "localhost",	# ИП mysql сервера
"dbport" => "3306",			# Порт mysql сервера
"dbuser" => "mangos",			# Логин
"dbpass" => "mangos",			# Пароль
"dbencode" => "utf8"		# Кодировка
);

$db_conf = array (
"authdb" => "realmd",				# БД сервера авторизации
"chardb1" => "characters",			# БД персонажей 1-го реалма
"chardb2" => "",			# БД персонажей 2-го реалма (если есть)
"cpdb" => "imwcp"			# БД личного кабинета
);

$price_conf = array (
"unban_cost" => 0,		# Цена в бонусах за разблокирование учётной записи
"ch_race_cost" => 0,		# Цена в бонусах за смену расы персонажа
"ch_class_cost" => 0,		# Цена в бонусах за смену класса персонажа
"mv_char_cost" => 0,		# Цена в бонусах за перенос персонажа на другой аккаунт
"rename_char_cost" => 0		# Цена в бонусах за смену имени персонажа
);
?>
