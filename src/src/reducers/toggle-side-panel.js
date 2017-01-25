export default function toggleSidePanel(state = { status: false ,headerData:{},sideNavData:{},clicked:true}, action) {
    //reducer containing the different cases.
    switch (action.type) {
    	//side panel open in mobile view
        case 'OPENED':
            if(!state.status){              
                return  Object.assign({},state,{status:!status})
        }
        //side panel closed in mobile view
        case 'CLOSED':
        if(!state.close){
            return Object.assign({},state,{status:false})
        }

         case 'CLICKED':
            return Object.assign({},state,{clicked:action.filter})
        //fetch the details in header
        case 'FETCH_USERS_HEADER':
            return  Object.assign({},state,{headerData:action.headerData}) 
        //fetch the details for sidepanel
        case 'FETCH_USERS_SIDENAV':
            return  Object.assign({},state,{sideNavData:action.sideNavdata})
       

        default: return state
    }
    return state
}