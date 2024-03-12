const mix = require("laravel-mix")
const MixGlob = require("laravel-mix-glob")
require("laravel-mix-nunjucks")

// String constants
const assetsPath = "resources";
const buildPath = "public/dist";

// Create MixGlob instance
const mixGlob = new MixGlob({ mix }) // mix is required

// Files loaded from css url()s will be placed alongside our resources
mix.options({
  fileLoaderDirs: {
    fonts: "assets/fonts",
    images: "assets/images",
  },
})

// Modules and extensions
const modulesToCopy = {
  "@icon/dripicons": false,
  "@fortawesome/fontawesome-free": false,
  "rater-js": false,
  "bootstrap-icons": false,
  apexcharts: true,
  "perfect-scrollbar": true,
  filepond: true,
  "filepond-plugin-image-preview": true,
  "feather-icons": true,
  dragula: true,
  dayjs: false,
  "chart.js": true,
  "choices.js": false,
  parsleyjs: true,
  sweetalert2: true,
  summernote: true,
  jquery: true,
  quill: true,
  tinymce: false,
  "toastify-js": false,
  "datatables.net-bs5": false,
  "simple-datatables": true, // With dist folder = true
}
for (const mod in modulesToCopy) {
  let modulePath = `node_modules/${mod}`
  if (modulesToCopy[mod]) modulePath += "/dist"

  mix.copy(modulePath, `${buildPath}/assets/extensions/${mod}`)
}

mixGlob
  // Attention: put all generated css files directly into a subfolder
  // of assets/css. Resource loading might fail otherwise.
  .sass(`${assetsPath}/scss/app.scss`, "assets/css/main")
  .sass(`${assetsPath}/scss/themes/dark/app-dark.scss`, "assets/css/main")
  .sass(`${assetsPath}/scss/pages/*.scss`, "assets/css/pages")
  .sass(`${assetsPath}/scss/widgets/*.scss`, "assets/css/widgets")
  .sass(`${assetsPath}/scss/iconly.scss`, "assets/css/shared")
  .js(`${assetsPath}/js/src/*.js`, "assets/js")

// Copying assets
mix
  .copy(`${assetsPath}/images`, `${buildPath}/assets/images`)
  .copy(
    "node_modules/bootstrap-icons/bootstrap-icons.svg",
    `${buildPath}/assets/images`
  )
  .copy(`${assetsPath}/js/src/pages`, `${buildPath}/assets/js/pages`)
  // We place all generated css in /assets/css/xxx
  // This is the relative path to the fileLoaderDirs we specified above
  .setResourceRoot("../../../")
  .setPublicPath(buildPath)

// Browsersync
mix.browserSync({
  files: [
      `${assetsPath}/scss/*.scss`,
      `${assetsPath}/**/*.html`,
      `${assetsPath}/assets/js/src/**/*.js`
  ],
  server: buildPath,
  port: 3003,
})
