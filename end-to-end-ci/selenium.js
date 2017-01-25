var webdriver = require('selenium-webdriver'),
				By = webdriver.By,
				until = webdriver.until;
var driver = new webdriver.Builder().forBrowser('firefox').build();

driver.get('https://www.google.com');
driver.findElement(By.name('q')).sendKeys('wiki');
driver.findElement(By.name('btnG')).click();
driver.wait(check_title, 1000);

function check_title () {
	var promise = driver.getTitle().then(
		function (title) {
			if( title === 'wiki - Google Search')
			{
				console.log('success');
				return true;
			}else {
				console.log('fail-- '+ title);
			}
		});
	return promise;
}
