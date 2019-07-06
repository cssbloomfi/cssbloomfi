set localhost=%1
set user=%2
set pass=%3
set dbase=%4
set filename=%5
set PATH=%PATH%;"c:\Program Files\MySQL\MySQL Server 5.0\bin"
mysqldump -h%localhost% -u%user% -p%pass% --skip-extended-insert %dbase% > %filename%.sql

