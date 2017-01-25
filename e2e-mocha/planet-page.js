var webdriver = require('selenium-webdriver');

PlanetPage = function PlanetsPage(driver) {
  this.driver = driver;
  this.url = "https://decohere.herokuapp.com/planets";
  this.weightField = webdriver.By.id('wt');
};

PlanetPage.prototype.visit = function() {
  this.driver.get(this.url);
  return webdriver.promise.fulfilled(true);
};

PlanetPage.prototype.weightEntryPresent = function() {
  return this.driver.isElementPresent(this.weightField);
};

PlanetPage.prototype.weightEntryBlank = function() {
  return this.driver.findElement(this.weightField).getText();
};

module.exports = PlanetPage;