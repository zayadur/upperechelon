# Deployment
Throw the following files and folders on the server and you're ready to go.
- `index.html`
- `favicon.ico`
- `/assets`

# Setting up for development
Just install the dependencies via `npm install`, the sources are in the `src` folder, it's using SCSS for the stylesheets and ES6 for javascript.
The compilation commands are these:
1. `npm run dev` - one time compilation of assets without minifying anything
2. `npm run prod` - one time compilation ready for production
3. `npm run watch` - continuous compilation of assets on change