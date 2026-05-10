import re
import glob
import os

files = glob.glob('resources/views/frontend/**/*.blade.php', recursive=True)

pattern = re.compile(r'(href|src|data-setbg)="template-landing/([^"]+)"')

for filepath in files:
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    new_content = pattern.sub(r'\1="{{ asset(\'template-landing/\2\') }}"', content)
    
    if new_content != content:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Updated {filepath}")

