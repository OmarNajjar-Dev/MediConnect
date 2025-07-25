# Uploads Directory

This directory contains user-uploaded files for the MediConnect application.

## Structure

- `profile_images/` - User profile images
- `.htaccess` - Security configuration to allow only image files

## Security

- Only image files (jpg, jpeg, png, gif, webp) are allowed
- Directory listing is disabled
- All other file types are blocked

## Usage

Profile images are stored with the path format: `/uploads/profile_images/filename.jpg`

The database stores the full path starting with `/uploads/profile_images/`

## Permissions

Make sure the web server has write permissions to this directory for file uploads.
