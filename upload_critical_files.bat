@echo off
echo Preparing critical files for upload...

REM Create upload directory
if not exist "upload_files" mkdir upload_files
if not exist "upload_files\config" mkdir upload_files\config
if not exist "upload_files\developer" mkdir upload_files\developer

REM Copy critical files
copy "config\config.php" "upload_files\config\"
copy "developer\login.php" "upload_files\developer\"
copy "setup_database.php" "upload_files\"
copy "test_infinityfree.php" "upload_files\"
copy "verify_site.php" "upload_files\"

REM Create uploads directory
if not exist "upload_files\uploads" mkdir upload_files\uploads

echo.
echo Files prepared for upload. Use these FTP details in FileZilla:
echo.
echo Host: ftpupload.net
echo Username: if0_38302630
echo Password: WEBLIB724020
echo Port: 21
echo.
echo Remote directory: /htdocs
echo.
echo Local directory: %CD%\upload_files
echo.
echo After uploading:
echo 1. Visit: http://vvitlibrary.42web.io/verify_site.php
echo 2. Then: http://vvitlibrary.42web.io/setup_database.php
echo 3. Finally: http://vvitlibrary.42web.io/developer/login.php
echo.
echo Developer login credentials:
echo Username: admin
echo Password: VVITWEBLIB724020
echo.
pause
