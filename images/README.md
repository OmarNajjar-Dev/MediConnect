# MediConnect Images Directory

This directory contains all images used in the MediConnect application.

## Directory Structure

```
images/
├── doctors/           # Doctor profile images
│   ├── default.jpg    # Default placeholder for doctors without images
│   ├── dr_sarah_johnson.jpg
│   ├── dr_michael_chen.jpg
│   ├── dr_emily_rodriguez.jpg
│   ├── dr_james_wilson.jpg
│   ├── dr_lisa_kim.jpg
│   └── dr_robert_taylor.jpg
└── hospitals/         # Hospital images
    └── default.jpg    # Default placeholder for hospitals without images
```

## Image Requirements

### Doctor Profile Images

- **Format**: JPG, PNG, or WebP
- **Size**: Recommended 400x400px minimum
- **Aspect Ratio**: Square (1:1) preferred for circular display
- **Quality**: High resolution for professional appearance

### Hospital Images

- **Format**: JPG, PNG, or WebP
- **Size**: Recommended 800x400px minimum
- **Aspect Ratio**: 2:1 preferred for card layout
- **Quality**: High resolution showing hospital exterior or interior

## Usage

Images are referenced in the database using just the filename (e.g., `dr_sarah_johnson.jpg`).
The application automatically constructs the full path:

- Doctor images: `images/doctors/{filename}`
- Hospital images: `images/hospitals/{filename}`

## Replacing Placeholder Images

The current files are placeholders. To add real images:

1. Replace the placeholder files with actual image files
2. Keep the same filenames to maintain database references
3. Ensure images meet the requirements above
4. Test the application to verify images display correctly

## Adding New Images

When adding new doctors or hospitals:

1. Add the image file to the appropriate directory
2. Update the database record with the filename
3. Ensure the filename matches exactly (case-sensitive)
