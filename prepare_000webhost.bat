@echo off
echo Preparing files for 000webhost upload...

REM Create upload directory
if exist "000webhost_upload" rmdir /s /q "000webhost_upload"
mkdir "000webhost_upload"

REM Copy all necessary files
xcopy /E /I /Y "assets" "000webhost_upload\assets"
xcopy /E /I /Y "config" "000webhost_upload\config"
xcopy /E /I /Y "database" "000webhost_upload\database"
xcopy /E /I /Y "developer" "000webhost_upload\developer"
xcopy /E /I /Y "student" "000webhost_upload\student"
xcopy /E /I /Y "uploads" "000webhost_upload\uploads"
copy "*.php" "000webhost_upload\"
copy "*.html" "000webhost_upload\"

REM Create empty uploads directory if it doesn't exist
mkdir "000webhost_upload\uploads"

echo.
echo Files have been prepared in the '000webhost_upload' folder
echo.
echo Next steps:
echo 1. Create an account at https://www.000webhost.com
echo 2. Create a new website
echo 3. Go to File Manager
echo 4. Upload all contents from '000webhost_upload' folder to public_html
echo 5. Follow the instructions in 000webhost_setup.txt
echo.
echo Press any key to open the 000webhost website...
pause
start https://www.000webhost.com/
