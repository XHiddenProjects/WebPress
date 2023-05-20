window.addEventListener('load', function() {
    let bar = document.querySelectorAll('.progress-bar');
    for (let i = 0; i < bar.length; i++) {
        if (bar[i].getAttribute('animate-click')) {
            document.querySelector(bar[i].getAttribute('animate-click')).addEventListener('click',function() {
				bar[i].style.width='0%';
				bar[i].innerHTML = '0%';
				setTimeout(function(){
					let currW = parseInt(bar[i].getAttribute('animate-max'));
					let cVal = 0;
					let intval = setInterval(function() {
                    if (cVal <= currW) {
                        cVal += 1;
                        bar[i].style.width = (cVal > currW ? cVal - 1 : cVal) + '%';
                        bar[i].innerHTML = (cVal > currW ? cVal - 1 : cVal) + '%';
                    } else {
                        clearInterval(intval);
                    }
					}, parseInt(bar[i].getAttribute('animate-speed')));
				},800);
                
            });
        }else if (bar[i].getAttribute('animate-input')) {
            document.querySelector(bar[i].getAttribute('animate-input')).addEventListener('input',function() {
					let currW = parseInt(bar[i].getAttribute('animate-max'));
					this.setAttribute('maxlength',currW);
					let cVal = 0;
                    if (cVal <= currW) {
                        cVal += 1;
                        bar[i].style.width = (this.value.length > currW ? this.value.length - 1 : this.value.length) + '%';
                        bar[i].innerHTML = (this.value.length > currW ? this.value.length - 1 : this.value.length) + '%';
                    }
            });
        }else{
			bar[i].style.width='0%';
			bar[i].innerHTML = '0%';
			setTimeout(function(){
					let currW = parseInt(bar[i].getAttribute('animate-max'));
					let cVal = 0;
					let intval = setInterval(function() {
                    if (cVal <= currW) {
                        cVal += 1;
                        bar[i].style.width = (cVal > currW ? cVal - 1 : cVal) + '%';
                        bar[i].innerHTML = (cVal > currW ? cVal - 1 : cVal) + '%';
                    } else {
                        clearInterval(intval);
                    }
					}, parseInt(bar[i].getAttribute('animate-speed')));
				},800);
		}


    }
});