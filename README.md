# IZA-SDG

Interactive SDG graphic for IZA.

## Development

* uses **yarn**, **webpack** and **browsersync**.
    * Dependancies are managed with `package.json` (yarn)
    * Builds are managed with `webpack.config.js` (webpack)

Source files (items that need to be manipulated before they can be used) are located in /src.

### How does it work

1. [Install Yarn](https://yarnpkg.com/en/docs/install)
2. Initilize Project

    ```sh
    yarn
    ```

3. Available commands

    1. **Dev**

        starts browsersync, compiles your js and scss, creates sourcemaps and watches for file changes

        ```sh
        yarn dev
        ```

    2. **Dist**

        generates production files (minifies css and packs media queries), generates less detailed source maps

        ```sh
        yarn dist
        ```
