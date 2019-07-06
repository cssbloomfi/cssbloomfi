@ECHO OFF
setlocal enabledelayedexpansion
for %%f in (*.???) do (
  set /p val=<%%f
  echo "fullname: %%f"
  echo "name: %%~nf"
  echo "contents: !val!"
)
pause;