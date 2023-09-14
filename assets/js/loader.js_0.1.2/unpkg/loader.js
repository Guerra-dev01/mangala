var utils = require("loader-utils");
var cssnano = require("cssnano");
var assign = require("object-assign");
var loadFile = require("./load-file");
var parseCssnano = require("./parse-cssnano");

var cssnanoLoader = function(source, map) {
  this.cacheable();
  var callback = this.async();

  var options = {};
  var query = utils.parseQuery(this.query);
  if (query.configFile) {
    assign(options, loadFile(query.configFile));
  }
  assign(options, query);
  assign(options, { map: map, sourcemap: true });

  var resourcePath = this.resourcePath;
  cssnano.process(source, options).then(function (result) {
    var parsed = parseCssnano(result.css);
    var map = assign({}, parsed.map, { file: resourcePath });
    callback(null, parsed.css, map);
  }, callback);
};

module.exports = cssnanoLoader;
