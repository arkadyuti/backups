export const checkboxOptions = [
	{value:'pid', label:'PID', checked:true, disabled: true},
    {value:'p_name',label:'Project', checked:true,disabled: false},
    {value:'scg',label:'SCG', checked:true,disabled: false},
    {value:'location',label:'Location', checked:true,disabled: false},
    {value:'p_status',label:'Status',checked:true,disabled: false},
    {value:'p_techstack',label:'Tech Stack', checked:true,disabled: false}
] //This checkboxOptions array to have default 6 check options checked in the Customize popup and render the options in the popup
export const customizeOptionCheck = [
        {value:'pid', label:'PID', checked:true, disabled: true},
        {value:'p_name',label:'Project', checked:true,disabled: false},
        {value:'scg',label:'SCG', checked:true,disabled: false},
        {value:'location',label:'Location', checked:false,disabled: false},
        {value:'p_status',label:'Status',checked:false,disabled: false},
        {value:'p_techstack',label:'Tech Stack', checked:false,disabled: false}
] //This customizeOptionCheck array to have default 3 check options checked in the Customize popup
export const selectedCheckOptions= [
        {value:'pid', label:'PID',checked:true},
        {value:'p_name',label:'Project',checked:true},
        {value:'scg',label:'SCG',checked:true}
] //This selectedCheckOptions array to have default checked options showed in the Project List