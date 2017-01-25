var webdriver = require('selenium-webdriver'),
    By = webdriver.By,
    until = webdriver.until;

var driver = new webdriver.Builder()
    .forBrowser('firefox')
    .build();

driver.get('http://www.google.com/ncr');
driver.findElement(By.name('q')).sendKeys('sapient');
driver.findElement(By.name('btnG')).click();

driver.wait(until.titleIs('sapient - Google Search'), 1000);
driver.findElement(By.linkText('Publicis.Sapient')).click();


driver.wait(until.titleIs('Publicis.Sapient'), 5000);

setTimeout(function(){
driver.findElement(By.xpath("//img[@class = 'nav-img4 ng-scope']")).click();

// driver.findElement(By.id('btnSearch')).click();

}, 15000); 
