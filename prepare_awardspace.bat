@echo off
echo Preparing files for AwardSpace upload...

REM Create upload directory
if exist "awardspace_upload" rmdir /s /q "awardspace_upload"
mkdir "awardspace_upload"

REM Copy all necessary files
xcopy /E /I /Y "assets" "awardspace_upload\assets"
xcopy /E /I /Y "config" "awardspace_upload\config"
xcopy /E /I /Y "database" "awardspace_upload\database"
xcopy /E /I /Y "developer" "awardspace_upload\developer"
xcopy /E /I /Y "student" "awardspace_upload\student"
xcopy /E /I /Y "uploads" "awardspace_upload\uploads"
copy "*.php" "awardspace_upload\"
copy "*.html" "awardspace_upload\"

REM Create empty uploads directory if it doesn't exist
mkdir "awardspace_upload\uploads"

echo.
echo Files have been prepared in the 'awardspace_upload' folder
echo.
echo Next steps:
echo 1. Create an account at https://www.awardspace.com
echo 2. Choose "Free Hosting"
echo 3. After account creation, go to Hosting Manager
echo 4. Use File Manager to upload all contents from 'awardspace_upload' folder
echo 5. Follow the instructions in awardspace_setup.txt
echo.
echo Benefits of AwardSpace Free Hosting:
echo - 1GB Disk Space
echo - Unlimited Bandwidth
echo - PHP 8.1 Support
echo - MySQL Databases
echo - Free Subdomain
echo - No Ads
echo - 24/7 Support
echo.
echo Press any key to open the AwardSpace website...
pause
start https://www.awardspace.com/free-hosting/
