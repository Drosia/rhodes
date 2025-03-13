module.exports = function (grunt) {
	"use strict";

	// Change these for your project
	const SOURCE_PATH = "src";
	const PUBLIC_PATH = "public";

	// Leave as is
	const CSS_SRC = SOURCE_PATH + "/css";
	const CSS_DIST = PUBLIC_PATH + "/css";
	const CSS_VENDOR = SOURCE_PATH + "/css/vendor";
	const JS_SRC = SOURCE_PATH + "/js";
	const JS_DIST = PUBLIC_PATH + "/js";
	const JS_VENDOR = SOURCE_PATH + "/js/vendor";
	const JS_BUILD = PUBLIC_PATH + "/js/build";
	const SCSS_SRC = SOURCE_PATH + "/scss";
	const SCSS_DIST = PUBLIC_PATH + "/css";

	grunt.initConfig({
		pkg: grunt.file.readJSON("package.json"),
		sass: {
			dist: {
				files: {
					[`${SCSS_DIST}/bundle.css`]: `${SCSS_SRC}/core.scss`,
					[`${SCSS_DIST}/vendor.css`]: `${SCSS_SRC}/vendor.scss`
				}
			}
		},
		concat_css: {
			dist: {
				files: {
					[`${CSS_DIST}/bundle.css`]: [
						`${CSS_SRC}/vars.css`,
						`${CSS_SRC}/utils.css`,
						`${CSS_SRC}/grid.css`,
						`${CSS_SRC}/base.css`,
						`${CSS_SRC}/main.css`,
						`${CSS_SRC}/print.css`
					],
					[`${CSS_DIST}/vendor.css`]: [`${CSS_VENDOR}/normalize.css`]
				}
			}
		},
		cssmin: {
			dist: {
				files: {
					[`${CSS_DIST}/bundle.css`]: [
						`${CSS_SRC}/vars.css`,
						`${CSS_SRC}/utils.css`,
						`${CSS_SRC}/grid.css`,
						`${CSS_SRC}/base.css`,
						`${CSS_SRC}/main.css`,
						`${CSS_SRC}/print.css`
					],
					[`${CSS_DIST}/vendor.css`]: [`${CSS_VENDOR}/normalize.css`]
				}
			},
			dist2: {
				files: {
					[`${CSS_DIST}/vendor.min.css`]: [`${CSS_DIST}/vendor.css`],
					[`${CSS_DIST}/bundle.min.css`]: [`${CSS_DIST}/bundle.css`]
				}
			}
		},
		postcss: {
			options: {
				map: {
					inline: false,
					annotation: `${CSS_DIST}/maps/`
				},
				processors: [
					// require('pixrem')(), // rem unit fallbacks (mostly for <=IE8 & IE9&IE10 just on font property)
					require("autoprefixer")(), // add vendor prefixes
					require("css-mqpacker")()
				]
			},
			dist: {
				src: `${CSS_DIST}/bundle.css`
			}
		},
		uglify: {
			options: {
				mangle: false
			},
			my_target: {
				files: {
					[`${JS_DIST}/vendor.js`]: [
						`${JS_VENDOR}/modernizr-3.11.7.min.js`,
						`${JS_VENDOR}/jquery-3.6.0.min.js`,
						`${JS_VENDOR}/touchswipe.min.js`,
						`${JS_VENDOR}/jquery-ui.js`,
						`${JS_VENDOR}/headroom.js`,
						`${JS_VENDOR}/masonry.min.js`,
						`${JS_VENDOR}/imagesloaded.pkgd.min.js`,
						`${JS_VENDOR}/lightbox.js`,
						`${JS_VENDOR}/booking.js`,
					],
					[`${JS_DIST}/app.js`]: [`${JS_DIST}/app.js`]
				}
			}
		},
		eslint: {
			options: {
				configFile: "eslint.json"
			},
			target: [`${JS_SRC}/**/*.js`]
		},
		babel: {
			options: {
				sourceMap: true,
				presets: ["@babel/preset-env"],
				targets: {
					esmodules: true
				}
			},
			dist: {
				files: {
					[`${JS_BUILD}/app.js`]: `${JS_SRC}/app.js`,
					[`${JS_BUILD}/components/global.js`]: `${JS_SRC}/components/global.js`,
				}
			}
		},
		browserify: {
			dist: {
				files: {
					[`${JS_DIST}/app.js`]: `${JS_BUILD}/app.js`
				}
			}
		},
		clean: {
			js_build: [`${JS_BUILD}/**`]
		},
		copy: {
			main: {
				files: [
					{
						filter: "isFile",
						expand: true,
						cwd: "",
						src: ["*.html", "!_*.html"],
						dest: `${PUBLIC_PATH}/`,
						ext: ".html"
					}
				],
				options: {
					process: function (content, srcpath) {
						const fs = require("fs");

						// prettier-ignore
						let imports = content.match(/(?<=<!--[ \t]+@include[ \t]+").*?(?="[ \t]+-->)/g);

						if (imports) {
							imports.forEach((i) => {
								// prettier-ignore
								let re = new RegExp(`\<\!\-\-[ \t]+@include[ \t]+\"${i}\"[ \t]+\-\-\>`);
								let filepath = `${i}`;
								if (fs.existsSync(filepath)) {
									content = content.replace(re, fs.readFileSync(filepath));
								} else {
									content = content.replace(re, "");
								}
							});
						}

						return content;
					}
				}
			}
		},
		image: {
			dynamic: {
				files: [
					{
						expand: true,
						cwd: `${PUBLIC_PATH}/img/`,
						src: ["**/*.{png,jpg}"],
						dest: `${PUBLIC_PATH}/img/`
					}
				]
			}
		},
		watch: {
			css: {
				files: `${SOURCE_PATH}/**/*.css`,
				tasks: ["concat_css"],
				options: {
					livereload: true
				}
			},
			scss: {
				files: `${SOURCE_PATH}/**/*.scss`,
				tasks: ["sass"],
				options: {
					livereload: true
				}
			},
			js: {
				files: `${SOURCE_PATH}/**/*.js`,
				tasks: ["eslint", "babel", "browserify", "clean"],
				options: {
					livereload: true
				}
			},
			html: {
				files: "*.html",
				tasks: ["copy:main"],
				options: {
					livereload: true
				}
			},
			configFiles: {
				files: ["Gruntfile.js"],
				options: {
					reload: true
				}
			}
		}
	});

	grunt.loadNpmTasks("grunt-contrib-cssmin");
	grunt.loadNpmTasks("grunt-contrib-sass");
	grunt.loadNpmTasks("grunt-contrib-clean");
	grunt.loadNpmTasks("grunt-contrib-uglify");
	grunt.loadNpmTasks("grunt-contrib-watch");
	grunt.loadNpmTasks("grunt-contrib-copy");
	grunt.loadNpmTasks("grunt-concat-css");
	grunt.loadNpmTasks("grunt-postcss");
	grunt.loadNpmTasks("grunt-babel");
	grunt.loadNpmTasks("grunt-browserify");
	grunt.loadNpmTasks("grunt-eslint");
	grunt.loadNpmTasks("grunt-image");
	grunt.registerTask("default", ["watch"]);

	grunt.registerTask("prod", "Production Builder", function (styles = "css") {
		// Templates
		grunt.task.run("copy:main");

		// Styles
		if (styles === "css") {
			grunt.task.run("concat_css");
		} else {
			grunt.task.run("sass");
		}
		grunt.task.run("postcss", "cssmin:dist2");

		// Scripts
		grunt.task.run("eslint", "babel", "browserify", "uglify", "clean");
	});
};
