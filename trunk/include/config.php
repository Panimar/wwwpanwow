<?php
$mysql_conf = array (
"dbhost" => "localhost",	# �� mysql �������
"dbport" => "3306",			# ���� mysql �������
"dbuser" => "mangos",			# �����
"dbpass" => "mangos",			# ������
"dbencode" => "utf8"		# ���������
);

$db_conf = array (
"authdb" => "realmd",				# �� ������� �����������
"chardb1" => "characters",			# �� ���������� 1-�� ������
"chardb2" => "",			# �� ���������� 2-�� ������ (���� ����)
"cpdb" => "imwcp"			# �� ������� ��������
);

$price_conf = array (
"unban_cost" => 0,		# ���� � ������� �� ��������������� ������� ������
"ch_race_cost" => 0,		# ���� � ������� �� ����� ���� ���������
"ch_class_cost" => 0,		# ���� � ������� �� ����� ������ ���������
"mv_char_cost" => 0,		# ���� � ������� �� ������� ��������� �� ������ �������
"rename_char_cost" => 0		# ���� � ������� �� ����� ����� ���������
);
?>
