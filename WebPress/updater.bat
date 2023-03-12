@ECHO OFF
cls
title WebPress - Updater

echo Warning: Data folders will not be updated, so if a plugin has been updated, you may want to delete the "pluginname" folder in the data^>plugin folder

:choice
set /P c=[WebPress] ^> Are you sure you want to continue[Y/N]?
if /I "%c%" EQU "Y" goto :install
if /I "%c%" EQU "N" goto :close
goto :choice


:install
if exist "C:\ProgramData\WebPressUpdate" goto :remove
set /p loc=[WebPress] ^> Enter WebPress Location: 
mkdir "C:\ProgramData\WebPressUpdate"
git clone https://github.com/surveybuilderteams/WebPress.git "C:\ProgramData\WebPressUpdate"
xcopy "C:\ProgramData\WebPressUpdate\WebPress" "%loc%" /E /D /Y /EXCLUDE:"C:\ProgramData\WebPressUpdate\WebPress\conf\*.*"
goto :remove

:remove
@RMDIR /s /q "C:\ProgramData\WebPressUpdate"
echo [WebPress] ^> Successfully removed
pause
goto :close

:close
exit