describe('Sapient Home Page', function() {
    beforeEach(function() {
        browser.get('http://publicis.sapient.com/');
    });

    it('should have a title', function() {
        expect(browser.getTitle()).toEqual('Publicis.Sapient');
    });
    it('Navigate to Contact page', function () {
        console.log("SSS");
        element(by.css('.nav-img4')).click();
        expect(browser.getCurrentUrl()).toEqual('http://publicis.sapient.com/en-us/contact.html');
         // browser.pause();
    });
});