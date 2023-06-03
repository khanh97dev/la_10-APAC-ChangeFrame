import cv2
import argparse
from PIL import Image

parser = argparse.ArgumentParser(description='Description of your program')
parser.add_argument('-f', '--file', type=str, help='Path to the file')
parser.add_argument('-o', '--output', type=str, help='Out path')
parser.add_argument('-m', '--margin', type=int, default=2, help='A number argument')
args = parser.parse_args()

file_path = args.file
out_path = args.output
margin = args.margin

image = cv2.imread(file_path, cv2.IMREAD_UNCHANGED)
image_PIL = Image.open(file_path)

# Step 1: Get info resolution
(height, width, d) = image.shape
# width=1020, height=570, depth=3

# Step 2: Convert the image to grayscale
gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

# Step 3: Apply pre-processing
# Example: thresholding to create a binary image
_, binary = cv2.threshold(gray, 127, 255, cv2.THRESH_BINARY)

# Step 4: Detect and extract position guides
contours, _ = cv2.findContours(binary, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

# Step 5: Determine position and dimensions of each guide
position_guides = []
for contour in contours:
    x, y, w, h = cv2.boundingRect(contour)
    position_guides.append((x, y, w, h))

# Step 6: Perform additional processing or filtering if necessary

# Step 7: Visualize the detected guides (optional)
x_array = [item[0] for item in position_guides]
y_array = [item[1] for item in position_guides]
w_array = [item[2] for item in position_guides]
h_array = [item[3] for item in position_guides]

top = min(y_array)
left = min(x_array)
max_w = 0
max_h = 0

# handle multiple
for guide in position_guides:
    x, y, w, h = guide
    # cv2.rectangle(image, (x, y), (x + w, y + h), (0, 255, 0), 2)
    if (x + w) > max_w:
        max_w = x + w
    if (y + h) > max_h:
        max_h = y + h

x_crop = left - margin if left - margin > 0 else 0
y_crop = top - margin if top - margin > 0 else 0
w_crop = max_w + margin if max_w + margin < width else width
h_crop = max_h + margin if max_h + margin < height else height

# cropped_image = image[top - margin:max_h + margin, left - margin:max_w + margin]

# Define the crop region (left, upper, right, lower)
crop_region = (x_crop, y_crop, w_crop, h_crop)

# Crop the image
cropped_image = image_PIL.crop(crop_region)
cropped_image.save(out_path)
