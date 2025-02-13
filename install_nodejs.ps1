# Download Node.js installer
$nodeVersion = "18.16.0"
$architecture = "x64"
$nodeInstallerUrl = "https://nodejs.org/dist/v$nodeVersion/node-v$nodeVersion-$architecture.msi"
$nodeInstallerPath = "$env:TEMP\node-installer.msi"

Write-Host "Downloading Node.js installer..."
Invoke-WebRequest -Uri $nodeInstallerUrl -OutFile $nodeInstallerPath

Write-Host "Installing Node.js..."
Start-Process msiexec.exe -Wait -ArgumentList "/i `"$nodeInstallerPath`" /quiet"

Write-Host "Cleaning up..."
Remove-Item $nodeInstallerPath

Write-Host "Refreshing environment variables..."
$env:Path = [System.Environment]::GetEnvironmentVariable("Path","Machine") + ";" + [System.Environment]::GetEnvironmentVariable("Path","User")

Write-Host "Node.js installation complete!"
Write-Host "Testing installation..."
node --version
npm --version
