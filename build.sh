#!/bin/sh
# Pack the theme into docs/sklad24.zip (the demo page installs it into WordPress from there).
set -e
cd "$(dirname "$0")/theme"
rm -f ../docs/sklad24.zip
find sklad24 -name .DS_Store -delete
zip -qr -X ../docs/sklad24.zip sklad24
echo "docs/sklad24.zip: $(du -h ../docs/sklad24.zip | cut -f1)"
