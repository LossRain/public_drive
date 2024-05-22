# Public Drive Website
A simplified multi-file fork of https://github.com/prasathmani/tinyfilemanager designed for untrusted authenticated shares for myself

These additional changes have been made to the original project:
- PDF, video and image preview as an iframe with responsive design
- Custom rudimentary Markdown parser for displaying README files in folder view
  - Titles, headers and hyperlinks are implemented
- *Recently uploaded files* box for the home page
- Renaming wizard showing current folder for reference
- Custom responsive search allowing to index the whole share or current folder
- Allows sharing files that aren't publicly available on the webserver

The following management features are available:
- Upload and archive creation limits for minimizing server load
- Users can read and upload files, only administrator can remove them
  - Prevents mass deletion from a malicious user
- Removed change permission buttons for clarity
- Zero remote dependencies - all dependencies are to be downloaded locally
- Full event logs for moderation and management
