# Install Firebase Tools
Write-Host "Installing Firebase Tools globally..."
npm install -g firebase-tools

Write-Host "Firebase Tools installed. Now you need to:"
Write-Host "1. Login to Firebase: Run 'firebase login'"
Write-Host "2. Initialize project: Run 'firebase init hosting'"
Write-Host "3. Deploy: Run 'firebase deploy'"
Write-Host ""
Write-Host "Would you like to continue with Firebase login? (Y/N)"
$continue = Read-Host

if ($continue -eq 'Y' -or $continue -eq 'y') {
    Write-Host "Logging into Firebase..."
    firebase login
    
    Write-Host "Initializing Firebase project..."
    firebase init hosting
    
    Write-Host "Would you like to deploy now? (Y/N)"
    $deploy = Read-Host
    
    if ($deploy -eq 'Y' -or $deploy -eq 'y') {
        Write-Host "Deploying to Firebase..."
        firebase deploy
    }
}
