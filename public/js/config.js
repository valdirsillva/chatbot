window.addEventListener('load', function() {

    let params = new URLSearchParams(document.location.search.substring(1));
    let action = params.get("action");

    // action contém o parâmetro home 
    if (action.includes("home") ) {
    	document.querySelector('[name="favcolor"]').addEventListener('change', getBackground);
    } 

    function getBackground(e) {
    	const response = new XMLHttpRequest();
    		
    	let color = {
    		background: e.target.value
    	};

    	let newObject = JSON.stringify(color);

    	response.open('POST', './components/Layout.php', true);

    	response.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		response.setRequestHeader("Cache-Control", "no-cache, no-store max-age=0");
		response.setRequestHeader("Expires", "Tue, 01 Jan 1980 1:00:00 GMT");
		response.setRequestHeader("Pragma", "no-cache");

    	response.onreadystatechange = function() {
    		if (response.readyState === 4 && response.status === 200) {
    			let data = JSON.parse(response.responseText);
				for(var color of data) {
					apply(color); 
    	        }
    		}
    	}
    	response.send('color='+newObject);
    }


	async function setTheme() {
		const response = await fetch(
			'./components/styles/main.json', 
			{cache: "reload"}
		);
			
		const result = await response.json();

		for(var color of result) {
			apply(color);
		}
	}

	function apply(color) {
		document.querySelector('#header').style.background = color.background;
		document.querySelector('#config').style.background = color.background;
		document.querySelectorAll('.box-content')[0].style.background = color.background;
		document.querySelectorAll('.box-content')[1].style.background = color.background;
	}

	setTheme();
	
});















