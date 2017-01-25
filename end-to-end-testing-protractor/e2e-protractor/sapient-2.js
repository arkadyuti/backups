describe('Sapient Home Page', function() {
    var allInputs;
    beforeEach(function() {
        browser.get('http://publicis.sapient.com/en-us/contact.html');
        allInputs = function() {
          return element.all(by.deepCss('input,textarea,button,select'));
        }
    });

    // it('should have a title', function() {
    //     expect(browser.getTitle()).toEqual('Contact Form | Contact | Publicis.Sapient');
    // });

    
    it('should contain exactly 4 input elements of any kind', function() {
      expect(allInputs().count()).toBe(10);
    });
});
