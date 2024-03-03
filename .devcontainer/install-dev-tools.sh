# Trust all repositories
git config --global --add safe.directory '*'

# Install PowerShell
## DevContainer feature - not working with Alpine https://github.com/devcontainers/features/issues/890
## From APK repository
apk add --no-cache powershell
## Alternatively get last version from archive https://learn.microsoft.com/en-us/powershell/scripting/install/install-alpine
