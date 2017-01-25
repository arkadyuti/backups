import {calculateTopics,calculatePagers} from './pagination-function.js'

//Checks if multiple fields needs to be searched together
export const searchProjects = function(value,key,projects,pageSize,currentPage,searchValue,columnKeys){
	searchValue[key] = value;
	var keysArray = [];
	var data = [];
	var count=0;
	columnKeys.map((columnKey)=>{
		if(searchValue[columnKey.value] !=""){
			keysArray.push(columnKey.value)
		}
		else{
			count++;
		}
	})
	

	keysArray.map((keyArray,index)=>{
		if(index == 0){
			data = searchData(projects,keyArray,searchValue[keyArray])
		}
		else {
			data = searchData(data,keyArray,searchValue[keyArray])
		}
	})
	

	if(count==columnKeys.length){
		if(data.length==0){
			data=projects;
		}
	}
	let newTopics =  calculateTopics(pageSize,currentPage,data)
	let newPagerLinks = calculatePagers(currentPage,data,pageSize)
	let projectListLength
	if (newTopics.length < pageSize) {
		projectListLength = newTopics.length
	}
	else {
		projectListLength = pageSize
	}
	return {key,data,newTopics,newPagerLinks,searchValue}
}

//Checks if the value enter in the input field is present
export	function searchData(projects,key,val){
	let data=[]

		for(var i=0;i<projects.length;i++){
			if(projects[i][key].toString().toLowerCase().indexOf(val) != -1){
				data.push(projects[i])
			}
		}

	return data
}