import re
import os

file_path = "resources/views/backend/dashboard.blade.php"
with open(file_path, "r") as f:
    content = f.read()

# We need to find the start and end of the content area.
# Content starts at: <!-- Content wrapper --> \n <div class="content-wrapper"> \n <!-- Content --> \n <div class="container-xxl flex-grow-1 container-p-y">
# Content ends right before: <!-- / Content --> or <!-- Footer -->

start_marker = "<!-- Content wrapper -->"
end_marker = "<!-- Footer -->"

start_idx = content.find(start_marker)
end_idx = content.find(end_marker)

if start_idx != -1 and end_idx != -1:
    # Let's find the inner content div
    inner_start = content.find('<div class="container-xxl flex-grow-1 container-p-y">', start_idx) + len('<div class="container-xxl flex-grow-1 container-p-y">')
    inner_end = content.rfind('</div>', inner_start, end_idx) # The closing div of container-xxl
    
    # Actually, it's easier to replace the inner content with @yield('content')
    # Let's find where the row starts inside the container
    row_start = content.find('<div class="row">', inner_start)
    
    # We will replace everything from row_start to inner_end with @yield('content')
    if row_start != -1:
        layout_content = content[:row_start] + "\n                    @yield('content')\n                " + content[inner_end:]
        dashboard_content = "@extends('backend.layouts.app')\n\n@section('content')\n" + content[row_start:inner_end] + "\n@endsection\n"
        
        os.makedirs("resources/views/backend/layouts", exist_ok=True)
        with open("resources/views/backend/layouts/app.blade.php", "w") as f:
            f.write(layout_content)
            
        with open("resources/views/backend/dashboard.blade.php", "w") as f:
            f.write(dashboard_content)
        print("Layout extracted successfully.")
    else:
        print("Could not find row start.")
else:
    print("Could not find markers.")

