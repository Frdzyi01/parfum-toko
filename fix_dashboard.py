import re

file_path = "resources/views/backend/dashboard.blade.php"

with open(file_path, "r") as f:
    content = f.read()

# Replace asset URLs
content = re.sub(r'(href|src)="(template-admin/[^"]+)"', r'\1="{{ asset(\'\2\') }}"', content)

# Replace index.html to admin.dashboard route
content = re.sub(r'href="index\.html"', r'href="{{ route(\'admin.dashboard\') }}"', content)

with open(file_path, "w") as f:
    f.write(content)

print("Dashboard href updated successfully.")
