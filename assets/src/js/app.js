import Global from "./components/global";

/**
 * This is the entry point for our app
 * We just load and initialize all the available components
 */

class App {
	constructor() {
		this.name = "PSDGator Web Framework";
		this.version = "0.1.0";
		this.run();
	}

	run() {
		/*--> Here we declare all the components <--*/
		const global = new Global();

		/*--> Here we initialize all the components <--*/
		global.init();

	}
}

window.app = new App();
