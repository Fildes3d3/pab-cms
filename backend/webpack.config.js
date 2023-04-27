const Encore = require('@symfony/webpack-encore');
const path = require("path");

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('./public/build/')
    .setPublicPath('/build')
    .enableVueLoader(() => {}, {version: 3})
    .autoProvideVariables({
        $: "jquery",
        jQuery: "jquery",
    })
    .addEntry('app', './assets/app.js')
    .enableStimulusBridge('./assets/controllers.json')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabel((config) => {
        config.plugins.push("@babel/plugin-transform-runtime");
        config.plugins.push("@babel/plugin-proposal-class-properties");
    })
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })
    .enableSassLoader()
    .autoProvidejQuery()
;

if (!Encore.isProduction()) {
    Encore.disableCssExtraction();
}

let config = Encore.getWebpackConfig();

config.resolve.alias['@bo'] = path.resolve(__dirname, 'ui/backoffice/');
config.resolve.alias['@fo'] = path.resolve(__dirname, 'ui/frontoffice/');

module.exports = config;
