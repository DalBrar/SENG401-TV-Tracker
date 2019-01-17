# SENG 401

[Markdown Cheat Sheet](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet)

## Committing Guidelines

- Please make a pull request when making commits. If it's a large commit to something functional, consider having it reviewed by another group member before merging it.

### Steps for Making a Pull Request (PR)

```bash
# Make sure you have the latest copy of the code.
$ git pull origin master

# Checkout a new branch to work on.
$ git checkout -b a_descriptive_branch_name

# Repeat the following as you're making changes. Each commit should represent a small discrete change.
$ git add file/you/changed.txt
$ git commit -m "a description of the things you changed"

# Do the following when you're ready to make your pull request.
$ git push origin a_descriptive_branch_name
```
