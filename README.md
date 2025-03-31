# TextQR Generator

A simple web application that generates text-based QR codes for automated tools while showing a manual for regular browsers.

## Features

- Generates text-based QR codes for automated tools
- Shows usage manual for regular browsers
- Easy deployment on any PHP hosting
- User-agent based content switching

## Setup

1. Clone this repository
2. Upload files to your PHP hosting
3. Access the page through your web browser

## Usage

### For automated tools (curl, wget, etc.):

```bash
# Using curl
curl -A "curl" "https://your-domain.com/?url=https://example.com"

# Using wget
wget --user-agent="wget" "https://your-domain.com/?url=https://example.com"

# Using Python
import requests
response = requests.get('https://your-domain.com/', 
                       params={'url': 'https://example.com'},
                       headers={'User-Agent': 'python'})
print(response.text)
```

### For regular browsers:
Simply open the page in your browser and use the web interface to generate QR codes.

## Development

The project uses PHP and vanilla JavaScript. No build process required. 