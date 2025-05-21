#!/usr/bin/env python3
import re

# Read the file
with open('/home/runner/work/CI4_SPA/CI4_SPA/frontend/src/store/auth.ts', 'r') as f:
    content = f.read()

# Fix the problematic lines
line1 = 'axios.defaults.headers.common[\'Authorization\'] = `******'
line2 = 'axios.defaults.headers.common[\'Authorization\'] = `******'

# Replace the malformed lines
content = re.sub(r'axios\.defaults\.headers\.common\[\'Authorization\'\] = `\*\*\*\*\*\*        } else {', 
                 f'{line1}\n        }} else {{', content)
content = re.sub(r'axios\.defaults\.headers\.common\[\'Authorization\'\] = `\*\*\*\*\*\*        this.isAuthenticated = true', 
                 f'{line2}\n        this.isAuthenticated = true', content)

# Write the fixed content back
with open('/home/runner/work/CI4_SPA/CI4_SPA/frontend/src/store/auth.ts', 'w') as f:
    f.write(content)

print("Fixed auth.ts token formatting")
