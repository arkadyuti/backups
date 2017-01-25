export const checkboxFunction = function(event,options){
    var selectedCheckOptionDesktop = [],
        selectedCheckOption = [],
        uncheckedOptions = [],
        uncheckedOptionsDesktop=[];

    if(window.innerWidth>768){
        //only when the browser is rendred to anywhere more than 768px
        options.forEach((option) =>{
            if(option.value === event.target.value) {
                option.checked = event.target.checked;
                //if the intial option value is equal to the user clicked option set the checked object in initial option same as target's option
            }
            if(option.checked) {
                selectedCheckOptionDesktop.push(option);
                //if the option's checked object is true push the option in the selectedCheckOptionDesktop array created before for the desktop view
            }
            uncheckedOptionsDesktop.push(option);
            //push all the option in the uncheckedOptionsDesktop array created before for the desktop view

        })
    }
    else {
        //only when the browser is rendred to anywhere less than 768px
        options.forEach((option) =>{
            if(option.value === event.target.value) {
                option.checked = event.target.checked;
                //if the intial option value is equal to the user clicked option set the checked object in initial option same as target's option
            }
            if(option.checked) {
                selectedCheckOption.push(option);
                //if the option's checked object is true push the option in the selectedCheckOptionDesktop array created before for the mobile view
            }
            uncheckedOptions.push(option);
            //push all the option in the uncheckedOptions array created before for the mobile view
        })    
    }
    return{
    	selectedCheckOption,
        selectedCheckOptionDesktop,
		uncheckedOptions,
        uncheckedOptionsDesktop
        //return the following arrays
    }
}