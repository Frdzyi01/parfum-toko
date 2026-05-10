import glob
import os

for f in glob.glob("resources/views/frontend/**/*.blade.php", recursive=True):
    with open(f, "r", encoding="utf-8") as file:
        c = file.read()
    c2 = c.replace(r"\'", "'")
    if c != c2:
        with open(f, "w", encoding="utf-8") as file:
            file.write(c2)
        print("Updated " + f)
