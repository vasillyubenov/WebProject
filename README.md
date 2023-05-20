# Motion Graphics Generator (Web Project) Alex Kolachev ft. Vasil Lyubenov

This platform enables you to generate and visualize high-quality motion graphics. From 'Star Wars' style text crawls to various other animations, this platform allows you to customize animations based on the data and settings provided in two JSON files: `config.json` for animation settings, and `data.json` for the data to be animated.

The platform also includes a visual configuration editor, allowing the users to easily modify the settings. In addition, the platform provides an option to attach an audio file or music that plays during the animation. It features a 'full-screen' mode alongside the normal mode and offers user-friendly controls for starting, pausing, resuming, and adjusting the volume of the sound.

## Prerequisites
- PHP 7.4 or above
- A modern web browser

## Project Structure
The project is structured as follows:

📁project_root
|
|--📁frontend
| |--📄index.html
| |--📁css
| | |--📄style.css
| |--📁js
| | |--📄main.js
| | |--📄configEditor.js
| | |--📄animation.js
| |--📁assets
| | |--📁audio
| | |--📁images
|
|--📁backend
| |--📄server.php
|
|--📁data
| |--📄config.json
| |--📄data.json
|
|--📄.htaccess
|--📄requirements.txt

## Getting Started
1. Clone this repository or download and unzip the project folder.
2. Navigate into the `project_root` directory.
3. Run the PHP server: `php -S localhost:8000`
4. Open your web browser and visit `http://localhost:8000/frontend/index.html`
5. Enjoy the app!

## Contributing
Contributions, issues, and feature requests are welcome! Feel free to check issues page.

## License
This project is [MIT](LICENSE) licensed.

