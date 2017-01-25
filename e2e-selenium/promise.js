"use strict";
 
var webdriver = require('selenium-webdriver');
var driver = new webdriver.Builder().usingServer().withCapabilities({'browserName': 'firefox' }).build();
 
function logTitle() {
    driver.getTitle().then(function(title) {
        console.log('Current Page Title: ' + title);
    });
}
 
function clickLink(link) {
    link.click();
}
 
function handleFailure(err) {
    console.error('Something went wrong\n', err.stack, '\n');
    closeBrowser();
}
 
function findTutsPlusLink() {
    return driver.findElements(webdriver.By.linkText('Learn How To Code by Envato Tuts+')).then(function(result) {
        return result[0];
    });
}
 
function closeBrowser() {
    driver.quit();
}

function getDashboard (argument) {
	return driver.get('http://localhost:4000/Dashboard');
}
driver.get('http://localhost:4000/');
driver.findElement(webdriver.By.xpath("//input[@id = 'nt-id']")).sendKeys('asark4');
driver.findElement(webdriver.By.xpath("//input[@id = 'nt-password']")).sendKeys('asark4');
driver.findElement(webdriver.By.xpath("//button[@class = 'button-enable login-button']")).click();

driver.wait(getDashboard,12000).then(function () {
	driver.findElement(webdriver.By.xpath("//span[@class = 'hover-for-accordian list-title']")).click();	
})





// driver.wait(findTutsPlusLink, 2000).then(clickLink).then(logTitle);
// driver.wait(findTutsPlusLink, 2000).then(clickLink).then(logTitle).then(closeBrowser, handleFailure);

