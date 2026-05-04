
import sys
import re

def check_blade_nesting(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Simple regex for @if, @else, @elseif, @endif
    # Note: this doesn't handle strings or comments correctly but should be enough
    directives = re.findall(r'@(if|endif|else|elseif|foreach|endforeach|for|endfor|while|endwhile|section|endsection|extends|yield|include)', content)
    
    stack = []
    for d in directives:
        if d in ['if', 'foreach', 'for', 'while', 'section']:
            stack.append(d)
        elif d == 'endif':
            if not stack or stack[-1] != 'if':
                print(f"Error: unmatched @endif. Stack: {stack}")
                return False
            stack.pop()
        elif d == 'endforeach':
            if not stack or stack[-1] != 'foreach':
                print(f"Error: unmatched @endforeach. Stack: {stack}")
                return False
            stack.pop()
        elif d == 'endfor':
            if not stack or stack[-1] != 'for':
                print(f"Error: unmatched @endfor. Stack: {stack}")
                return False
            stack.pop()
        elif d == 'endwhile':
            if not stack or stack[-1] != 'while':
                print(f"Error: unmatched @endwhile. Stack: {stack}")
                return False
            stack.pop()
        elif d == 'endsection':
            if not stack or stack[-1] != 'section':
                print(f"Error: unmatched @endsection. Stack: {stack}")
                return False
            stack.pop()
    
    if stack:
        print(f"Error: unclosed directives: {stack}")
        return False
    
    print("Nesting looks OK")
    return True

check_blade_nesting('resources/views/welcome.blade.php')
check_blade_nesting('resources/views/layouts/app.blade.php')
check_blade_nesting('resources/views/contact.blade.php')
check_blade_nesting('resources/views/layouts/dashboard.blade.php')
