Welcome to the Kitely Tech Boilerplate Wordpress Plugin

Create a new plugin:
You've already created new local folder for the plugin you want to create and downloaded the boilerplate repo.
So let's pick up from there

## 👉  `bash buildplugin.sh`
- This will ask you the name of your plugin plus the namespace or prefix
- With that information it will build the boilerplate for the Plugin and install the front-end tooling

Front-end Tooling

## 👉  `npm run dev`
- Used to have Webpack watch your src folder and output the results to dist folder.
- No need to run fancy builds, you should be bundled on-the-go

Back-end Tooling
- The backend structure looks like this:
- - library
- - - admin
- - - api
- - - blocks
- - - core
- - - schema
- - - template
- - src
- - dist
- - vendor

The back-end files within each library folder should be commented to show example use. More documentation on this to come