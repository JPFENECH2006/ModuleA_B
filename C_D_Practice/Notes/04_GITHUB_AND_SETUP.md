# GitHub and setup

## Keep practice separate from original competition submission

Repository suggestion:
```
ModuleA_B/
  A/                      original module A code
  B/                      original module B code
  C_D_Practice/           extract this ZIP here
    Module_C/
    Module_D/
    Shared_Mock_API/
    Notes/
```

PowerShell, from an existing cloned repository:
```
cd D:\Competition\ModuleA_B
git add C_D_Practice
git status
git commit -m "Add Module C frontend and Module D debugging practice"
git push origin main
```

Never commit `.env`, vendor, node_modules, credentials, tokens or database dumps with personal data.

If Git cannot push, do not force-push: inspect `git status`, `git branch` and the full error first.

## Mock server test via terminal
```
node Shared_Mock_API/server.js
```
Open `http://127.0.0.1:8001/api/recipes` in your browser. Should return JSON and 10 items under `data` with `page:1` and `total:16`.
