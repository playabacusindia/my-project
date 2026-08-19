const { src, dest, series } = require('gulp');

// Copy all HTML files to dist/
function copyHTML() {
    return src('./**/*.html', {
        ignore: ['./node_modules/**', './dist/**']
    })
    .pipe(dest('dist/'));
}

// Copy all assets folder to dist/
function copyAssets() {
    return src('./assets/**/*', { encoding: false })
        .pipe(dest('dist/assets/'));
}

// Copy india folder
function copyIndia() {
    return src('./india/**/*')
        .pipe(dest('dist/india/'));
}

// Copy Australia, UAE, Zimbabwe, southafrica folders
function copyCountries() {
    return src([
        './Australia/**/*',
        './UAE/**/*',
        './Zimbabwe/**/*',
        './southafrica/**/*',
        './blog/**/*',
        './template/**/*'
    ], { base: './' })
        .pipe(dest('dist/'));
}

// Default task: run all copy tasks
exports.default = series(copyHTML, copyAssets, copyIndia, copyCountries);