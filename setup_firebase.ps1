# Function to check if a command exists
function Test-Command($CommandName) {
    return $null -ne (Get-Command $CommandName -ErrorAction SilentlyContinue)
}

# Check and install Node.js
if (-not (Test-Command "node")) {
    Write-Host "Installing Node.js..."
    # Download Node.js installer
    $nodeInstallerUrl = "https://nodejs.org/dist/v18.16.0/node-v18.16.0-x64.msi"
    $nodeInstallerPath = "$env:TEMP\node-installer.msi"
    Invoke-WebRequest -Uri $nodeInstallerUrl -OutFile $nodeInstallerPath
    
    # Install Node.js
    Start-Process msiexec.exe -Wait -ArgumentList "/i `"$nodeInstallerPath`" /quiet"
    Remove-Item $nodeInstallerPath
    
    # Refresh environment variables
    $env:Path = [System.Environment]::GetEnvironmentVariable("Path","Machine") + ";" + [System.Environment]::GetEnvironmentVariable("Path","User")
}

# Check and install Firebase CLI
if (-not (Test-Command "firebase")) {
    Write-Host "Installing Firebase CLI..."
    npm install -g firebase-tools
}

# Initialize Firebase project
Write-Host "Initializing Firebase project..."
firebase login
firebase init hosting

# Deploy to Firebase
Write-Host "Deploying to Firebase..."
firebase deploy

Write-Host "Setup complete! Your application should now be deployed to Firebase Hosting."
