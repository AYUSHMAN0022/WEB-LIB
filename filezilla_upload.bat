@echo off
echo FTP Upload Script for InfinityFree
echo ================================

echo Creating site structure...
if not exist "temp_upload" mkdir temp_upload
xcopy /E /I /Y ".\*" "temp_upload\"
del /Q "temp_upload\filezilla_upload.bat"
del /Q "temp_upload\upload.txt"
del /Q "temp_upload\upload_log.txt"
rmdir /S /Q "temp_upload\.git" 2>nul

echo.
echo FTP Details:
echo Host: ftpupload.net
echo Username: if0_38302630
echo Password: WEBLIB724020
echo.
echo Please use these details in FileZilla or any FTP client to upload the contents of the temp_upload folder
echo Remote directory should be: /htdocs
echo.
pause
