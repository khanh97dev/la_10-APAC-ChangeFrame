import rembg
from PIL import Image

input_path = 'input.png'
output_path = 'output.png'

input = Image.open(input_path)
output = rembg.remove(input)
output.save(output_path)
