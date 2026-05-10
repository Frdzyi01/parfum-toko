import re

file_path = "resources/views/backend/dashboard.blade.php"

with open(file_path, "r") as f:
    content = f.read()

# Replace escaped quotes inside asset
content = content.replace(r"{{ asset(\'", r"{{ asset('").replace(r"\') }}", r"') }}")

with open(file_path, "w") as f:
    f.write(content)

print("Quotes fixed.")
