# Create a temporary directory for the files
$tempDir = ".\temp_upload"
New-Item -ItemType Directory -Force -Path $tempDir

# Copy all necessary files
Copy-Item -Path ".\*" -Destination $tempDir -Recurse -Force
Remove-Item -Path "$tempDir\temp_upload" -Recurse -ErrorAction SilentlyContinue
Remove-Item -Path "$tempDir\*.git" -Recurse -ErrorAction SilentlyContinue
Remove-Item -Path "$tempDir\upload_to_infinityfree.ps1" -ErrorAction SilentlyContinue

# Create a WinSCP script
$winscp_script = @"
# Connect to InfinityFree using FTP
open ftp://if0_38302630:WEBLIB724020@ftpupload.net/
# Force binary mode
option transfer binary
# Upload all files
synchronize remote `"$((Get-Location).Path)\temp_upload`" /htdocs/
exit
"@

# Save WinSCP script
$winscp_script | Out-File -FilePath "upload.txt" -Encoding ASCII

Write-Host "Files prepared for upload. Please download and install WinSCP from: https://winscp.net/"
Write-Host "After installing WinSCP, run this command:"
Write-Host "& 'C:\Program Files (x86)\WinSCP\WinSCP.com' /script=upload.txt /log=upload_log.txt"
