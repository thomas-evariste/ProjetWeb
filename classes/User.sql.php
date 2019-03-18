<?php 

User::addSqlQuery('USER_LIST', "SELECT * FROM USER ORDER BY USER_LOGIN");
User::addSqlQuery('USER_GET_WITH_LOGIN',"SELECT * FROM USER WHERE USER_LOGIN=:login");
User::addSqlQuery('USER_COUNT_WITH_LOGIN',"SELECT COUNT(*) FROM USER WHERE USER_LOGIN=:login");







?>