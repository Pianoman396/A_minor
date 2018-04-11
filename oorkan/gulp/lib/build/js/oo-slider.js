	/*===== SLIDER'S FUNCTIONALITY =====*/
const SliderConstructor = (options) => {

		/*===== PARAMETERS =====*/
		let params = {
			container : options.container || document.getElementById(`oo_slider_container`), // need
			numberOfSlides : options.numberOfSlides || 5, // need
			autoStructure : options.autoStructure || false,
			autoStart : options.autoStart || false,
			autoLoop : options.autoloop || false,
			style : options.style || `left`,
			timer: options.timer || 5,
			activeElement : 0,
			progStep: 1,
			offsetAmounts : {
				center: `0`,
				left: `-100%`,
				right: `100%`
			}
		};

		params.progWidth = 100 / params.numberOfSlides;

		/*===== ELEMENTS =====*/
		let elements = {
			slider:  options.slider || document.getElementById(`slider`),
			slides: options.slides || document.getElementById(`slider`).children,
			prevBtn: options.prevBtn || document.getElementById(`btn-prev`),
			nxtBtn: options.nxtBtn || document.getElementById(`btn-next`),
			firstSlide: document.getElementById(`first_slide`),
			lastSlide: document.getElementById(`last_slide`),
			progBar: document.getElementById(`prog-bar-inner`)
		};


		/*===== DISABLE THE BUTTON FUNCTION =====*/
		const disableBtn = (button) => {
			return button.disabled = true;
		};
		const enableBtn = (button) => {
			return button.disabled = false;
		};

		const btnToggle = (slide, autoLoop) => {
			if (!autoLoop){
				if (slide <= 1) {
					disableBtn(elements.prevBtn);
					enableBtn(elements.nxtBtn);
				}else if(slide >= params.numberOfSlides - 2) {
					enableBtn(elements.prevBtn);
					disableBtn(elements.nxtBtn);
				}else if (slide < params.numberOfSlides - 2) {
					enableBtn(elements.prevBtn);
					enableBtn(elements.nxtBtn);
				}
			}
		};

		/*===== PROGRESS BAR =====*/
		/*===== PROGRESS FORWARD=====*/
			const progBarFwd = () => {
				let width = 100 / params.numberOfSlides;

				if (params.progWidth >= 100) {
					params.progStep = 1;
				}else {
					params.progStep++;
					params.progWidth += width;
					elements.progBar.style.width = `${params.progWidth}%`;
					elements.progBar.innerHTML = `Step ${params.progStep}`;
				}
			};
			/*===== PROGRESS BACKWARDS =====*/
			const progBarBwd = () => {
				let width = 100 / params.numberOfSlides;

				if(params.progStep <= params.numberOfSlides){
					params.progStep--;
					params.progWidth = params.progWidth - width;
					elements.progBar.style.width = `${params.progWidth}%`;
					elements.progBar.innerHTML = `Step ${params.progStep}`;
				}
				else if (params.progStep = 0) {
					params.progStep = params.numberOfSlides;
				}
			};

		/*===== OFFSET BASED ON DIRECTIONS =====*/
		const getOffset = (dir) => {
			if (dir === `center`) {
				return params.offsetAmounts.center;
			}
			else if (dir === `left`) {
				return params.offsetAmounts.left;
			}
			else if(dir === `right`) {
				return params.offsetAmounts.right;
			}
		};

		/*===== SLIDER MOVING FUNCTION =====*/
		const moveSlide = (id, dir) => {
			dir = dir.split(`=>`);
			let start = getOffset(dir[0]);
			let end = getOffset(dir[1]);
			elements.slides[id].style.transition = `none`;
			elements.slides[id].style[params.style] = start;

			// btnToggle(params.activeElement, params.autoLoop);
			setTimeout(function() {
				elements.slides[id].style.transition = ``;
				elements.slides[id].style[params.style] = end;
			}, 50);
		};

		/*===== PREV BUTTON FUNCTION =====*/
		const prev = () => {
			btnToggle(params.activeElement, params.autoLoop);
			if (params.activeElement > 0) {
				moveSlide(params.activeElement - 1, `left=>center`);
				moveSlide(params.activeElement, `center=>right`);
				params.activeElement--;
				enableBtn(elements.nxtBtn); // IMPORTANT
			} else {
				moveSlide(params.numberOfSlides - 1, `left=>center`);
				moveSlide(params.activeElement, `center=>right`);
				params.activeElement = params.numberOfSlides - 1;
			}
			progBarBwd();
		};

		/*===== NEXT BUTTON FUNCTION =====*/
		const next = () => {
			btnToggle(params.activeElement, params.autoLoop);
			if (params.activeElement + 1 < params.numberOfSlides) {
				moveSlide(params.activeElement + 1, `right=>center`);
				moveSlide(params.activeElement, `center=>left`);
				params.activeElement++;
				enableBtn(elements.prevBtn); // IMPORTANT!!!
			} else {
				moveSlide(0, `right=>center`);
				moveSlide(params.activeElement, `center=>left`);
				params.activeElement = 0;
			}
			progBarFwd();
		};

		let autoSlideInterval = null;
		const resetAutoSlide = () => {
			if(params.autoStart){
				if (autoSlideInterval){
					clearTimeout(autoSlideInterval);
				}
				autoSlideInterval = setInterval(function() {
					next();
				}, params.timer * 1000);
			}
		};

		/*===== SETUP, SETTING DEFAULT STATE =====*/
		moveSlide(0, `center=>center`);
		for(let i = 1; i < params.numberOfSlides; i++) {
			moveSlide(i, `right=>right`);
			btnToggle(params.activeElement, params.autoLoop);
		}

		/*===== SLIDER AUTOSTART =====*/
		resetAutoSlide();

		/*===== ADDING EVENT LISTENERS =====*/
		elements.prevBtn.addEventListener(`click`, () => {prev(); resetAutoSlide();}); //function as a callback, IMPORTANT!!!
		elements.nxtBtn.addEventListener(`click`, () => {next(); resetAutoSlide();}); // add ontouchstart


	}; // constructor function END


	/*===== RENDERING THE QUIZZES FROM BACKEND =====*/
		const renderQuiz = () => {
			return new Promise((resolve, reject) => {
				const xhr = new XMLHttpRequest();
				let container = document.getElementById(`slider`);
				let quizzes;

				xhr.open(`POST`, `../../../wp-admin/admin-ajax.php?action=get_quizzes`, true);

				xhr.setRequestHeader(`Content-type`, `application/x-www-form-urlencoded`);
				let data = {
					step: `step=1`
				};
				xhr.onreadystatechange = () => {
					if (xhr.readyState === 4 && xhr.status === 200) {
						// console.log(JSON.parse(xhr.responseText).data);
						quizzes = JSON.parse(xhr.responseText).data;
						resolve(container.innerHTML = quizzes);
					}
				};
				xhr.send(`step=1`);
				// return resolve(quizzes)
			});
		};



	/*===== SLIDER INITIATING FUNCTION =====*/
const sliderInit = (options) => {

		/*===== PARAMETERS =====*/
		let params = {
			container : document.querySelectorAll(options.container)[0] || document.getElementById(`oo_slider_container`), // need
			numberOfSlides : options.numberOfSlides || document.getElementById(`oo_slider_container`).children, // need
			autoStructure : options.autoStructure || false, // need
			progWidth: function () {
				return 100 / params.numberOfSlides;
			}
		};
		params.progWidth = 100 / params.numberOfSlides; // need
		console.log(params);

		/*===== SLIDER STRUCTURE =====*/
		const sliderStructure = (numberOfSlides) => {
			let slides = `<div id="slider">`;
			// for (let i = 1; i <= numberOfSlides; i++) {
			// 	slides += `<div id='slide${i}' class='slides'>
			// 	<h1>SLIDE${i}</h1>
			//
			// 	</div>`;
			// }
			slides += `</div>`;
			return slides;
		};

		/*===== STRUCTURE THE BUTTONS =====*/
		const footerElements = () => {
			let ftrContainer = `<div id="footer-container">
			<div id="progress-bar">
			<div id="prog-bar-inner" style="width:${params.progWidth}%;">Step 1</div>
			</div>

			<div id="typeform-btns">

			`;
			let buttons = `<div id="btn-container">`;

			for (let i = 0; i < 2; i++) {
				buttons += `<button></button>`;
			}
			buttons += `</div>`;
			ftrContainer += buttons;
			ftrContainer += `</div></div>`;
			return ftrContainer;
		};

		/*===== SET BUTTON ID =====*/
		const setBtnID = () => {
			let buttons = document.getElementById(`btn-container`).childNodes;
			buttons[0].id = `btn-prev`;
			buttons[1].id = `btn-next`;
		};

		/*===== RENDER THE SLIDER =====*/
		const renderSlider = () => {
			params.container.innerHTML = `${sliderStructure(params.numberOfSlides)} ${footerElements()}`;
			setBtnID();
		};

		/*===== STEP 1 =====*/
		/*===== RENDERING THE SLIDER IF NECESSARY =====*/
		if (params.autoStructure) { //params.container.innerHTML
			renderSlider();
		}
		/*===== STEP 2 =====*/
		/*===== MAKING THE AJAX CALL =====*/
		return renderQuiz()
		.then(() => {

			/*===== STEP 3 =====*/
			/*===== ADDING SLIDER's FUNCTIONALITY =====*/
			SliderConstructor({
				autoStructure: true,
				autoStart: false,
				autoloop: false, // disabling autoloop doesnt work with slides less than 4
				numberOfSlides: params.numberOfSlides,
				timer: 10
				// style: ''
			});
		});
};


/*===== INITATING THE SLIDER =====*/
sliderInit({
	autoStructure:true,
	numberOfSlides: 6
});
