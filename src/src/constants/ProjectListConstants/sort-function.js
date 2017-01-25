import {calculateTopics} from './pagination-function.js'

//Sorting function
export const sortingData=function(key,searchedData,toggleFilter,pageSize,currentPage){
    let data = []
    
    //Sorting function for PID as it contains only numbers
    if(key=="pid"){
        data = searchedData.sort((a,b) =>{

            //ascending 
            if(toggleFilter[key]){
                return b[key] - a[key]
            }

            //descending
            else{
                return a[key] - b[key]
            }
        })
    }

    //Sorting function for other columns
    else{
        data = searchedData.sort((a,b)=>{

            //ascending 
            if(toggleFilter[key]){
                return (a[key].toLowerCase() < b[key].toLowerCase()) ? -1 : (a[key].toLowerCase() > b[key].toLowerCase()) ? 1 : 0;

            }

            //descending
            else{
                return (a[key].toLowerCase() > b[key].toLowerCase()) ? -1 : (a[key].toLowerCase() < b[key].toLowerCase()) ? 1 : 0;

            }
        })
    }
    let newTopics = calculateTopics(pageSize,currentPage,data)
    toggleFilter[key]=!toggleFilter[key]
    return {key,toggleFilter,data,newTopics}
}