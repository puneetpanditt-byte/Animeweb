# NEO-SHOGUN Deployment Script
# Run this script to push your project to GitHub

Write-Host "Initializing Git..." -ForegroundColor Cyan
git init

Write-Host "Adding files..." -ForegroundColor Cyan
git add .

Write-Host "Committing changes..." -ForegroundColor Cyan
git commit -m "Setup for Vercel deployment: Environment-aware config & vercel.json added"

Write-Host "Connecting to GitHub..." -ForegroundColor Cyan
$repoUrl = "https://github.com/puneetpanditt-byte/Animeweb.git"
if (git remote | Select-String "origin") {
    git remote set-url origin $repoUrl
} else {
    git remote add origin $repoUrl
}

Write-Host "Pushing to GitHub..." -ForegroundColor Cyan
git branch -M main
git push -u origin main

Write-Host "Done! Your project is now on GitHub and ready for Vercel." -ForegroundColor Green
