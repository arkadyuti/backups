var By = require('selenium-webdriver').By,
     until = require('selenium-webdriver').until,
     firefox = require('selenium-webdriver/firefox'),
     test = require('selenium-webdriver/testing');

 test.describe('Google Search', function() {
   var driver;

   test.before(function() {
     driver = new firefox.Driver();
   });

   test.after(function() {
     driver.quit();
   });

   test.it('should append query to title', function() {
     driver.get('http://www.google.com/ncr');
     driver.findElement(By.name('q')).sendKeys('webdriver');
     driver.findElement(By.name('btnG')).click();
     driver.wait(until.titleIs('webdriver - Google Search'), 1000);
   });
 });

// var assert = require('assert');
// var webdriver = require('selenium-webdriver');
// var test = require('selenium-webdriver/testing');

// const mochaTimeOut = 30000; //ms
 
// test.describe('Ralph Says', function() {
//   this.timeout(mochaTimeOut);
//   test.it('shows a quote container', function () {
//     var driver = new &amp;nbsp; &amp;nbsp; webdriver.Builder().withCapabilities(webdriver.Capabilities.chrome()).build();
//     driver.get('http://ralphsays.github.io');
//     driver.isElementPresent(webdriver.By.id('quote')).then(function(present) {
//       assert.equal(present, true, "Quote container not displayed");
//     });
//     driver.quit();
//   });
// });

// driver.get('http://www.google.com')
// driver.findElement(webdriver.By.name('q')).sendKeys()
// driver.findElement(webdriver.By.name('q')).sendKeys('Parantap Roy')
// driver.findElement(webdriver.By.name('btnG')).click()
