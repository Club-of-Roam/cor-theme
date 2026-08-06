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
 * Show tooltip. Should be called on mouseover event.
 * @param {string} tip
 */
// eslint-disable-next-line no-unused-vars -- exported function. Used in cor-theme and cor-mgmt.
const tooltip = (tip) => {
	const tooltipEl =
		document.getElementById('tooltip') ?? tooltipNewElement('tooltip');
	tooltipEl.innerHTML = tip;
	tooltipEl.style.display = 'block';
	document.onmousemove = tooltipGetMousePosition;
};

/**
 * Exit tooltip. Should be called on mouseout event.
 */
// eslint-disable-next-line no-unused-vars -- exported function. Used in cor-theme and cor-mgmt.
const exit = () => {
	const tooltipEl = (document.getElementById('tooltip').style.display =
		'none');
	if (tooltipEl !== null) {
		tooltipEl.style.display = 'none';
	}
};
