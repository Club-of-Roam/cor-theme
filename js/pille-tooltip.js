/**
 * @param {string} newId
 * @return {HTMLDivElement}
 */
const tooltipNewElement = (newId) => {
	const el = document.createElement('div');
	el.id = newId;
	el.style.display = 'none';
	el.style.position = 'absolute';
	el.innerHTML = '&nbsp;';
	document.body.appendChild(el);

	return el;
};

/**
 * @param {MouseEvent} event
 */
const tooltipGetMousePosition = (event) => {
	const offsetX = 12;
	const offsetY = 8;

	const pageX = window.scrollX;
	const pageY = window.scrollY;

	const mouseX = event.clientX;
	const mouseY = event.clientY;

	const tooltipEl = document.getElementById('tooltip');
	tooltipEl.style.left = `${mouseX + pageX + offsetX}px`;
	tooltipEl.style.top = `${mouseY + pageY + offsetY}px`;
};

/**
 * @param {string} tip
 */
const tooltip = (tip) => {
	const tooltipEl =
		document.getElementById('tooltip') ?? tooltipNewElement('tooltip');
	tooltipEl.innerHTML = tip;
	tooltipEl.style.display = 'block';
	document.onmousemove = tooltipGetMousePosition;
};

const exit = () => {
	const tooltipEl = (document.getElementById('tooltip').style.display =
		'none');
	if (tooltipEl !== null) {
		tooltipEl.style.display = 'none';
	}
};
