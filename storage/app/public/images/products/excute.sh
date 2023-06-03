#!/bin/bash

# Find all .sh files recursively starting from the current directory
find . -name "*.jpg" | while read -r file; do
  # Process each file here
    filename=$(basename "$file")
    basename="${filename%.*}"
    rembgName="$basename"_rm.jpg
    echo "Processing $file"
    rembg i "$file" "$rembgName"
    echo "End $file"
    # Add your commands or actions for each file
done
