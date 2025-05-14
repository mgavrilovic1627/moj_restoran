# Check if running as administrator
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)
if (-not $isAdmin) {
    Write-Host "Please run this script as Administrator"
    exit
}

# Set PHP path (adjust this to where you extracted PHP)
$phpPath = "C:\php"

# Add PHP to PATH if it's not already there
$currentPath = [Environment]::GetEnvironmentVariable("Path", "Machine")
if (-not $currentPath.Contains($phpPath)) {
    [Environment]::SetEnvironmentVariable("Path", $currentPath + ";$phpPath", "Machine")
    Write-Host "Added PHP to system PATH"
} else {
    Write-Host "PHP is already in system PATH"
}

# Create php.ini from php.ini-development if it doesn't exist
if (-not (Test-Path "$phpPath\php.ini")) {
    Copy-Item "$phpPath\php.ini-development" "$phpPath\php.ini"
    Write-Host "Created php.ini from development template"
}

Write-Host "PHP environment setup complete. Please restart your terminal for changes to take effect." 