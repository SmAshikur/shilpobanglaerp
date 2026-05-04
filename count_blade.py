
import sys

def count_blade(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        lines = f.readlines()
    
    ifs = 0
    endifs = 0
    for i, line in enumerate(lines):
        ifs += line.count('@if')
        endifs += line.count('@endif')
        if line.count('@if') != line.count('@endif'):
             # print(f"Line {i+1}: @if count: {line.count('@if')}, @endif count: {line.count('@endif')}")
             pass
    
    print(f"{filepath} - Ifs: {ifs}, Endifs: {endifs}")

count_blade('resources/views/welcome.blade.php')
count_blade('resources/views/layouts/app.blade.php')
count_blade('resources/views/contact.blade.php')
count_blade('resources/views/layouts/dashboard.blade.php')
