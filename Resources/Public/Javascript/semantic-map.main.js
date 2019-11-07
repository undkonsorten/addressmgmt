window.onload = function () {
	semanticMap.mount(
		maps => {
			maps.parser.nodeFilter = node => !(node.classList && node.classList.contains("hide"));

			maps.maps[0].renderer._description.node.addEventListener("update-list", event => maps.refresh());
		}
	);
}
